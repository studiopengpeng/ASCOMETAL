<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'ascometal');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+s#-yE1XGa~>a->3.t3f$15.,B=wIl=V6P#i+b`6Mf{=hn8g3~UWT},Nq0?DJvGy');
define('SECURE_AUTH_KEY',  ' &ymQ]+S%#_=M$l77e*6=MQz9?9{ygiMf(G)mVB`16@a|ixvC)(~2Rf+y}GC4fa_');
define('LOGGED_IN_KEY',    'M=`xX$Ds^-a{k<.,<._WG*/^Z+9uD tof*0#H(Z|.`|[?c`#Nm|lN}PXX;M|;LQW');
define('NONCE_KEY',        'ivk;%)P8(fT%8|)pyw5N3$ |h|p3rxblYm~a_OYw5%k^xr1}T^y6ngU|1h_Cq@3^');
define('AUTH_SALT',        'SRB9W>vbqJWNG|un4?/?*1hT0a~i8vc3[rM|G:ir_H$z^Jb{0-B$uw0g ,Fh#F5T');
define('SECURE_AUTH_SALT', '@RKht0H#PYMh6?57K+r??|_tEBrrr+=MC-Kyl.?0iiy6=3vnZJ[:y/_h+4-!Yv -');
define('LOGGED_IN_SALT',   '?^p|;bR;.0rP*H1k>PN;kcI4!#86-U]Xra(RZnEUl7so!1@My)Te:nMKn.lgR[|2');
define('NONCE_SALT',       '_81`(7sYO)tfL6v((ZFnCmtS@2$||*6$R+]:pi-K,P(`frD`{?u1(:mM2}2aor:H');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_rZp54_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', false);

define('RELOCATE', true);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');