<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Callbacks\AdminCallbacks;
use WpDraftScripts\Support\BasePlugin;

class AdminServices extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public Settings $settings;

    /**
     * @var AdminCallbacks $adminCallbacks
     */

    public AdminCallbacks $adminCallbacks;

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
        $this->adminCallbacks = new AdminCallbacks();
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
                'callback' => array($this->adminCallbacks, 'dashboard'),
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
                'callback' => array($this->adminCallbacks, 'settings')
            ],
            [
                'parent_slug' => 'draftscripts',
                'page_title' => 'Settings',
                'menu_title' => 'Settings',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts-settings',
                'callback' => array($this->adminCallbacks, 'settings')
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
                'option_group' => 'draftscripts_settings',
                'option_name' => 'cpt_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'texonomy_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'media_widget',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'gallery_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'testimonial_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'templates_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'login_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'membership_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ],
            [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'chat_manager',
                'callback' => array($this->adminCallbacks, 'checkboxSanitize'),
            ]
        ];

        $this->sections = [
            [
                'id' => 'draftscripts_index',
                'title' => 'Settings',
                'callback' => array($this->adminCallbacks, 'addedSectionGroup'),
                'page' => 'draftscripts'
            ]
        ];

        $this->fields = [
            [
                'id' => 'cpt_manager',
                'title' => 'Activate CPT Manager',
                'callback' => array($this->adminCallbacks, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'cpt_manager',
                    'class' => 'checkbox',
                    'option_name' => 'cpt_manager',
                    'type' => 'checkbox'
                ]
            ],
            [
                'id' => 'texonomy_manager',
                'title' => 'Activate Texonomy Manager',
                'callback' => array($this->adminCallbacks, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'texonomy_manager',
                    'class' => 'checkbox',
                    'option_name' => 'texonomy_manager',
                    'type' => 'checkbox'
                ]
            ],
            [
                'id' => 'media_widget',
                'title' => 'Activate Media Widget',
                'callback' => array($this->adminCallbacks, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'media_widget',
                    'class' => 'checkbox',
                    'option_name' => 'media_widget',
                    'type' => 'checkbox'
                ]
            ],
            [
                'id' => 'gallery_manager',
                'title' => 'Activate Gallery Manager',
                'callback' => array($this->adminCallbacks, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'gallery_manager',
                    'class' => 'checkbox',
                    'option_name' => 'gallery_manager',
                    'type' => 'checkbox'
                ]
            ],
            [
                'id' => 'testimonial_manager',
                'title' => 'Activate Testimonial Manager',
                'callback' => array($this->adminCallbacks, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'testimonial_manager',
                    'class' => 'checkbox',
                    'option_name' => 'testimonial_manager',
                    'type' => 'checkbox'
                ]
            ],
            [
                'id' => 'templates_manager',
                'title' => 'Activate Templates Manager',
                'callback' => array($this->adminCallbacks, 'addedField'),
                'section' => 'draftscripts_index',
                'page' => 'draftscripts',
                'args' => [
                    'label_for' => 'templates_manager',
                    'class' => 'checkbox',
                    'option_name' => 'templates_manager',
                    'type' => 'checkbox'
                ]
            ]
        ];
    }
}
