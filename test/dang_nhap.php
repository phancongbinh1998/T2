<meta charset="utf-8"/>
<?php
	session_start();
	include_once("libraries/xl_nguoi_dung.php");
	$xl_nguoi_dung = new xl_nguoi_dung();
	//echo md5(123456);
	if($_POST["ten_dang_nhap"] && $_POST["mat_khau"])
	{
		$thong_tin_nguoi_dung = $xl_nguoi_dung->thong_tin_nguoi_dung_theo_ten_dang_nhap($_POST["ten_dang_nhap"]);
		if($thong_tin_nguoi_dung)
		{
			if($thong_tin_nguoi_dung->mat_khau == md5($_POST["mat_khau"]))
			{
				$_SESSION["nguoi_dung"] = $thong_tin_nguoi_dung;
				echo "<script>alert('Đăng nhập thành công')</script>";
				echo "<script>window.location = '" . $_SERVER["HTTP_REFERER"] . "'</script>";
			}
			else
			{
				echo "<script>alert('Mật khẩu hoặc tài khoản không đúng, bạn vui lòng kiểm tra lại!')</script>";
				echo "<script>window.location = '" . $_SERVER["HTTP_REFERER"] . "'</script>";
			}
		}
		else
		{
			echo "<script>alert('Tài khoản không tồn tại, bạn vui lòng kiểm tra lại!')</script>";
			echo "<script>window.location = '" . $_SERVER["HTTP_REFERER"] . "'</script>";
		}
	}
	else
	{
		header("location: ". $_SERVER["HTTP_REFERER"]);
	}
?>