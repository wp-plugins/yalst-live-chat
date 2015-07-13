<?php
/*
Plugin Name: yalst Live Chat
Plugin URI: https://www.yalst.de/service/dokumentation/
Description: Dieses Plugin hilft Ihnen bei der Integration des yalst Live Chats in Wordpress. This plugin helps you integrating the yalst Live Chat into Wordpress.
Version: 1.0.3
Author: Visisoft OHG
Author URI: https://www.yalst.de/visisoft/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: yalst_text
Domain Path: /languages

*/

/* http://stackoverflow.com/questions/17016960/chromiums-xss-auditor-refused-to-execute-a-script */
header("X-XSS-Protection: 0");

/* Widget erzeugen */

require_once(dirname(__FILE__).'/plugin_files/widget/yalst-widget.php');

if (is_admin())
{
	require_once(dirname(__FILE__).'/plugin_files/yalstAdmin.class.php');
	
	yalstAdmin::get_instance();
}
else
{
	require_once(dirname(__FILE__).'/plugin_files/yalstGeneral.class.php');
	yalstGeneral::get_instance();
}

function yalst_load_plugin_textdomain() {
    load_plugin_textdomain( 'yalst_text', FALSE, basename( dirname( __FILE__ ) ) . '/plugin_files/languages/' );
}
add_action( 'plugins_loaded', 'yalst_load_plugin_textdomain' );

/* Für Poedit and I18n */
__('Dieser Plugin erlaubt die einfache Integration des yalst-LiveSupportTools in Wordpress.', 'yalst_text');
__('yalst-LiveSupportTool', 'yalst_text');





