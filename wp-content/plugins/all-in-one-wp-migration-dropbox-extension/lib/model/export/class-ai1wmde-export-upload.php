<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wmde_Export_Upload {

	public static function execute( $params, ServMaskDropboxClient $dropbox = null, ServMaskDropboxCurl $adapter = null ) {

		// Set completed flag
		$params['completed'] = false;

		// Set offset
		if ( ! isset( $params['offset'] ) ) {
			$params['offset'] = 0;
		}

		// Set retry
		if ( ! isset( $params['retry'] ) ) {
			$params['retry'] = 0;
		}

		// Set Dropbox client
		if ( is_null( $dropbox ) ) {
			$dropbox = new ServMaskDropboxClient(
				get_option( 'ai1wmde_dropbox_token' ),
				get_option( 'ai1wmde_dropbox_ssl', true )
			);
		}

		// Set archive file
		$archive = fopen( ai1wm_archive_path( $params ), 'rb' );

		// Set archive details
		$folder = ai1wm_archive_folder();
		$name   = ai1wm_archive_name( $params );
		$bytes  = ai1wm_archive_bytes( $params );
		$size   = ai1wm_archive_size( $params );

		// Read file chunk
		if ( ( fseek( $archive, $params['offset'] ) !== -1 )
				&& ( $chunk = fread( $archive, ServMaskDropboxClient::CHUNK_SIZE ) ) ) {

			// Upload file in one chunk if <= 4MB
			if ( $bytes <= ServMaskDropboxClient::CHUNK_SIZE ) {

				try {

					// Increase number of retries
					$params['retry'] += 1;

					// Upload file
					$dropbox->uploadFile( sprintf( '/%s/%s', $folder, $name ), $chunk, $params, $adapter );

				} catch ( Ai1wmde_Connect_Exception $e ) {
					// Retry 3 times
					if ( $params['retry'] <= 3 ) {
						return $params;
					}

					throw $e;
				}

				// Set completed flag
				$params['completed'] = true;

			} elseif ( $params['offset'] === 0 ) {

				try {

					// Increase number of retries
					$params['retry'] += 1;

					// Upload first file chunk
					$dropbox->uploadFirstFileChunk( $chunk, $params, $adapter );

				} catch ( Ai1wmde_Connect_Exception $e ) {
					// Retry 3 times
					if ( $params['retry'] <= 3 ) {
						return $params;
					}

					throw $e;
				}
			} elseif ( ( $bytes > $params['offset'] + ServMaskDropboxClient::CHUNK_SIZE ) ) {

				try {

					// Increase number of retries
					$params['retry'] += 1;

					// Upload next file chunk
					$dropbox->uploadNextFileChunk( $chunk, $params, $adapter );

				} catch ( Ai1wmde_Connect_Exception $e ) {
					// Retry 3 times
					if ( $params['retry'] <= 3 ) {
						return $params;
					}

					throw $e;
				}
			} else {

				try {

					// Increase number of retries
					$params['retry'] += 1;

					// Upload file chunk commit
					$dropbox->uploadFileChunkCommit( sprintf( '/%s/%s', $folder, $name ), $chunk, $params, $adapter );

				} catch ( Ai1wmde_Connect_Exception $e ) {
					// Retry 3 times
					if ( $params['retry'] <= 3 ) {
						return $params;
					}

					throw $e;
				}

				// Set completed flag
				$params['completed'] = true;
			}

			// Set next offset
			$params['offset'] = ftell( $archive );
		}

		// Unset retry counter
		unset( $params['retry'] );

		// Set progress
		if ( empty( $params['completed'] ) ) {

			// Get progress
			if ( isset( $params['offset'] ) ) {
				$progress = (int) ( ( $params['offset'] / $bytes ) * 100 );
			} else {
				$progress = 100;
			}

			// Set progress
			Ai1wm_Status::info(
				sprintf(
					__(
						'<i class="ai1wmde-icon-dropbox"></i> ' .
						'Uploading <strong>%s</strong> (%s)<br />%d%% complete',
						AI1WMDE_PLUGIN_NAME
					),
					$name,
					$size,
					$progress
				)
			);

		} else {

			// Set last backup date
			update_option( 'ai1wmde_dropbox_timestamp', time() );

			// Unset upload ID
			unset( $params['upload_id'] );

			// Unset offset
			unset( $params['offset'] );

			// Unset completed flag
			unset( $params['completed'] );

		}

		// Close the archive file
		fclose( $archive );

		return $params;
	}
}
