<?php
session_start();

//echo "<pre>",print_r($ds_sach_ban_chay_nhat),"</pre>";
?>
<html>
<head>
	<?php include_once("widgets/head.php"); ?>
</head>
<body>
	<div class="container-fluid">
		<!-- slide banner -->
		<?php include_once('modules/mod_slide_banner.php'); ?>
		<!-- END slide banner -->

		<!-- menu bar -->
		<?php include_once('modules/mod_menu.php'); ?>
		<!-- END menu bar -->

		<!-- module liên hệ -->
		<?php include_once('modules/mod_form_lien_he.php'); ?>
		<!-- END module liên hệ  -->

	</div>
	
	<!-- footer -->
	<?php include_once("widgets/footer.php"); ?>
	<!-- END footer -->
</body>
</html>