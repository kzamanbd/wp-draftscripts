<?php

namespace WpDraftscripts\Action;

class CustomPostType
{
    public function register()
    {
        add_action('init', array($this, 'custom_post_type'));
    }

    public function custom_post_type()
    {
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }
}
