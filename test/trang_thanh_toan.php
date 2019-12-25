<?php
session_start();
include_once('libraries/xl_sach.php');
include_once('libraries/xl_don_hang.php');
require_once('libraries/class.phpmailer.php');
include_once('config.php');
//print_r($_SESSION["gio_hang"]);
$xl_sach = new xl_sach();
$config = new config();

//echo "<pre>",print_r($ds_sach_ban_chay_nhat),"</pre>";

//danh sach gio hang
if($_SESSION["gio_hang"])
{
	$mang_gio_hang = $_SESSION["gio_hang"];
}
else
{
	echo "<script>alert('Hiện giỏ hàng của bạn đang rỗng!')</script>";
	echo "<script>window.location = 'index.php'</script>";
}

if($_POST)
{
	include_once('libraries/xl_don_hang.php');
	$xl_don_hang = new xl_don_hang();
	//print_r($_POST);
	//echo $_POST["ho_ten"];
	//print_r($mang_gio_hang);
	//echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '/../template_mail_thanh_toan.php?ho_ten='.$_POST["ho_ten"].'&email='.$_POST["email"].'&dien_thoai='.$_POST["dien_thoai"].'&dia_chi='.$_POST["dia_chi"];exit;

	//print_r($_POST);
	//them thong tin don hang vao CSDL
	$id_don_hang = $xl_don_hang->them_don_hang($_POST["tong_tien"], $_POST["ho_ten"], $_POST["email"], $_POST["dien_thoai"], $_POST["dia_chi"], $_POST["id_nguoi_dung"]);
	// them cac dong CSDL cho chi tiet don hang
	if($id_don_hang)
	{
		foreach($mang_gio_hang as $mat_hang)
		{
			$ket_qua = $xl_don_hang->them_chi_tiet_don_hang($id_don_hang, $mat_hang->id, $mat_hang->so_luong, $mat_hang->don_gia, $mat_hang->don_gia * $mat_hang->so_luong);
		}

		if($ket_qua)
		{
			$xl_don_hang = new xl_don_hang();

			$noi_dung_mail = $xl_don_hang->template_mail_thanh_toan($mang_gio_hang);

			$mail = new PHPMailer(); // tao doi tuong
			$mail->IsSMTP(); // ket noi smtp
			$mail->CharSet = 'UTF-8';
			//$mail->SMTPDebug = 1; // debug de xuat loi
			$mail->SMTPAuth = true; // kiem tra quyen truy cap
			$mail->SMTPSecure = 'ssl'; // bat bao mat gui mail loai SSL
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // co the dung port 587
			$mail->IsHTML(true);
			$mail->Username = $config->mail_user;
			$mail->Password = $config->mail_pass;
			$mail->SetFrom("hungbookstoreonline@gmail.com");
			$mail->From = "hungbookstoreonline@gmail.com";
			$mail->Subject = "Cám ơn bạn đặt hàng tại Bán sách online của chúng tôi";
			$mail->Body = $noi_dung_mail;
			$mail->AddAddress($_POST["email"]);
			if(!$mail->Send())
			{
				echo "<script> alert('Trong lúc gửi mail xảy ra sự cố: " . $mail->ErrorInfo . "');</script>";
			}
			else
			{
				echo "<script>alert('Thông tin đơn hàng đã được gửi đến email của bạn!')</script>";
				unset($_SESSION["gio_hang"]);
			}
			
			echo "<script>alert('Quý khách đã mua hàng thành công, chúng tôi đã lưu đơn hàng của bạn. Cám ơn quý khách!')</script>";
			echo "<script>window.location = 'index.php'</script>";
		}
	}
	

}

?>
<html>
<head>
	<?php include_once("widgets/head.php"); ?>
</head>
<body>
	<section class="container-fluid">
		<!-- slide banner -->
		<?php include_once('modules/mod_slide_banner.php'); ?>
		<!-- END slide banner -->

		<!-- menu bar -->
		<?php include_once('modules/mod_menu.php'); ?>
		<!-- END menu bar -->
		<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
			<div class="col-md-5 col-lg-5 form_thanh_toan">
			
				<div class="form-group">
					<legend>Thông tin người nhận sách</legend>
				</div>
				<?php
				if($_SESSION["nguoi_dung"])
				{

				?>
				<input type="hidden" name="id_nguoi_dung" value="<?php echo $_SESSION["nguoi_dung"]->id; ?>" />
				<div class="form-group">
					<div class="col-md-9 col-md-offset-3">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="thong_tin_nguoi_dung" id="thong_tin_nguoi_dung">
								Nếu thông tin người nhận chính là bạn
							</label>
						</div>
						
					</div>
				</div>
				<script>
				var ttnd = JSON.parse('<?php echo json_encode($_SESSION["nguoi_dung"]); ?>');
				$(document).ready(function(){
					$("#thong_tin_nguoi_dung").click(function(){
						$("#ho_ten").val(ttnd.ho_ten);
						$("#email").val(ttnd.email);
						$("#dien_thoai").val(ttnd.dien_thoai);
						$("#dia_chi").val(ttnd.dia_chi);
					});
				});
				</script>
				<?php
				}
				?>
				<div class="form-group">
					<div class="col-md-3">
						Họ tên:
					</div>
					<div class="col-md-9">
						<input type="text" name="ho_ten" id="ho_ten" class="form-control" value="" required="required" title="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						Email:
					</div>
					<div class="col-md-9">
						<input type="text" name="email" id="email" class="form-control" value="" required="required" title="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						Điện thoại:
					</div>
					<div class="col-md-9">
						<input type="text" name="dien_thoai" id="dien_thoai" class="form-control" value="" required="required" title="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						Địa chỉ:
					</div>
					<div class="col-md-9">
						<input type="text" name="dia_chi" id="dia_chi" class="form-control" value="" required="required" title="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-9 col-sm-offset-3">
						<button type="submit" class="btn btn-primary" style="padding: 5px 30px">Thanh Toán</button>
					</div>
				</div>
			</div>
			<div class="col-md-7 col-lg-7">
				<div class="table-responsive">
					<form action="" method="post" name="form_gio_hang">
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
								foreach($mang_gio_hang as $mat_hang)
								{
									$tong_tien += $mat_hang->so_luong * $mat_hang->don_gia;
								?>
								<tr>
									<td><?php echo $mat_hang->sku; ?></td>
									<td style="min-width: 80px;"><a href="chi_tiet_sach.php?id_sach=<?php echo $mat_hang->id; ?>"><?php echo $mat_hang->ten_sach; ?></a></td>
									<td><?php echo number_format($mat_hang->don_gia,0,",","."); ?></td>
									<td style="text-align:center;"><?php echo $mat_hang->so_luong; ?></td>
									<td style="text-align: right;"><?php echo number_format($mat_hang->so_luong * $mat_hang->don_gia,0,",","."); ?> ₫</td>
								</tr>
								<?php
								}
								?>
								<tr class="tong_tien">
									<td colspan="3" style="text-align: right;">Tổng cộng: </td>
									<td colspan="2" style="text-align: right;">
										<?php echo number_format($tong_tien,0,",","."); ?> ₫
										<input type="hidden" name="tong_tien" value="<?php echo $tong_tien; ?>" />
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="ds_nut_dieu_khien">
											<a href="trang_gio_hang.php"><div class="btn btn-danger"><span class="glyphicon glyphicon-logout"></span> Trở lại trang giỏ hàng</div></a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</form>
		
	</section>
	
	<!-- footer -->
	<?php include_once("widgets/footer.php"); ?>
	<!-- END footer -->
</body>
</html>