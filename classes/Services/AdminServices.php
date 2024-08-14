<?php

namespace WpDraftscripts\Services;

use WpDraftScripts\Action\Settings;
use WpDraftscripts\Support\BaseApplication;

class AdminServices extends BaseApplication
{
    public $settings;

    public array $pages = [];
    public array $subPages = [];

    public function __construct()
    {
        parent::__construct();
        $this->settings = new Settings();
    }

    public function register()
    {
        // add settings page
        $this->pages = [
            [
                'page_title' => 'WP DraftScripts Plugin',
                'menu_title' => 'DraftScripts',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts',
                'callback' => array($this, 'index'),
                'icon_url' => 'dashicons-store',
                'position' => 110,
            ]
        ];

        // add sub pages
        $this->subPages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Custom Post Type',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-cpt',
                'callback' => array($this, 'index')
            ],
        ];

        $this->settings->addPages($this->pages)
            ->withSubPage($this->subPages, 'General')
            ->register();
    }

    public function index()
    {
        $this->view('index', [
            'name' => 'WP DraftScripts Plugin'
        ]);
    }


    public function settings()
    {
        $this->view('settings');
    }
}
