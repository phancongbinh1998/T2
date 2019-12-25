<?php
	include_once("libraries/xl_nguoi_dung.php");
	$xl_nguoi_dung = new xl_nguoi_dung();

	if($_POST)
	{
		//kiểm tra xem tài khoản đã tồn tại hay chưa?
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
			if($_POST["mat_khau"] == $_POST["re_mat_khau"])
			{
				//upload avatar
				if ($_FILES["avatar"]["error"] > 0)
                {
                    echo "<script>alert('Lỗi upload file: " . $_FILES["avatar"]["error"] . "');</script>";
                }
                else 
                {
                    $loai_file = explode('.',$_FILES["avatar"]["name"]);
                    //print_r($loai_file);
                    //echo $loai_file[count($loai_file)-1];
                    if(strtolower($loai_file[count($loai_file)-1]) != 'png' && strtolower($loai_file[count($loai_file)-1]) != 'jpg' && strtolower($loai_file[count($loai_file)-1]) != 'gif')
                    {
                        echo '<script>alert("Loại file không phù hợp. Bạn hãy kiểm tra lại! Cám ơn");</script>';
                    }
                    else
                    {
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], "images/avatar/" . $_FILES["avatar"]["name"]);
                        //echo "<br/><label style='color: #ff0000; padding-top: 10px;'>Upload file thành công: " . $_FILES["avatar"]["name"] . "</label>";
                    }
                }

				$ket_qua = $xl_nguoi_dung->them_nguoi_dung($_POST["email"],$_POST["tai_khoan"],$_POST["mat_khau"],$_POST["ho_ten"],$_POST["ngay_sinh"],$_POST["dia_chi"],$_FILES["avatar"]["name"]);
				if($ket_qua)
				{
					echo '<script>alert("Chúc mừng bạn đã đăng ký thành công!");</script>';
					echo '<script>window.location = "index.php"</script>';
				}
			}
			else
			{
				echo "<script>alert('Mật khẩu xác nhận không chính xác!')</script>";
			}
		}
	}
?>
<section class="container-fluid">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div id="image-holder"></div>
		<img id="avatar_image" style="width: 100%;" src="images/no_image.png" />
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
			<div class="form-group">
				<legend>Đăng ký làm thành viên</legend>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Họ tên
				</div>
				<div class="col-md-9">
					<input type="text" name="ho_ten" id="ho_ten" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Tài khoản
				</div>
				<div class="col-md-9">
					<input type="text" name="tai_khoan" id="tai_khoan" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Email
				</div>
				<div class="col-md-9">
					<input type="text" name="email" id="email" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Mật khẩu
				</div>
				<div class="col-md-9">
					<input type="password" name="mat_khau" id="mat_khau" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Xác nhận mật khẩu
				</div>
				<div class="col-md-9">
					<input type="password" name="re_mat_khau" id="re_mat_khau" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Chọn hình Avatar
				</div>
				<div class="col-md-9">
					<input id="fileUpload" name="avatar" type="file" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Ngày sinh
				</div>
				<div class="col-md-9">
					<input type="date" name="ngay_sinh" id="ngay_sinh" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Điện thoại
				</div>
				<div class="col-md-9">
					<input type="text" name="dien_thoai" id="dien_thoai" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					Địa chỉ
				</div>
				<div class="col-md-9">
					<input type="text" name="dia_chi" id="dia_chi" class="form-control" value="" required="required" title="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-9 col-sm-offset-3">
					<button type="submit" class="btn btn-primary" style="padding: 5px 30px">Đăng ký</button>
				</div>
			</div>
		</form>
	</div>
</section>

<script>
	$("#fileUpload").on('change', function () {

	     //Get count of selected files
	     var countFiles = $(this)[0].files.length;

	     var imgPath = $(this)[0].value;
	     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	     var image_holder = $("#image-holder");
	     image_holder.empty();

	     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	         if (typeof (FileReader) != "undefined") {

	             //loop for each file selected for uploaded.
	             for (var i = 0; i < countFiles; i++) {

	                 var reader = new FileReader();
	                 reader.onload = function (e) {
	                     /*
	                     $("<img />", {
	                         "src": e.target.result,
	                             "class": "thumb-image"
	                     }).appendTo(image_holder);
						*/
						$("#avatar_image").attr("src", e.target.result);
	                 }

	                 image_holder.show();
	                 reader.readAsDataURL($(this)[0].files[i]);
	             }

	         } else {
	             alert("Trình duyệt không hỗ trợ đọc file");
	         }
	     } else {
	         alert("File bạn chọn không phải là hình ảnh, vui lòng chọn lại");
	     }
	});
</script>