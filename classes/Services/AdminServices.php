<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Support\BaseApplication;

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

        $this->setPages();
        $this->settings->addPages($this->pages)
            ->withSubPage($this->subPages, 'General')
            ->register();
    }

    public function setPages()
    {
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

        $this->subPages = [
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Custom Post Type',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-cpt',
                'callback' => array($this, 'customPost')
            ],
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Settings',
                'menu_title' => 'Settings',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-settings',
                'callback' => array($this, 'customPost')
            ]

        ];
    }

    public function index()
    {
        $this->view('index', [
            'name' => 'Kamruzzaman'
        ]);
    }

    public function customPost()
    {
        $this->view('settings');
    }
}
