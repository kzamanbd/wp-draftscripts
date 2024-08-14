<?php

namespace WpDraftscripts\Action;

class Enqueue
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
        wp_enqueue_style('wp-draftscripts', WP_DRAFTSCRIPTS_PLUGIN_URL . 'assets/css/style.css');
        wp_enqueue_script('wp-draftscripts', WP_DRAFTSCRIPTS_PLUGIN_URL . 'assets/js/scripts.js');
    }
}
