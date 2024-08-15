<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Support\BaseApplication;

class AdminServices extends BaseApplication
{
    /**
     * @var Settings $settings
     */
    public $settings;

    /**
     * @var array $pages
     */
    public array $pages = [];

    /**
     * @var array $subPages
     */

    public array $subPages = [];

    /**
     * @var array $customFields
     */

    public array $customFields = [];

    /**
     * @var array $sections
     */

    public array $sections = [];

    /**
     * @var array $fields
     */

    public array $fields = [];


    /**
     * AdminServices constructor.
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

        $this->setPages();
        $this->setCustomFields();

        $this->settings->addPages($this->pages)
            ->withSubPage($this->subPages, 'General')
            ->addCustomFields($this->customFields)
            ->addSections($this->sections)
            ->addFields($this->fields)
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
                'callback' => array($this, 'settings')
            ],
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Settings',
                'menu_title' => 'Settings',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-settings',
                'callback' => array($this, 'settings')
            ]

        ];
    }

    /**
     * Set the custom fields
     * @return void
     */
    public function setCustomFields()
    {
        $this->customFields = [
            [
                'option_group' => 'draftscripts_options_group',
                'option_name' => 'text_example',
                'callback' => array($this, 'addedOptionsGroup'),
            ],
            [
                'option_group' => 'draftscripts_options_group',
                'option_name' => 'full_name',
            ]
        ];

        $this->sections = [
            [
                'id' => 'draftscripts_index',
                'title' => 'Settings',
                'callback' => array($this, 'addedSectionGroup'),
                'page' => 'draftscripts'
            ]
        ];

        $this->fields = [
            [
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => array($this, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'text_example',
                    'class' => 'regular-text',
                    'option_name' => 'text_example'
                ]
            ],
            [
                'id' => 'full_name',
                'title' => 'Full Name',
                'callback' => array($this, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'full_name',
                    'class' => 'regular-text',
                    'option_name' => 'full_name'
                ]
            ]
        ];
    }

    public function index()
    {
        $this->view('index', [
            'name' => 'Kamruzzaman'
        ]);
    }

    public function settings()
    {
        $this->view('settings');
    }

    public function addedOptionsGroup($input)
    {
        return $input;
    }

    public function addedSectionGroup()
    {
        echo 'Set your settings here';
    }

    public function addedField($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $value = esc_attr(get_option($option_name));
        $type = isset($args['type']) ? $args['type'] : 'text';
        $placeholder = isset($args['placeholder']) ? $args['placeholder'] : 'Write something here';
        switch ($type) {
            case 'textarea':
                echo "<textarea id='$name' name='$option_name' class='$class' placeholder='$placeholder'>$value</textarea>";
                break;
            default:
                echo "<input type='text' id='$name' name='$option_name' value='$value' class='$class' placeholder='$placeholder'>";
        }
    }
}
