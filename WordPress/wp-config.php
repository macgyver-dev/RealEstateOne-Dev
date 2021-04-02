<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wpcs' );


/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );


/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );


/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );


/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );


/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', '&x%b=^#6%KTKC4Z<[}#rB3Y<w2VoGdbpDC,zY;ekg.A4[D*MQc6(A+ei&[uAyMF(' );

define( 'SECURE_AUTH_KEY', 'z0M;`K8Fg`x/s0AiZ8]/E)#y?c72jHr}f_-+I%zN&cvZ7j&U*Q|Z)aRQi&BRs}vt' );

define( 'LOGGED_IN_KEY', 'kcxQ3drcHc`Mk7%uz3LDC!A-#Zln,+BiBK3EUn+xy-k.*_T$c^^ZaZ&S`YK4{ny+' );

define( 'NONCE_KEY', 'oy$+a6Z7>q&:HbClp!iJhtd&`c7cam5a:y&HG4;_2}(_%r~P?lu!xBnYde#q(?UC' );

define( 'AUTH_SALT', '+<#V,Wv.9>F5=s=hGM0VQo^LEfDZ}`|@vro~^|F?u:uOlW]tQ#N]C(MUSoOk:6R9' );

define( 'SECURE_AUTH_SALT', '6^2DU-uVD1pKzV2|D_p(6TsYX@O58cce/7dhLvzUX?0]z9&+/chdQw>/i/X~|WlT' );

define( 'LOGGED_IN_SALT', '{gsU3}szv]V!)BX7b;cl#{Wlx$R-((Aa6Zn<7hy%aMy*08!IK![gKp`k0kJ2@ya9' );

define( 'NONCE_SALT', '1-Gb%A1h+OSIC:VHQX&O_a vJou;C4:z*,IE_>xp@i|JC|)G8it)ipErQtr^rE:l' );

/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';


/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'SCRIPT_DEBUG', true );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once ABSPATH . 'wp-settings.php';
