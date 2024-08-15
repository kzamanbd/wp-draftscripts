<div class="wrap">
    <h1>Hello World from WP DraftScripts Dashboard</h1>

    Now, let’s create a new file called wp-draftscripts.php in the root directory of the plugin. This file will be the main file of the plugin. Add the following code to it:

    <?= $name ?> is the name of the plugin. It will be displayed in the WordPress admin dashboard.

    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php settings_fields('draftscripts_options_group'); ?>

        <?php do_settings_sections('draftscripts'); ?>
        <?php submit_button(); ?>
    </form>
</div>