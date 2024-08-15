<?php


namespace WpDraftScripts\Callbacks;

use WpDraftScripts\Support\BasePlugin;

class AdminCallbacks extends BasePlugin
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
        return $input;
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

        $name = $args['label_for'];
        $class = $classes[$args['class']] ?? $args['class'];
        $option_name = $args['option_name'];
        $value = esc_attr(get_option($option_name));
        $type = isset($args['type']) ? $args['type'] : 'text';

        $placeholder = isset($args['placeholder']) ? $args['placeholder'] : 'Write something here';
        switch ($type) {
            case 'textarea':
                echo "<textarea id='$name' name='$option_name' class='$class' placeholder='$placeholder'>$value</textarea>";
                break;
            case 'checkbox':
                echo "<input type='checkbox' id='$name' name='$option_name' value='1' class='$class' " . ($value == 1 ? 'checked' : '') . ">";
                break;
            default:
                echo "<input type='text' id='$name' name='$option_name' value='$value' class='$class' placeholder='$placeholder'>";
        }
    }
}
