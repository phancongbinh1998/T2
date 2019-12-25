<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_don_hang.php");
$xl_don_hang = new xl_don_hang();



if($_GET["id"])
{
	$thong_tin_don_hang = $xl_don_hang->thong_tin_don_hang_theo_id($_GET["id"]);	
}


//echo "<pre>",print_r($_POST),"</pre>";
//echo "<pre>",print_r($_FILES),"</pre>";

if($_POST)
{
	$ket_qua = $xl_don_hang->cap_nhat_don_hang($thong_tin_don_hang->id, $_POST["trang_thai"]);

	if($ket_qua)
	{
		echo "<script>alert('Cập nhật thành công đơn hàng!')</script>";
		echo "<script>window.location = 'danh_sach_don_hang.php'</script>";
	}
	else
	{
		echo "<script>alert('Có lỗi xảy ra trong quá trình cập nhật!')</script>";
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
				<h1 class="page-header">Quản lý đơn hàng</h1>
			</div>
		</div><!--/.row-->
		<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<?php if($_GET["id"]) echo "Cập nhật đơn hàng #".$_GET["id"]; else echo "Thêm đơn hàng mới"; ?>
						</div>
						<div class="panel-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-md-4 col-lg-4 thong_tin_nguoi_nhan">
									<div class="form-group row">
										<div class="col-md-3">
											Họ tên:
										</div>
										<div class="col-md-9">
											<?php echo $thong_tin_don_hang->ho_ten_nguoi_nhan; ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											Email:
										</div>
										<div class="col-md-9">
											
											<?php echo $thong_tin_don_hang->email_nguoi_nhan; ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											Điện thoại:
										</div>
										<div class="col-md-9">
											<?php echo $thong_tin_don_hang->so_dien_thoai_nguoi_nhan; ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											Địa chỉ:
										</div>
										<div class="col-md-9">
											<?php echo $thong_tin_don_hang->dia_chi_nguoi_nhan; ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-3">
											Trạng thái:
										</div>
										<div class="col-md-9">
											<?php //echo $thong_tin_don_hang->trang_thai ?>
											<select name="trang_thai" class="form-control">
												<option <?php if($thong_tin_don_hang->trang_thai == "2") echo "selected "; ?> value="2">Đã đặt hàng</option>
												<option <?php if($thong_tin_don_hang->trang_thai == "1") echo "selected "; ?> value="1">Đã hoàn thành giao dịch</option>
												<option <?php if($thong_tin_don_hang->trang_thai == "0") echo "selected "; ?> value="0">Chưa hoàn thành giao dịch</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-8 col-lg-8">
									<table class="table table-hover gio_hang">
										<thead>
											<tr>
												<th>Mã sách</th>
												<th>Tên sách</th>
												<th>Đơn giá</th>
												<th>Số lượng</th>
												<th>Thành tiền</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach($thong_tin_don_hang->ds_chi_tiet_don_hang as $mat_hang)
											{
												$tong_tien += $mat_hang->so_luong * $mat_hang->don_gia;
											?>
											<tr>
												<td><?php echo $mat_hang->sku; ?></td>
												<td style="min-width: 80px;">
													<a href="../chi_tiet_sach.php?id_sach=<?php echo $mat_hang->id; ?>">
														<img title="<?php echo $mat_hang->ten_sach; ?>" src="../images/sach/<?php echo $mat_hang->hinh; ?>" width="100" />
													</a>
												</td>
												<td style="min-width: 80px;"><a href="../chi_tiet_sach.php?id_sach=<?php echo $mat_hang->id; ?>"><?php echo $mat_hang->ten_sach; ?></a></td>
												<td><?php echo number_format($mat_hang->don_gia,0,",","."); ?> ₫</td>
												<td style="text-align:center;"><?php echo $mat_hang->so_luong; ?></td>
												<td style="text-align: right;"><?php echo number_format($mat_hang->so_luong * $mat_hang->don_gia,0,",","."); ?> ₫</td>
											</tr>
											<?php
											}
											?>
											<tr class="tong_tien">
												<td colspan="4" style="text-align: right;">Tổng cộng: </td>
												<td colspan="2" style="text-align: right;">
													<?php echo number_format($tong_tien,0,",","."); ?> ₫
													<input type="hidden" name="tong_tien" value="<?php echo $tong_tien; ?>" />
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
									
									<button type="submit" class="btn btn-primary">
										<?php if($_GET["id"]) echo "Cập nhật"; else echo "Thêm đơn hàng mới"; ?>
									</button>
									
									<a href="danh_sach_don_hang.php">
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
