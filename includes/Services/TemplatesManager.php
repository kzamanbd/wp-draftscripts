<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\BasePlugin;

class TemplatesManager extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * TemplatesManager constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->settings = new Settings();
    }

    /**
     * Register the actions
     * @return void
     */
    public function register()
    {

        if (!$this->isActivated('templates_manager')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Template Manager',
                'menu_title' => 'Template Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-template',
                'callback' => array($this, 'callback')
            ]
        ];

        $this->settings->addSubPages($pages)->register();
    }


    public function callback()
    {
        $this->view('settings');
    }
}
