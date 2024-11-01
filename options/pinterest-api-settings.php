<?php
if ( ! defined( 'ABSPATH' ) ) exit;
	$wl_pffree_options = weblizar_pffree_get_options();
	$pint_app_id = $wl_pffree_options['PFFREE_App_Id'];
	$pint_secret_key = $wl_pffree_options['PFFREE_App_Seceret_Key'];
	$myhomeurl = site_url()."/wp-admin/admin.php?page=pffree-weblizar";

	if(isset($wl_pffree_options['PFFREE_App_Id'])) { $pint_app_id = $wl_pffree_options['PFFREE_App_Id']; } else {
		$pint_app_id = 123;
	}
	if(isset($wl_pffree_options['PFFREE_App_Seceret_Key'])) { $pint_secret_key = $wl_pffree_options['PFFREE_App_Seceret_Key']; } else {
		$pint_secret_key = 456;
	}

	define('PINTEREST_APPLICATION_ID', $pint_app_id);

	define('PINTEREST_APPLICATION_SECRET', $pint_secret_key);

	define('PINTEREST_REDIRECT_URI',$myhomeurl);
