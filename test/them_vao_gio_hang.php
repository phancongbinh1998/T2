<?php
session_start();
include_once('libraries/xl_sach.php');

$xl_sach = new xl_sach();

function them_so_luong_vao_gio_hang($id_sach, $so_luong = 1)
{
	$xl_sach = new xl_sach();
	
	if($_SESSION["gio_hang"])
	{
		$mang_gio_hang = $_SESSION["gio_hang"];
	}
	else
	{
		$mang_gio_hang = array();
	}


	//kiểm tra sách có tồn tại trong CSDL hay không?
	$thong_tin_sach_add_gio_hang = $xl_sach->thong_tin_sach_theo_id($id_sach);
	//print_r($thong_tin_sach_add_gio_hang);
	if($thong_tin_sach_add_gio_hang)
	{

		foreach($mang_gio_hang as $mat_hang)
		{
			if($mat_hang->id == $thong_tin_sach_add_gio_hang->id)
			{
				$kiem_tra = 1;
				$mat_hang->so_luong += $so_luong;
			}
		}

		if(!$kiem_tra)
		{
			$thong_tin_sach_add_gio_hang->so_luong = $so_luong;
			$mang_gio_hang[] = $thong_tin_sach_add_gio_hang;
		}

		$_SESSION["gio_hang"] = $mang_gio_hang;

		header("location: ". $_SERVER["HTTP_REFERER"]);
	}
	else
	{
		header("location: index.php");
	}
}

if($_GET["id_sach"])
{
	$id_sach = $_GET["id_sach"];
	them_so_luong_vao_gio_hang($id_sach);
}
else if($_POST["id_sach"])
{
	$id_sach = $_POST["id_sach"];
	them_so_luong_vao_gio_hang($id_sach, $_POST["so_luong_mua"]);
}
else
{
	header("location: index.php");
}
?>