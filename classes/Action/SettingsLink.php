<?php

namespace WpDraftscripts\Action;

class SettingsLink
{
    public function register()
    {
        // add filter
        add_filter('plugin_action_links_' . WP_DRAFTSCRIPTS_PLUGIN_BASENAME, array($this, 'settings_link'));
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=wp_draftscripts">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}
