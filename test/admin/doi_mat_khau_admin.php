<meta charset="utf-8" />
<?php
	session_start();
	if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
	{
		header("location: login.php");
	}

	include_once("../libraries/xl_nguoi_dung.php");
	$xl_nguoi_dung = new xl_nguoi_dung();

	//print_r($_POST);
	if(md5($_POST["mat_khau"]) == $_SESSION["nguoi_dung"]->mat_khau)
	{
		if($_POST["mat_khau_moi"] == $_POST["re_mat_khau_moi"])
		{
			$ket_qua = $xl_nguoi_dung->doi_mat_khau($_SESSION["nguoi_dung"]->id, $_POST["mat_khau_moi"]);
			if($ket_qua)
			{
				echo "<script>alert('Bạn đã đổi mật khẩu thành công!')</script>";
				echo "<script>window.location = '".$_SERVER["HTTP_REFERER"]."'</script>";
			}
		}
		else
		{
			echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu mới không giống nhau!')</script>";
			echo "<script>window.location = '".$_SERVER["HTTP_REFERER"]."'</script>";
		}
	}
	else
	{
		echo "<script>alert('Bạn nhập mật khẩu cũ không chính xác!')</script>";
		echo "<script>window.location = '".$_SERVER["HTTP_REFERER"]."'</script>";
	}
	
?>