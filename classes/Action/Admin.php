<?php

namespace WpDraftscripts\Action;

class Admin
{
    public function register()
    {
        // add admin menu
        add_action('admin_menu', array($this, 'add_admin_pages'));
    }



    public function add_admin_pages()
    {
        add_menu_page('WP DraftScripts Plugin', 'DraftScripts', 'manage_options', 'wp_draftscripts', array($this, 'admin_index'), 'dashicons-store', 110);
    }

    public function admin_index()
    {
        // require template
        require_once WP_DRAFTSCRIPTS_PLUGIN_PATH . 'templates/admin.php';
    }
}
