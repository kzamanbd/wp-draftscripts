<?php

namespace WpDraftScripts\Services;

use WpDraftScripts\Actions\Settings;
use WpDraftScripts\Callbacks\DashboardCallbacks;
use WpDraftScripts\Support\BasePlugin;

class DashboardSettings extends BasePlugin
{
    /**
     * @var Settings $settings
     */
    public Settings $settings;

    /**
     * @var DashboardCallbacks $callbacks
     */

    public DashboardCallbacks $callbacks;

    /**
     * @var array $pages
     */
    public array $pages = [];

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
        $this->callbacks = new DashboardCallbacks();
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
            ->addCustomFields($this->customFields)
            ->addSections($this->sections)
            ->addFields($this->fields)
            ->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'WP DraftScripts',
                'menu_title' => 'DraftScripts',
                'capability' => 'manage_options',
                'menu_slug' => 'draftscripts',
                'callback' => array($this->callbacks, 'dashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110,
            ]
        ];
    }

    /**
     * Set the custom fields
     * @return void
     */
    public function setCustomFields()
    {
        $this->customFields = [];
        $this->fields = [];

        foreach ($this->optionsManagers as $key => $option) {
            $this->customFields[] = [
                'option_group' => 'draftscripts_settings',
                'option_name' => 'draftscripts',
                'callback' => array($this->callbacks, 'checkboxSanitize'),
            ];

            $this->fields[] = [
                'id' => $key,
                'title' => "Activate $option",
                'callback' => array($this->callbacks, 'addedField'),
                'page' => 'draftscripts',
                'section' => 'draftscripts_index',
                'args' => [
                    'label_for' => $key,
                    'class' => 'checkbox',
                    'option_name' => 'draftscripts',
                    'type' => 'checkbox'
                ]
            ];
        }

        $this->sections = [
            [
                'id' => 'draftscripts_index',
                'title' => 'Settings',
                'callback' => array($this->callbacks, 'addedSectionGroup'),
                'page' => 'draftscripts'
            ]
        ];
    }
}
