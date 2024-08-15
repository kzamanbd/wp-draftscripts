<?php

namespace WpDraftScripts\Actions;

class Activate
{
    public function register()
    {
        (new CustomPostType())->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();

        if (get_option('draftscripts')) {
            return;
        }

        $default = [];

        update_option('draftscripts', $default);
    }
}
