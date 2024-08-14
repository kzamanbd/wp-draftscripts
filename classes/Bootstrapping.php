<?php

namespace WpDraftscripts;

use WpDraftscripts\Action\Admin;
use WpDraftscripts\Action\CustomPostType;
use WpDraftscripts\Action\Enqueue;
use WpDraftscripts\Action\Pages;
use WpDraftscripts\Action\SettingsLink;

class Bootstrapping
{

    public static function init()
    {
        self::register();

        return self::instance(__CLASS__);
    }
    /**
     * Get all services
     * @return array
     */
    public static function services()
    {
        return [
            Admin::class,
            Enqueue::class,
            SettingsLink::class,
            Pages::class,
            CustomPostType::class
        ];
    }

    /**
     * Register all services
     * @return void
     */
    public static function register()
    {
        foreach (self::services() as $class) {
            $service = self::instance($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    public static function instance($class)
    {
        return new $class();
    }
}
