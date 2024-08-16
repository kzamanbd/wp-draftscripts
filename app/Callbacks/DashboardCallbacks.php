<?php


namespace WpDraftScripts\Callbacks;

use WpDraftScripts\Support\BasePlugin;

class DashboardCallbacks extends BasePlugin
{

    public function dashboard()
    {
        $this->view('index', [
            'name' => 'Kamruzzaman'
        ]);
    }

    public function settings()
    {
        $this->view('settings', [
            'name' => 'Kamruzzaman'
        ]);
    }


    public function checkboxSanitize($input)
    {
        $output = [];

        foreach ($this->optionsManagers as $key => $value) {
            $output[$key] = isset($input[$key]) ? true : false;
        }
        return $output;
    }

    public function addedSectionGroup()
    {
        echo 'Set your settings here';
    }

    public function addedField($args)
    {

        $classes = [
            'checkbox' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'
        ];
        $type = $args['type'] ?? 'text';
        $placeholder = $args['placeholder'] ?? 'Write something here';

        $name = $args['label_for'];
        $class = $classes[$args['class']] ?? $args['class'];
        $option_name = $args['option_name'];
        $value = get_option($option_name);

        switch ($type) {
            case 'textarea':
                echo sprintf(
                    "<textarea id='%s' name='%s' class='%s' placeholder='%s'>%s</textarea>",
                    $name,
                    $option_name . '[' . $name . ']',
                    $class,
                    $placeholder,
                    $value[$name]
                );
                break;

            case 'checkbox':
                $checked = isset($value[$name]) && $value[$name] == 1 ? 'checked' : '';
                echo sprintf(
                    "<input type='checkbox' id='%s' name='%s' value='1' class='%s' %s>",
                    $name,
                    $option_name . '[' . $name . ']',
                    $class,
                    $checked
                );
                break;

            default:
                echo sprintf(
                    "<input type='%s' id='%s' name='%s' value='%s' class='%s' placeholder='%s'>",
                    $type,
                    $name,
                    $option_name . '[' . $name . ']',
                    $value[$name],
                    $class,
                    $placeholder
                );
        }
    }
}
