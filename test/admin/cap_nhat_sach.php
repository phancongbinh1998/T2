<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_loai_sach.php");
$xl_loai_sach = new xl_loai_sach();

$ds_loai_sach = $xl_loai_sach->danh_sach_loai_sach_cha();

include_once("../libraries/xl_tac_gia.php");
$xl_tac_gia = new xl_tac_gia();

$ds_tac_gia = $xl_tac_gia->danh_sach_tat_ca_tac_gia();

include_once("../libraries/xl_nha_xuat_ban.php");
$xl_nha_xuat_ban = new xl_nha_xuat_ban();

$ds_nha_xuat_ban = $xl_nha_xuat_ban->danh_sach_tat_ca_nha_xuat_ban();

include_once("../libraries/xl_sach.php");
$xl_sach = new xl_sach();



if($_GET["id"])
{
	$thong_tin_sach = $xl_sach->thong_tin_sach_theo_id($_GET["id"]);	
}


//echo "<pre>",print_r($_POST),"</pre>";
//echo "<pre>",print_r($_FILES),"</pre>";

if($_POST)
{
	//
	if ($_FILES["hinh_sach"]["error"] > 0 && $thong_tin_sach->hinh == "")
    {
        echo "<script>alert('Lỗi upload file: " . $_FILES["hinh_sach"]["error"] . "');</script>";
    }
    else if($_FILES["hinh_sach"]["name"] != "")
    {
        $loai_file = explode('.',$_FILES["hinh_sach"]["name"]);
        //print_r($loai_file);
        //echo $loai_file[count($loai_file)-1];
        if(strtolower($loai_file[count($loai_file)-1]) != 'png' && strtolower($loai_file[count($loai_file)-1]) != 'jpg' && strtolower($loai_file[count($loai_file)-1]) != 'gif')
        {
            echo '<script>alert("Loại file không phù hợp. Bạn hãy kiểm tra lại! Cám ơn");</script>';
        }
        else
        {
            move_uploaded_file($_FILES["hinh_sach"]["tmp_name"], "../images/sach/" . $_FILES["hinh_sach"]["name"]);
        }
    }

    if(!$_GET["id"])
    {
		$ket_qua = $xl_sach->them_sach_moi($_POST["ten_sach"], $_POST["id_tac_gia"], $_POST["gioi_thieu"], $_POST["doc_thu"], $_POST["id_loai_sach"], $_POST["id_nha_xuat_ban"], $_POST["so_trang"], $_POST["ngay_xuat_ban"], $_POST["kich_thuoc"], $_POST["sku"], $_POST["trong_luong"], $_POST["trang_thai"], $_FILES["hinh_sach"]["name"], $_POST["don_gia"], $_POST["gia_bia"], $_POST["noi_bat"]);
		if($ket_qua)
		{
			echo "<script>alert('Thêm thành công sách mới!')</script>";
			echo "<script>window.location = 'danh_sach_san_pham.php'</script>";
		}
		else
		{
			echo "<script>alert('Có lỗi xảy ra trong quá trình thêm!')</script>";
		}
	}
	else
	{
		if($_FILES["hinh_sach"]["name"] != "")
		{
			$hinh = $_FILES["hinh_sach"]["name"];
		}
		else
		{
			$hinh = $thong_tin_sach->hinh;
		}

		$ket_qua = $xl_sach->cap_nhat_sach($thong_tin_sach->id,$_POST["ten_sach"], $_POST["id_tac_gia"], $_POST["gioi_thieu"], $_POST["doc_thu"], $_POST["id_loai_sach"], $_POST["id_nha_xuat_ban"], $_POST["so_trang"], $_POST["ngay_xuat_ban"], $_POST["kich_thuoc"], $_POST["sku"], $_POST["trong_luong"], $_POST["trang_thai"], $hinh, $_POST["don_gia"], $_POST["gia_bia"], $_POST["noi_bat"]);

		if($ket_qua)
		{
			echo "<script>alert('Cập nhật thành công sách!')</script>";
			echo "<script>window.location = 'danh_sach_san_pham.php'</script>";
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
				<h1 class="page-header">Quản lý sản phẩm</h1>
			</div>
		</div><!--/.row-->
		<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<?php if($_GET["id"]) echo "Cập nhật sách #".$_GET["id"]; else echo "Thêm sách mới"; ?>
						</div>
						<div class="panel-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label>Mã SKU:</label>
										<input name="sku" class="form-control" value="<?php if($_POST["sku"]) echo $_POST["sku"]; else echo $thong_tin_sach->sku; ?>" placeholder="Mã SKU">
									</div>
									<div class="form-group">
										<label>Loại sách:</label>
										<select name="id_loai_sach" class="form-control">
											<?php
											foreach($ds_loai_sach as $loai_sach_cha)
											{
												?>
												<option <?php if($loai_sach_cha->id == $thong_tin_sach->id_loai_sach) echo "selected " ?> value="<?php echo $loai_sach_cha->id ?>">
													<?php echo $loai_sach_cha->ten_loai_sach; ?>
												</option>
												<?php
												if($loai_sach_cha->ds_con)
												{
													foreach($loai_sach_cha->ds_con as $loai_sach_con)
													{
														?>
														<option <?php if($loai_sach_con->id == $thong_tin_sach->id_loai_sach) echo "selected " ?> value="<?php echo $loai_sach_con->id ?>">
															|==<?php echo $loai_sach_con->ten_loai_sach; ?>
														</option>
														<?php
													}
												}
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Tên sách:</label>
										<input name="ten_sach" value="<?php if($_POST["ten_sach"]) echo $_POST["ten_sach"]; else echo $thong_tin_sach->ten_sach; ?>" class="form-control" placeholder="Tên sách">
									</div>
									<div class="form-group">
										<label>Đọc thử:</label>
										<input name="doc_thu" value="<?php if($_POST["doc_thu"]) echo $_POST["doc_thu"]; else echo $thong_tin_sach->doc_thu; ?>" class="form-control" placeholder="Đọc thử">
									</div>
									<div class="form-group">
										<label>Số trang:</label>
										<input name="so_trang" value="<?php if($_POST["so_trang"]) echo $_POST["so_trang"]; else echo $thong_tin_sach->so_trang; ?>" class="form-control" placeholder="Số trang">
									</div>
									<div class="form-group">
										<label>Tác giả:</label>
										<select name="id_tac_gia" class="form-control">
											<?php
											foreach($ds_tac_gia as $tac_gia)
											{
											?>
												<option <?php if($tac_gia->id == $thong_tin_sach->id_tac_gia) echo "selected " ?> value="<?php echo $tac_gia->id ?>">
													<?php echo $tac_gia->ten_tac_gia; ?>
												</option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Nhà xuất bản:</label>
										<select name="id_nha_xuat_ban" class="form-control">
											<?php
											foreach($ds_nha_xuat_ban as $nha_xuat_ban)
											{
											?>
												<option <?php if($nha_xuat_ban->id == $thong_tin_sach->id_nha_xuat_ban) echo "selected " ?> value="<?php echo $nha_xuat_ban->id ?>">
													<?php echo $nha_xuat_ban->ten_nha_xuat_ban; ?>
												</option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Ngày xuất bản:</label>
										<input name="ngay_xuat_ban" value="<?php if($_POST["ngay_xuat_ban"]) echo $_POST["ngay_xuat_ban"]; else echo $thong_tin_sach->ngay_xuat_ban; ?>" class="form-control" placeholder="Ngày xuất bản">
									</div>
									<div class="form-group">
										<label>Trọng lượng:</label>
										<input name="trong_luong" value="<?php if($_POST["trong_luong"]) echo $_POST["trong_luong"]; else echo $thong_tin_sach->trong_luong; ?>" class="form-control" placeholder="Trọng lượng">
									</div>
									<div class="form-group">
										<label>Kích thước:</label>
										<input name="kich_thuoc" value="<?php if($_POST["kich_thuoc"]) echo $_POST["kich_thuoc"]; else echo $thong_tin_sach->kich_thuoc; ?>" class="form-control" placeholder="Kích thước">
									</div>
									<div class="form-group">
										<label>Giá bìa:</label>
										<input name="gia_bia" value="<?php if($_POST["gia_bia"]) echo $_POST["gia_bia"]; else echo $thong_tin_sach->gia_bia; ?>" class="form-control" placeholder="Giá bìa">
									</div>
									<div class="form-group">
										<label>Đơn giá:</label>
										<input name="don_gia" value="<?php if($_POST["don_gia"]) echo $_POST["don_gia"]; else echo $thong_tin_sach->don_gia; ?>" class="form-control" placeholder="Đơn giá">
									</div>
									
								</div>
								<div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label>Trạng thái:</label>
										<select name="trang_thai" class="form-control">
											<option <?php if($_POST["trang_thai"] === 1) echo "selected "; else if($thong_tin_sach->trang_thai == 1) echo "selected "; ?> value="1">Hiển thị</option>
											<option <?php if($_POST["trang_thai"] === 0) echo "selected "; else if($thong_tin_sach->trang_thai == 0) echo "selected "; ?> value="0">Không hiển thị</option>
										</select>
									</div>
									<div class="form-group">
										<label>Nổi bật:</label>
										<select name="noi_bat" class="form-control">
											<option <?php if($_POST["noi_bat"] === 1) echo "selected "; else if($thong_tin_sach->noi_bat == 1) echo "selected "; ?> value="1">Nổi bật</option>
											<option <?php if($_POST["noi_bat"] === 0) echo "selected "; else if($thong_tin_sach->noi_bat == 0) echo "selected "; ?> value="0">Bình thường</option>
										</select>
									</div>
									<div class="form-group">
										<label>Giới thiệu:</label>
										<textarea id="gioi_thieu" name="gioi_thieu" class="form-control" rows="3"><?php if($_POST["gioi_thieu"]) echo $_POST["gioi_thieu"]; else echo $thong_tin_sach->gioi_thieu; ?></textarea>
										<script type="text/javascript">CKEDITOR.replace( 'gioi_thieu', { customConfig: '/web_ban_sach_php_thuan/ckeditor/baiviet_config.js' } ); </script>
									</div>
									<div class="form-group">
										<label>Hình sách:</label>
										<input name="hinh_sach" id="hinh_sach" type="file">
										<div id="image-holder">
											<?php if($thong_tin_sach) echo " <img src='../images/sach/".$thong_tin_sach->hinh."' />"; ?>
										</div>
										<script>
										$("#hinh_sach").on('change', function () {
									 
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
										<?php if($_GET["id"]) echo "Cập nhật"; else echo "Thêm sách mới"; ?>
									</button>
									
									<a href="danh_sach_san_pham.php">
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
