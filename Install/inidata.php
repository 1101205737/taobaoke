<?php
/////setting
$site_options="('site_seo_description', '小草淘宝客', ''),('site_seo_keywords', '小草淘宝客', ''),('site_seo_title', '小草淘宝客', ''),('site_logo', '', ''),('site_name', '小草淘宝客', ''),('site_domain', '/', ''),('site_admin_email', '', ''),('site_icp', '', ''),('site_tongji', '', ''),('site_copyright', '', ''),('tb_api_key', '', ''),('tb_api_secret', '', ''),('html_suffix', '.html', ''),('url_mod', '2', ''),('score_login', '10', ''),('score_sign', '20', ''),('score_sign2', '35', ''),('smail_address', '', ''),('smail_smtp', '', ''),('smail_username', '', ''),('smail_password', '', ''),('tb_api_pid', '', ''),('online_kefu', '', ''),('hot_line', '', ''),('theme', 'wh', ''),";
$site_options .= "('score_share', '0', '')";
mysql_query("INSERT INTO `{$dbPrefix}setting` (setting_key,setting_val,intro) VALUES {$site_options}");
/////
?>