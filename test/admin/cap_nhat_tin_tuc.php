<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_tin_tuc.php");
$xl_tin_tuc = new xl_tin_tuc();



if($_GET["id"])
{
	$thong_tin_tin_tuc = $xl_tin_tuc->thong_tin_tin_tuc_theo_id($_GET["id"]);	
}


//echo "<pre>",print_r($_POST),"</pre>";
//echo "<pre>",print_r($_FILES),"</pre>";

if($_POST)
{
	//
	if ($_FILES["hinh_dai_dien"]["error"] > 0 && $thong_tin_tin_tuc->hinh == "")
    {
        echo "<script>alert('Lỗi upload file: " . $_FILES["hinh_dai_dien"]["error"] . "');</script>";
    }
    else if($_FILES["hinh_dai_dien"]["name"] != "")
    {
        $loai_file = explode('.',$_FILES["hinh_dai_dien"]["name"]);
        //print_r($loai_file);
        //echo $loai_file[count($loai_file)-1];
        if(strtolower($loai_file[count($loai_file)-1]) != 'png' && strtolower($loai_file[count($loai_file)-1]) != 'jpg' && strtolower($loai_file[count($loai_file)-1]) != 'gif')
        {
            echo '<script>alert("Loại file không phù hợp. Bạn hãy kiểm tra lại! Cám ơn");</script>';
        }
        else
        {
            move_uploaded_file($_FILES["hinh_dai_dien"]["tmp_name"], "../images/tin_tuc/" . $_FILES["hinh_dai_dien"]["name"]);
        }
    }

    if(!$_GET["id"])
    {
		$ket_qua = $xl_tin_tuc->them_tin_tuc_moi($_POST["tieu_de_tin"], $_FILES["hinh_dai_dien"]["name"], $_POST["noi_dung_tom_tat"],$_POST["noi_dung_chi_tiet"], $_POST["trang_thai"]);
		if($ket_qua)
		{
			echo "<script>alert('Thêm thành công tin tức mới!')</script>";
			echo "<script>window.location = 'danh_sach_tin_tuc.php'</script>";
		}
		else
		{
			echo "<script>alert('Có lỗi xảy ra trong quá trình thêm!')</script>";
		}
	}
	else
	{
		if($_FILES["hinh_dai_dien"]["name"] != "")
		{
			$hinh = $_FILES["hinh_dai_dien"]["name"];
		}
		else
		{
			$hinh = $thong_tin_tin_tuc->hinh_dai_dien;
		}

		$ket_qua = $xl_tin_tuc->cap_nhat_tin_tuc($thong_tin_tin_tuc->id,$_POST["tieu_de_tin"], $hinh,$_POST["noi_dung_tom_tat"],$_POST["noi_dung_chi_tiet"], $_POST["trang_thai"]);

		if($ket_qua)
		{
			echo "<script>alert('Cập nhật thành công tin tức!')</script>";
			echo "<script>window.location = 'danh_sach_tin_tuc.php'</script>";
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
				<h1 class="page-header">Quản lý tin tức</h1>
			</div>
		</div><!--/.row-->
		<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<?php if($_GET["id"]) echo "Cập nhật tin tức #".$_GET["id"]; else echo "Thêm tin tức mới"; ?>
						</div>
						<div class="panel-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label>Tiêu đề tin:</label>
										<input name="tieu_de_tin" class="form-control" value="<?php if($_POST["tieu_de_tin"]) echo $_POST["tieu_de_tin"]; else echo $thong_tin_tin_tuc->tieu_de_tin; ?>" placeholder="Tiêu đề tin">
									</div>
									<div class="form-group">
										<label>Trạng thái:</label>
										<select name="trang_thai" class="form-control">
											<option <?php if($_POST["trang_thai"] === 1) echo "selected "; else if($thong_tin_tin_tuc->trang_thai == 1) echo "selected "; ?> value="1">Hiển thị</option>
											<option <?php if($_POST["trang_thai"] === 0) echo "selected "; else if($thong_tin_tin_tuc->trang_thai == 0) echo "selected "; ?> value="0">Không hiển thị</option>
										</select>
									</div>
									<div class="form-group">
										<label>Nội dung tóm tắt:</label>
										<textarea id="noi_dung_tom_tat" name="noi_dung_tom_tat" class="form-control" rows="3"><?php if($_POST["noi_dung_tom_tat"]) echo $_POST["noi_dung_tom_tat"]; else echo $thong_tin_tin_tuc->noi_dung_tom_tat; ?></textarea>
									</div>
									<div class="form-group">
										<label>Nội dung chi tiết:</label>
										<textarea id="noi_dung_chi_tiet" name="noi_dung_chi_tiet" class="form-control" rows="3">
											<?php if($_POST["noi_dung_chi_tiet"]) echo $_POST["noi_dung_chi_tiet"]; else echo $thong_tin_tin_tuc->noi_dung_chi_tiet; ?>
										</textarea>
										<script type="text/javascript">CKEDITOR.replace( 'noi_dung_chi_tiet', { customConfig: '/web_ban_sach_php_thuan/ckeditor/baiviet_config.js' } ); </script>
									</div>
									<div class="form-group">
										<label>Hình đại diện:</label>
										<input name="hinh_dai_dien" id="hinh_dai_dien" type="file">
										<div id="image-holder">
											<?php if($thong_tin_tin_tuc) echo " <img src='../images/tin_tuc/".$thong_tin_tin_tuc->hinh_dai_dien."' />"; ?>
										</div>
										<script>
										$("#hinh_dai_dien").on('change', function () {
									 
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
										<?php if($_GET["id"]) echo "Cập nhật"; else echo "Thêm tin tức mới"; ?>
									</button>
									
									<a href="danh_sach_tin_tuc.php">
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
