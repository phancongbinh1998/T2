<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_nguoi_dung.php");
$xl_nguoi_dung = new xl_nguoi_dung();

$ds_loai_nguoi_dung = $xl_nguoi_dung->danh_sach_loai_nguoi_dung();

if($_GET["id"])
{
	$thong_tin_nguoi_dung = $xl_nguoi_dung->thong_tin_nguoi_dung_theo_id($_GET["id"]);	
}


//echo "<pre>",print_r($_POST),"</pre>";
//echo "<pre>",print_r($_FILES),"</pre>";

if($_POST)
{
	//
	if ($_FILES["avatar_nguoi_dung"]["error"] > 0 && $thong_tin_nguoi_dung->avatar == "")
    {
        echo "<script>alert('Lỗi upload file: " . $_FILES["avatar_nguoi_dung"]["error"] . "');</script>";
    }
    else if($_FILES["avatar_nguoi_dung"]["name"] != "")
    {
        $loai_file = explode('.',$_FILES["avatar_nguoi_dung"]["name"]);
        //print_r($loai_file);
        //echo $loai_file[count($loai_file)-1];
        if(strtolower($loai_file[count($loai_file)-1]) != 'png' && strtolower($loai_file[count($loai_file)-1]) != 'jpg' && strtolower($loai_file[count($loai_file)-1]) != 'gif')
        {
            echo '<script>alert("Loại file không phù hợp. Bạn hãy kiểm tra lại! Cám ơn");</script>';
        }
        else
        {
            move_uploaded_file($_FILES["avatar_nguoi_dung"]["tmp_name"], "../images/avatar/" . $_FILES["avatar_nguoi_dung"]["name"]);
        }
    }

    if(!$_GET["id"])
    {
    	$tt_nguoi_dung = $xl_nguoi_dung->thong_tin_nguoi_dung_theo_ten_dang_nhap($_POST["tai_khoan"]);
		$tt_nguoi_dung_theo_email = $xl_nguoi_dung->thong_tin_nguoi_dung_theo_email($_POST["email"]);

		if($tt_nguoi_dung)
		{
			echo "<script>alert('Tài khoản này đã có người sử dụng bạn vui lòng chọn tài khoản khác!')</script>";
		}
		else if($tt_nguoi_dung_theo_email)
		{
			echo "<script>alert('Email này đã được sử dụng rồi!')</script>";
		}
		else
		{
			$ket_qua = $xl_nguoi_dung->them_nguoi_dung($_POST["email"],$_POST["tai_khoan"],$_POST["mat_khau"],$_POST["ho_ten"],$_POST["ngay_sinh"],$_POST["dia_chi"],$_FILES["avatar_nguoi_dung"]["name"], $_POST["dien_thoai"], $_POST["id_loai_user"]);
			if($ket_qua)
			{
				echo "<script>alert('Thêm thành công người dùng mới!')</script>";
				echo "<script>window.location = 'danh_sach_nguoi_dung.php'</script>";
			}
			else
			{
				echo "<script>alert('Có lỗi xảy ra trong quá trình thêm!')</script>";
			}
		}
	}
	else
	{
		$tt_nguoi_dung = $xl_nguoi_dung->thong_tin_nguoi_dung_theo_ten_dang_nhap($_POST["tai_khoan"]);
		$tt_nguoi_dung_theo_email = $xl_nguoi_dung->thong_tin_nguoi_dung_theo_email($_POST["email"]);

		if($tt_nguoi_dung  && $tt_nguoi_dung->id != $thong_tin_nguoi_dung->id)
		{
			echo "<script>alert('Tài khoản này đã có người sử dụng bạn vui lòng chọn tài khoản khác!')</script>";
		}
		else if($tt_nguoi_dung_theo_email && $tt_nguoi_dung->id != $thong_tin_nguoi_dung->id)
		{
			echo "<script>alert('Email này đã được sử dụng rồi!')</script>";
		}
		else
		{
			if($_FILES["avatar_nguoi_dung"]["name"] != "")
			{
				$avatar = $_FILES["avatar_nguoi_dung"]["name"];
			}
			else
			{
				$avatar = $thong_tin_nguoi_dung->avatar;
			}

			$ket_qua = $xl_nguoi_dung->cap_nhat_nguoi_dung($thong_tin_nguoi_dung->id, $_POST["email"],$_POST["tai_khoan"],$_POST["mat_khau"],$_POST["ho_ten"],$_POST["ngay_sinh"],$_POST["dia_chi"], $avatar, $_POST["dien_thoai"], $_POST["id_loai_user"]);

			if($ket_qua)
			{
				echo "<script>alert('Cập nhật thành công người dùng!')</script>";
				echo "<script>window.location = 'danh_sach_nguoi_dung.php'</script>";
			}
			else
			{
				echo "<script>alert('Có lỗi xảy ra trong quá trình cập nhật!')</script>";
			}
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<!-- include head -->
	<?php include_once("widgets/head.php"); ?>
	<!-- END include head -->

</head>

<body>
	<!-- include menu top -->

	<?php include_once("widgets/menu_top.php"); ?>

	<!-- END include menu top -->

		
	<!-- include side bar -->

	<?php include_once("widgets/side_bar.php"); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<!--div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div--><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý giao diện</h1>
			</div>
		</div><!--/.row-->
		<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<?php if($_GET["id"]) echo "Cập nhật người dùng #".$_GET["id"]; else echo "Thêm người dùng mới"; ?>
						</div>
						<div class="panel-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label>Tài khoản:</label>
										<input name="tai_khoan" class="form-control" value="<?php if($_POST["tai_khoan"]) echo $_POST["tai_khoan"]; else echo $thong_tin_nguoi_dung->tai_khoan; ?>" placeholder="Tài khoản">
									</div>
									<div class="form-group">
										<label>Email:</label>
										<input name="email" class="form-control" value="<?php if($_POST["email"]) echo $_POST["email"]; else echo $thong_tin_nguoi_dung->email; ?>" placeholder="Email">
									</div>
									<div class="form-group">
										<label>Họ tên:</label>
										<input name="ho_ten" class="form-control" value="<?php if($_POST["ho_ten"]) echo $_POST["ho_ten"]; else echo $thong_tin_nguoi_dung->ho_ten; ?>" placeholder="Họ tên">
									</div>
									<div class="form-group">
										<label>Mật khẩu:</label>
										<input name="mat_khau" type="password" class="form-control" value="<?php if($_POST["mat_khau"]) echo $_POST["mat_khau"]; else echo $thong_tin_nguoi_dung->mat_khau; ?>" placeholder="Mật khẩu">
									</div>
									<div class="form-group">
										<label>Địa chỉ:</label>
										<input name="dia_chi" class="form-control" value="<?php if($_POST["dia_chi"]) echo $_POST["dia_chi"]; else echo $thong_tin_nguoi_dung->dia_chi; ?>" placeholder="Địa chỉ">
									</div>
									<div class="form-group">
										<label>Điện thoại:</label>
										<input name="dien_thoai" class="form-control" value="<?php if($_POST["dien_thoai"]) echo $_POST["dien_thoai"]; else echo $thong_tin_nguoi_dung->dien_thoai; ?>" placeholder="Điện thoại">
									</div>
									<div class="form-group">
										<label>Quyền hạn:</label>
										<select name="id_loai_user" class="form-control">
											<?php
											foreach($ds_loai_nguoi_dung as $loai_nguoi_dung)
											{
											?>
											<option <?php if($loai_nguoi_dung->id == $thong_tin_nguoi_dung->id_loai_user) echo "selected"; ?> value="<?php echo $loai_nguoi_dung->id ?>"><?php echo $loai_nguoi_dung->ten_loai_nguoi_dung ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Avatar người dùng:</label>
										<input name="avatar_nguoi_dung" id="avatar_nguoi_dung" type="file">
										<div id="image-holder">
											<?php if($thong_tin_nguoi_dung) echo " <img src='../images/avatar/".$thong_tin_nguoi_dung->avatar."' />"; ?>
										</div>
										<script>
										$("#avatar_nguoi_dung").on('change', function () {
									 
									        if (typeof (FileReader) != "undefined") {
									 
									            var image_holder = $("#image-holder");
									            image_holder.empty();
									 
									            var reader = new FileReader();
									            reader.onload = function (e) {
									                $("<img />", {
									                    "src": e.target.result,
									                    "class": "thumb-image"
									                }).appendTo(image_holder);
									 
									            }
									            image_holder.show();
									            reader.readAsDataURL($(this)[0].files[0]);
									        } else {
									            alert("This browser does not support FileReader.");
									        }
									    });
										</script>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
									
									<button type="submit" class="btn btn-primary">
										<?php if($_GET["id"]) echo "Cập nhật"; else echo "Thêm người dùng mới"; ?>
									</button>
									
									<a href="danh_sach_nguoi_dung.php">
										<button type="button" class="btn btn-danger">
											Hủy thao tác
										</button>
									</a>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</body>

</html>
