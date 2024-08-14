<?php

namespace WpDraftscripts\Action;

use WpDraftscripts\Support\BaseApplication;

class Enqueue extends BaseApplication
{
    /**
     * Register services
     */
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    /**
     * Enqueue scripts
     */
    public function enqueue()
    {
        wp_enqueue_style(
            'wp-draftscripts',
            "$this->pluginURL/assets/css/styles.css"
        );
        wp_enqueue_script(
            'wp-draftscripts',
            "$this->pluginURL/assets/js/scripts.js"
        );
    }
}
