<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Callbacks\DashboardCallbacks;
use WpDraftScripts\BasePlugin;

class CustomPostType extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * CustomPostType constructor.
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

        if (!$this->isActivated('cpt_manager')) {
            return;
        }

        $pages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Custom Post Type',
                'menu_title' => 'CPT Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-cpt',
                'callback' => array($this, 'callback')
            ]
        ];

        $this->settings->addSubPages($pages)->register();

        add_action('init', array($this, 'activate'));
    }

    public function activate()
    {
        register_post_type(
            'product',
            [
                'public' => true,
                'label' => 'Products',
            ]
        );
    }

    public function callback()
    {
        $this->view('settings');
    }
}
