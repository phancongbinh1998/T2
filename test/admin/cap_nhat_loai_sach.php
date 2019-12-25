<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_loai_sach.php");
$xl_loai_sach = new xl_loai_sach();
$ds_loai_sach = $xl_loai_sach->danh_sach_loai_sach_cha();


if($_GET["id"])
{
	$thong_tin_loai_sach = $xl_loai_sach->thong_tin_loai_sach_theo_id($_GET["id"]);	
}


//echo "<pre>",print_r($_POST),"</pre>";
//echo "<pre>",print_r($_FILES),"</pre>";

if($_POST)
{

    if(!$_GET["id"])
    {
		$ket_qua = $xl_loai_sach->them_loai_sach_moi($_POST["ten_loai_sach"], $_POST["id_loai_cha"], $_POST["trang_thai"]);
		if($ket_qua)
		{
			echo "<script>alert('Thêm thành công loại sách mới!')</script>";
			echo "<script>window.location = 'danh_sach_loai_sach.php'</script>";
		}
		else
		{
			echo "<script>alert('Có lỗi xảy ra trong quá trình thêm!')</script>";
		}
	}
	else
	{

		$ket_qua = $xl_loai_sach->cap_nhat_loai_sach($thong_tin_loai_sach->id,$_POST["ten_loai_sach"], $_POST["id_loai_cha"], $_POST["trang_thai"]);

		if($ket_qua)
		{
			echo "<script>alert('Cập nhật thành công loại sách!')</script>";
			echo "<script>window.location = 'danh_sach_loai_sach.php'</script>";
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
				<h1 class="page-header">Quản lý bán hàng</h1>
			</div>
		</div><!--/.row-->
		<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<?php if($_GET["id"]) echo "Cập nhật loại sách #".$_GET["id"]; else echo "Thêm loại sách mới"; ?>
						</div>
						<div class="panel-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label>Tên loại sách:</label>
										<input name="ten_loai_sach" class="form-control" value="<?php if($_POST["ten_loai_sach"]) echo $_POST["ten_loai_sach"]; else echo $thong_tin_loai_sach->ten_loai_sach; ?>" placeholder="Tên loại sách">
									</div>
									<div class="form-group">
										<label>Chọn loại sách cha:</label>
										<select name="id_loai_cha" class="form-control">
											<option value="0">Làm loại cha dưới Root</option>
											<?php
											foreach($ds_loai_sach as $loai_sach_cha)
											{
												?>
												<option <?php if($loai_sach_cha->id == $thong_tin_loai_sach->id_loai_cha) echo "selected " ?> value="<?php echo $loai_sach_cha->id ?>">
													<?php echo $loai_sach_cha->ten_loai_sach; ?>
												</option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Trạng thái:</label>
										<select name="trang_thai" class="form-control">
											<option <?php if($_POST["trang_thai"] === 1) echo "selected "; else if($thong_tin_loai_sach->trang_thai == 1) echo "selected "; ?> value="1">Hiển thị</option>
											<option <?php if($_POST["trang_thai"] === 0) echo "selected "; else if($thong_tin_loai_sach->trang_thai == 0) echo "selected "; ?> value="0">Không hiển thị</option>
										</select>
									</div>
									
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
									
									<button type="submit" class="btn btn-primary">
										<?php if($_GET["id"]) echo "Cập nhật"; else echo "Thêm loại sách mới"; ?>
									</button>
									
									<a href="danh_sach_loai_sach.php">
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
