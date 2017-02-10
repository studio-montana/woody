<?php

require_once (get_template_directory().'/inc/installer/uploader.class.php');
if (is_admin()){
    new WoodyUploader(WOODY_THEME_FILE, WOODY_THEME_NAME);
}

?>