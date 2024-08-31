<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\BasePlugin;

class MediaWidget extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * MediaWidget constructor.
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

        if (!$this->isActivated('media_widget')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Media Widget Manager',
                'menu_title' => 'Media Widget',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-media-widget',
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
