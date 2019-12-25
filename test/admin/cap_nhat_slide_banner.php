<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_slide_banner.php");
$xl_slide_banner = new xl_slide_banner();



if($_GET["id"])
{
	$thong_tin_slide_banner = $xl_slide_banner->thong_tin_slide_banner_theo_id($_GET["id"]);	
}


//echo "<pre>",print_r($_POST),"</pre>";
//echo "<pre>",print_r($_FILES),"</pre>";

if($_POST)
{
	//
	if ($_FILES["hinh_slide_banner"]["error"] > 0 && $thong_tin_slide_banner->hinh == "")
    {
        echo "<script>alert('Lỗi upload file: " . $_FILES["hinh_slide_banner"]["error"] . "');</script>";
    }
    else if($_FILES["hinh_slide_banner"]["name"] != "")
    {
        $loai_file = explode('.',$_FILES["hinh_slide_banner"]["name"]);
        //print_r($loai_file);
        //echo $loai_file[count($loai_file)-1];
        if(strtolower($loai_file[count($loai_file)-1]) != 'png' && strtolower($loai_file[count($loai_file)-1]) != 'jpg' && strtolower($loai_file[count($loai_file)-1]) != 'gif')
        {
            echo '<script>alert("Loại file không phù hợp. Bạn hãy kiểm tra lại! Cám ơn");</script>';
        }
        else
        {
            move_uploaded_file($_FILES["hinh_slide_banner"]["tmp_name"], "../images/slide_banner/" . $_FILES["hinh_slide_banner"]["name"]);
        }
    }

    if(!$_GET["id"])
    {
		$ket_qua = $xl_slide_banner->them_slide_banner_moi($_POST["ten_slide"], $_FILES["hinh_slide_banner"]["name"], $_POST["trang_thai"]);
		if($ket_qua)
		{
			echo "<script>alert('Thêm thành công slide banner mới!')</script>";
			echo "<script>window.location = 'danh_sach_slide_banner.php'</script>";
		}
		else
		{
			echo "<script>alert('Có lỗi xảy ra trong quá trình thêm!')</script>";
		}
	}
	else
	{
		if($_FILES["hinh_slide_banner"]["name"] != "")
		{
			$hinh = $_FILES["hinh_slide_banner"]["name"];
		}
		else
		{
			$hinh = $thong_tin_slide_banner->hinh;
		}

		$ket_qua = $xl_slide_banner->cap_nhat_slide_banner($thong_tin_slide_banner->id,$_POST["ten_slide"], $hinh, $_POST["trang_thai"]);

		if($ket_qua)
		{
			echo "<script>alert('Cập nhật thành công slide banner!')</script>";
			echo "<script>window.location = 'danh_sach_slide_banner.php'</script>";
		}
		else
		{
			echo "<script>alert('Có lỗi xảy ra trong quá trình cập nhật!')</script>";
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
							<?php if($_GET["id"]) echo "Cập nhật slide banner #".$_GET["id"]; else echo "Thêm slide banner mới"; ?>
						</div>
						<div class="panel-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label>Tên slide:</label>
										<input name="ten_slide" class="form-control" value="<?php if($_POST["ten_slide"]) echo $_POST["ten_slide"]; else echo $thong_tin_slide_banner->ten_slide; ?>" placeholder="Tên slide">
									</div>
									<div class="form-group">
										<label>Trạng thái:</label>
										<select name="trang_thai" class="form-control">
											<option <?php if($_POST["trang_thai"] === 1) echo "selected "; else if($thong_tin_slide_banner->trang_thai == 1) echo "selected "; ?> value="1">Hiển thị</option>
											<option <?php if($_POST["trang_thai"] === 0) echo "selected "; else if($thong_tin_slide_banner->trang_thai == 0) echo "selected "; ?> value="0">Không hiển thị</option>
										</select>
									</div>
									<div class="form-group">
										<label>Hình slide banner:</label>
										<input name="hinh_slide_banner" id="hinh_slide_banner" type="file">
										<div id="image-holder">
											<?php if($thong_tin_slide_banner) echo " <img src='../images/slide_banner/".$thong_tin_slide_banner->hinh."' />"; ?>
										</div>
										<script>
										$("#hinh_slide_banner").on('change', function () {
									 
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
										<?php if($_GET["id"]) echo "Cập nhật"; else echo "Thêm slide banner mới"; ?>
									</button>
									
									<a href="danh_sach_slide_banner.php">
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
