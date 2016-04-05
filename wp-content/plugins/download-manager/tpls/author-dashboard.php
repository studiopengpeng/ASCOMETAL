<div class="w3eden">
    <?php if (is_user_logged_in()) {

        $menu_url = get_permalink(get_the_ID()).'/%s/';
        if(isset($params['flaturl']) && $params['flaturl'] == 0)
            $menu_url = get_permalink(get_the_ID()).$sap.'adb_page=%s';
    ?>

    <ul id="tabs" class="nav nav-pills nav-justified wpdm-frontend-tabs" style="margin: 0;padding: 0">
        <li><a class="<?php if ($task == '' || $task == 'edit-package') { ?>active<?php } ?>" href="<?php echo $burl; ?>"><?php _e('All Items','wpdmpro'); ?></a></li>
        <li><a class="<?php if ($task == 'add-new') { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", "add-new"); ?>"><?php _e('Add New','wpdmpro'); ?></a></li>
        <?php foreach ($tabs as $tid => $tab): ?>
            <li><a class="<?php if ($task == $tid) { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", $tid); ?>"><?php echo $tab['label']; ?></a></li>
        <?php endforeach; ?>
        <li><a class="<?php if ($task == 'edit-profile') { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", "edit-profile"); ?>"><?php _e('Edit Profile','wpdmpro'); ?></a></li>
        <li><a class="" href="<?php echo sprintf("$menu_url", "logout"); ?>"><?php _e('Logout','wpdmpro'); ?></a></li>
    </ul>

    <div class="tab-content" style="background: transparent;border: 0;padding: 0">
<?php }
if (is_user_logged_in()) {
    if ($task == 'add-new' || $task == 'edit-package')
        include(wpdm_tpl_path('wpdm-add-new-file-front.php'));
    else if ($task == 'edit-profile')
        include(wpdm_tpl_path('wpdm-edit-user-profile.php'));
    else if ($task != '' && isset($tabs[$task]['callback']) && $tabs[$task]['callback'] != '')
        call_user_func($tabs[$task]['callback']);
    else if ($task != '' && isset($tabs[$task]['shortcode']) && $tabs[$task]['shortcode'] != '')
        echo do_shortcode($tabs[$task]['shortcode']);
    else
        include(wpdm_tpl_path('wpdm-list-files-front.php'));
} else {

    include(wpdm_tpl_path('wpdm-be-member.php'));
}
?>
    </div>
    <script>jQuery(function($){ $("#tabs > li > a").click(function(){ location.href=this.href; });  });</script>

<?php if (is_user_logged_in()) echo "</div>";