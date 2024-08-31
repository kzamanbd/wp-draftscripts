<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\BasePlugin;

class AuthManager extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * AuthManager constructor.
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

        if (!$this->isActivated('login_manager')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Auth Manager',
                'menu_title' => 'Auth Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-auth',
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
