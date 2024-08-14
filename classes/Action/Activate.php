<?php

namespace WpDraftscripts\Action;

class Activate
{
    public function register()
    {
        (new CustomPostType())->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }
}
