<?php

namespace WpDraftScripts\Support;

class BasePlugin
{
    /**
     * Plugin version
     * @var string
     */

    public string $version = '1.0.0';

    /**
     * Plugin URL
     * @var string
     */
    public string $pluginURL;

    /**
     * Plugin path
     * @var string
     */
    public string $pluginPath;

    /**
     * Plugin base name
     * @var string
     */
    public string $pluginBaseName;

    /**
     * Plugin options
     * @var array
     */

    public array $optionsManagers = [];

    public function __construct()
    {
        $this->pluginURL = WP_DRAFTSCRIPTS_PLUGIN_URL;
        $this->pluginPath = WP_DRAFTSCRIPTS_PLUGIN_PATH;
        $this->pluginBaseName = WP_DRAFTSCRIPTS_PLUGIN_BASENAME;

        $this->optionsManagers = [
            'cpt_manager' => 'CPT Manager',
            'taxonomy_manager' => 'Taxonomy Manager',
            'media_widget' => 'Media Widget',
            'gallery_manager' => 'Gallery Manager',
            'testimonial_manager' => 'Testimonial Manager',
            'templates_manager' => 'Templates Manager',
            'login_manager' => 'Login Manager',
            'membership_manager' => 'Membership Manager',
            'chat_manager' => 'Chat Manager',
        ];
    }

    public function view($view, $data = [])
    {
        if (file_exists($this->pluginPath . 'resources/views/' . $view . '.php')) {
            extract($data);
            require_once $this->pluginPath . 'resources/views/' . $view . '.php';
        }
    }
}
