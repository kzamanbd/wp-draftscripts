<?php

namespace WpDraftScripts\Actions;

use WpDraftScripts\BasePlugin;

class SettingsLink extends BasePlugin
{
    public function register()
    {
        // add filter
        add_filter(
            "plugin_action_links_$this->pluginBaseName",
            array($this, 'settings_link')
        );
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=wp-draftscripts">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}
