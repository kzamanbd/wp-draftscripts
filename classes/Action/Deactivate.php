<?php

namespace WpDraftScripts\Action;

class Deactivate
{
    public function register()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}
