<?php

namespace WpDraftScripts\Actions;

class Settings
{
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
     * Register the actions
     * @return void
     */
    public function register()
    {
        if (!empty($this->pages) || !empty($this->subPages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }

        if (!empty($this->customFields)) {
            add_action('admin_init', array($this, 'registerCustomFields'));
        }
    }

    /**
     * Add the admin menu
     * @return void
     */

    public function addAdminMenu()
    {
        foreach ($this->pages as  $page) {
            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'] ?? null,
                $page['icon_url'] ?? null,
                $page['position'] ?? null
            );
        }

        foreach ($this->subPages as $page) {
            add_submenu_page(
                $page['parent_slug'],
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback']
            );
        }
    }

    /**
     * Add the pages
     * @param array $pages
     * @return $this
     */

    public function addPages(array $pages)
    {
        $this->pages = $pages;
        return $this;
    }

    /**
     * Add the sub pages
     * @param array $pages
     * @param string|null $title
     * @return $this
     */

    public function withSubPage(array $pages = [], string $title = null)
    {
        $parentSupPage = [];

        if (!empty($this->pages)) {
            $parent = $this->pages[0];

            $parentSupPage = [
                [
                    'parent_slug' => $parent['menu_slug'],
                    'page_title' => $parent['page_title'],
                    'menu_title' => $title ? $title : $parent['menu_title'],
                    'capability' => $parent['capability'],
                    'menu_slug' => $parent['menu_slug'],
                    'callback' => $parent['callback']
                ]
            ];
        }

        $this->subPages = array_merge($parentSupPage, $pages);

        return $this;
    }

    /**
     * Add the customFields
     * @param array $customFields
     * @return $this
     */
    public function addCustomFields(array $customFields)
    {
        $this->customFields = $customFields;
        return $this;
    }

    /**
     * Register the customFields
     * @return $this
     */

    public function registerCustomFields()
    {
        if (empty($this->customFields)) {
            return $this;
        }

        foreach ($this->customFields as $setting) {
            register_setting(
                $setting['option_group'],
                $setting['option_name'],
                $setting['callback'] ?? null
            );
        }

        $this->registerSections();
        $this->registerFields();

        return $this;
    }

    /**
     * Add the sections
     * @param array $sections
     * @return $this
     */

    public function addSections(array $sections)
    {
        $this->sections = $sections;
        return $this;
    }

    /**
     * Register the sections
     * @return $this
     */

    public function registerSections()
    {
        if (empty($this->sections)) {
            return $this;
        }
        foreach ($this->sections as $section) {
            add_settings_section(
                $section['id'],
                $section['title'],
                $section['callback'],
                $section['page']
            );
        }
        return $this;
    }

    /**
     * Add the fields
     * @param array $fields
     * @return $this
     */

    public function addFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * register the fields
     * @param array $fields
     * @return $this
     */

    public function registerFields()
    {
        if (empty($this->fields)) {
            return $this;
        }

        foreach ($this->fields as $field) {
            add_settings_field(
                $field['id'],
                $field['title'],
                $field['callback'],
                $field['page'],
                $field['section'] ?? 'default',
                $field['args'] ?? null
            );
        }

        return $this;
    }
}
