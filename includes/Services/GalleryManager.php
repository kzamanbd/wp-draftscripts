<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\BasePlugin;

class GalleryManager extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * GalleryManager constructor.
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

        if (!$this->isActivated('gallery_manager')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Gallery Manager',
                'menu_title' => 'Gallery Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-gallery',
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
