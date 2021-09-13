<?php

/**
 * @package online_email_extractor
 * @version 1.0
 **/

/**
Plugin Name: Online Email Extractor
Plugin URI: https://sdardour.com/lab
Description: Shortcode: [online-email-extractor] | Place it inside any WordPress post or page | Demo: https://sdardour.com/lab/2020/online-email-extractor/ | Based on Bootstrap and requires, therefore, the Bootstrap Plugin: https://sdardour.com/lab/2020/bootstrap-inside-wordpress-plugin/
Author: lab@sdardour.com
Version: 1.0
Author URI: https://sdardour.com/lab
**/

/* --- */

if (!function_exists("add_action")) {

    exit;

}

/* --- */

define("ONLINE_EMAIL_EXTRACTOR_URL", plugin_dir_url(__FILE__));
define("ONLINE_EMAIL_EXTRACTOR_DIR", plugin_dir_path(__FILE__));

/* --- */

$ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED = 0;

function ONLINE_EMAIL_EXTRACTOR_TEMPLATE_REDIRECT()
{
    global $ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED;

    if ((is_page() or is_single()) and (strpos(get_post(get_the_ID())->post_content, "[online-email-extractor]") !== false)) {

        $ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED = 1;

    }

}

add_action("template_redirect", "ONLINE_EMAIL_EXTRACTOR_TEMPLATE_REDIRECT");

/* --- */

function ONLINE_EMAIL_EXTRACTOR_WP_ENQUEUE_SCRIPTS()
{

    global $ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED;

    if ($ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED === 1) {

        wp_enqueue_script("jquery");

        wp_enqueue_script(
            "text",
            ONLINE_EMAIL_EXTRACTOR_URL . "assets/text.js"
        );

        wp_enqueue_script(
            "online-email-extractor",
            ONLINE_EMAIL_EXTRACTOR_URL . "assets/appl.js",
            array("jquery", "text")
        );

        wp_enqueue_style(
            "online-email-extractor",
            ONLINE_EMAIL_EXTRACTOR_URL . "assets/appl.css"
        );

    }

}

add_action("wp_enqueue_scripts", "ONLINE_EMAIL_EXTRACTOR_WP_ENQUEUE_SCRIPTS");

/* --- */

function ONLINE_EMAIL_EXTRACTOR_HTM($atts)
{

    global $ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED;

    if ($ONLINE_EMAIL_EXTRACTOR_CAN_BE_LOADED === 1) {

        return @file_get_contents(ONLINE_EMAIL_EXTRACTOR_DIR . "assets/appl.htm");

    } else {

        return "";

    }

}

add_shortcode("online-email-extractor", "ONLINE_EMAIL_EXTRACTOR_HTM");

/* --- */
