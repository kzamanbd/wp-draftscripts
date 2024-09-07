<div class="wrap">
    <?=$name?> is the name of the plugin. It will be displayed in the WordPress admin dashboard.

    <form method="post" action="options.php">
        <?php settings_fields( 'draftscripts_settings' );?>
        <?php do_settings_sections( 'draftscripts' );?>
        <?php submit_button();?>
    </form>

</div>