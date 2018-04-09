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

class Ai1wmde_Import_Controller {

	public static function button() {
		return Ai1wm_Template::get_content(
			'import/button',
			array( 'token' => get_option( 'ai1wmde_dropbox_token' ) ),
			AI1WMDE_TEMPLATES_PATH
		);
	}

	public static function picker() {
		Ai1wm_Template::render(
			'import/picker',
			array(),
			AI1WMDE_TEMPLATES_PATH
		);
	}

	public static function folder() {
		// Set path
		$path = null;
		if ( isset( $_GET['path'] ) ) {
			$path = untrailingslashit( $_GET['path'] );
		}

		// Set Dropbox client
		$dropbox = new ServMaskDropboxClient(
			get_option( 'ai1wmde_dropbox_token' ),
			get_option( 'ai1wmde_dropbox_ssl', true )
		);

		// List folder
		$directory = $dropbox->listFolder( $path );

		// Set folder structure
		$response = array( 'items' => array(), 'numHiddenFiles' => 0 );

		// Set folder items
		if ( isset( $directory['entries'] ) && ( $entries = $directory['entries'] ) ) {
			foreach ( $entries as $entry ) {
				if ( $entry['.tag'] === 'folder' || pathinfo( $entry['name'], PATHINFO_EXTENSION ) === 'wpress' ) {
					$response['items'][] = array(
						'name'  => isset( $entry['name'] ) ? $entry['name'] : null,
						'size'  => isset( $entry['size'] ) ? size_format( $entry['size'] ) : null,
						'date'  => isset( $entry['server_modified'] ) ? human_time_diff( strtotime( $entry['server_modified'] ) ) : null,
						'path'  => isset( $entry['path_lower'] ) ? $entry['path_lower'] : null,
						'icon'  => isset( $entry['icon'] ) ? $entry['icon'] : null,
						'bytes' => isset( $entry['size'] ) ? $entry['size'] : null,
						'type'  => isset( $entry['.tag'] ) ? $entry['.tag'] : null,
					);
				} else {
					$response['numHiddenFiles']++;
				}
			}

			// Sort entries by type desc and name asc
			usort( $response['items'], 'Ai1wmde_Import_Controller::sort_by_type_desc_name_asc' );
		}

		echo json_encode( $response );
		exit;
	}

	public static function sort_by_type_desc_name_asc( $first_item, $second_item ) {
		// Sort items by type in desc order
		$sorted_items = strcasecmp( $second_item['type'], $first_item['type'] );
		if ( $sorted_items !== 0 ) {
			return $sorted_items;
		}

		// Sort the items one more time by name in asc order
		return strcasecmp( $first_item['name'], $second_item['name'] );
	}
}
