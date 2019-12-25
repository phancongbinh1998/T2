<?php 
    session_start();	
	if($_SESSION['ten_dang_nhap'] && $_SESSION['id_nguoidung'])
		echo 1;//json_encode(array('responsive'=>'success'));
	else
		echo 0;//json_encode(array('responsive'=>'error'));
?>