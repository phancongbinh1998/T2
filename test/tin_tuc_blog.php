<?php
session_start();
include_once('libraries/xl_tin_tuc.php');
include_once('libraries/pager.php');

//print_r($_SESSION["gio_hang"]);
$phan_trang = new phan_trang();


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

		<!-- list sách  theo loại -->
		<?php include_once('modules/mod_list_tin_tuc.php'); ?>
		<!-- END list sách theo loại -->
	</div>
	
	<!-- footer -->
	<?php include_once("widgets/footer.php"); ?>
	<!-- END footer -->
</body>
</html>