<?php
	session_start();
	include_once("../libraries/xl_nguoi_dung.php");
	$xl_nguoi_dung = new xl_nguoi_dung();
	//echo md5(123456);
	if($_POST["ten_dang_nhap"] && $_POST["mat_khau"])
	{
		$thong_tin_nguoi_dung = $xl_nguoi_dung->thong_tin_nguoi_dung_quan_tri_theo_ten_dang_nhap($_POST["ten_dang_nhap"]);
		if($thong_tin_nguoi_dung)
		{
			if($thong_tin_nguoi_dung->mat_khau == md5($_POST["mat_khau"]))
			{
				$_SESSION["nguoi_dung"] = $thong_tin_nguoi_dung;
				echo "<script>alert('Đăng nhập thành công')</script>";
				echo "<script>window.location = 'index.php'</script>";
			}
			else
			{
				echo "<script>alert('Mật khẩu hoặc tài khoản không đúng, bạn vui lòng kiểm tra lại!')</script>";
				//echo "<script>window.location = '" . $_SERVER["HTTP_REFERER"] . "'</script>";
			}
		}
		else
		{
			echo "<script>alert('Tài khoản không tồn tại, bạn vui lòng kiểm tra lại!')</script>";
			//echo "<script>window.location = '" . $_SERVER["HTTP_REFERER"] . "'</script>";
		}
	}
	else
	{
		//header("location: ". $_SERVER["HTTP_REFERER"]);
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Quản trị web Bookstore</div>
				<div class="panel-body">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<div class="hieu_ung_o_khoa">
							<img src="../images/o_khoa.jpg" style="width: 100%;" />
						</div>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
						<form role="form" action="" method="post">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Tài khoản" name="ten_dang_nhap" type="text" autofocus="">
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Mật khẩu" name="mat_khau" type="password" value="">
								</div>
								<!--div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div-->
								<button type="submit" class="btn btn-primary">Đăng nhập</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
