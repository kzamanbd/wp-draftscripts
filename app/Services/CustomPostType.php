<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Callbacks\DashboardCallbacks;
use WpDraftScripts\Support\BasePlugin;

class CustomPostType extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * @var DashboardCallbacks $callbacks
     */
    public $callbacks;

    /**
     * @var array $subPages
     */
    public array $subPages = [];


    /**
     * CustomPostType constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->settings = new Settings();
        $this->callbacks = new DashboardCallbacks();
    }

    /**
     * Register the actions
     * @return void
     */
    public function register()
    {

        $options = get_option($this->pluginOptionName);

        if (!isset($options['cpt_manager']) || !$options['cpt_manager']) {
            return;
        }

        $this->subPages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Custom Post Type',
                'menu_title' => 'CPT Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-cpt',
                'callback' => array($this->callbacks, 'settings')
            ]
        ];

        $this->settings->addSubPages($this->subPages)->register();

        add_action('init', array($this, 'custom_post_type'));
    }

    public function custom_post_type()
    {
        register_post_type(
            'product',
            [
                'public' => true,
                'label' => 'Products',
            ]
        );
    }
}
