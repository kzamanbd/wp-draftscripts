<?php

namespace WpDraftScripts;

use WpDraftScripts\Action\CustomPostType;
use WpDraftScripts\Action\Enqueue;
use WpDraftScripts\Action\Pages;
use WpDraftScripts\Action\SettingsLink;
use WpDraftScripts\Services\AdminServices;

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
            Pages::class,
            Enqueue::class,
            SettingsLink::class,
            CustomPostType::class,
            AdminServices::class,
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
