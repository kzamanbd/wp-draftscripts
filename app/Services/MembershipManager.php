<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Support\BasePlugin;

class MembershipManager extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * MembershipManager constructor.
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

        if (!$this->isActivated('membership_manager')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Membership Manager',
                'menu_title' => 'Membership Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-membership',
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
