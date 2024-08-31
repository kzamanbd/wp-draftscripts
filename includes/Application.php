<?php

namespace WpDraftScripts;

use DirectoryIterator;
use WpDraftScripts\Actions\Dashboard;
use WpDraftScripts\Actions\Enqueue;
use WpDraftScripts\Actions\SettingsLink;

class Application
{

    public static function init()
    {
        self::register();
        return self::instance(__CLASS__);
    }
    /**
     * List of actions to be registered
     * @return array
     */
    public static function actions()
    {
        return [
            Enqueue::class,
            SettingsLink::class,
            Dashboard::class
        ];
    }

    /**
     * Register all services
     * @return void
     */

    public static function services()
    {
        $serviceDir = __DIR__ . '/Services/';

        // Iterate over each PHP file in the Services directory
        foreach (new DirectoryIterator($serviceDir) as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getExtension() === 'php') {
                // Get the class name without the .php extension
                $className = __NAMESPACE__ . '\\Services\\' . $fileInfo->getBasename('.php');
                // Check if the class exists
                if (class_exists($className)) {
                    $service = new $className();
                    // Check if the class has a register method and call it
                    if (method_exists($service, 'register')) {
                        $service->register();
                    }
                }
            }
        }
    }

    /**
     * Register all services
     * @return void
     */
    public static function register()
    {
        foreach (self::actions() as $class) {
            $service = self::instance($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }

        self::services();

        return self::instance(__CLASS__);
    }

    public static function instance($class)
    {
        return new $class();
    }
}
