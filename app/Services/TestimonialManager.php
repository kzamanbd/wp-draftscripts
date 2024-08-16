<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Support\BasePlugin;

class TestimonialManager extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * TestimonialManager constructor.
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

        if (!$this->isActivated('testimonial_manager')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Testimonial Manager',
                'menu_title' => 'Testimonial Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-testimonial',
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
