<?php

namespace WpDraftScripts\Actions;

use WpDraftScripts\Services\CustomPostType;

class Activate
{
    public function register()
    {
        (new CustomPostType())->register();
        // flush rewrite rules
        flush_rewrite_rules();

        if (get_option('draftscripts')) {
            return;
        }

        $default = [];

        update_option('draftscripts', $default);
    }
}
