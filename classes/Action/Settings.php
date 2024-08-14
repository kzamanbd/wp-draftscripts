<?php

namespace WpDraftScripts\Action;

class Settings
{
    public array $pages = [];
    public array $subPages = [];

    public function register()
    {
        if (!empty($this->pages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }
    }

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

    public function addPages(array $pages)
    {
        $this->pages = $pages;
        return $this;
    }

    public function withSubPage(array $pages = [], string $title = null)
    {
        if (empty($this->pages)) {
            return $this;
        }

        $parent = $this->pages[0];

        $subPage = [
            [
                'parent_slug' => $parent['menu_slug'],
                'page_title' => $parent['page_title'],
                'menu_title' => $title ? $title : $parent['menu_title'],
                'capability' => $parent['capability'],
                'menu_slug' => $parent['menu_slug'],
                'callback' => $parent['callback']
            ]
        ];

        $this->subPages = array_merge($subPage, $pages);

        return $this;
    }
}
