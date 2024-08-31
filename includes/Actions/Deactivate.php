<?php

namespace WpDraftScripts\Actions;

class Deactivate
{
    public function register()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}
