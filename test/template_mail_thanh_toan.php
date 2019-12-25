<?php
session_start();
include_once('libraries/xl_sach.php');
//print_r($_SESSION["gio_hang"]);
$xl_sach = new xl_sach();

//echo "<pre>",print_r($ds_sach_ban_chay_nhat),"</pre>";

//lay thong tin nhan hang
 $ho_ten = $_GET["ho_ten"];
 $email = $_GET["email"];
 $dien_thoai = $_GET["dien_thoai"];
 $dia_chi = $_GET["dia_chi"];

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
?>
<meta charset="utf-8" />
<!-- Latest compiled and minified CSS & JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<h1>
	Cám ơn bạn đã mua sách từ chúng tôi!
</h1>


<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">THÔNG TIN NHẬN SÁCH</h2>
<div class="col-md-12 col-lg-12" style="margin: 20px">
	<div class="row">
		<div class="col-md-3">
			Họ tên:
		</div>
		<div class="col-md-9">
			<?php echo $ho_ten; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			Email:
		</div>
		<div class="col-md-9">
			<?php echo $email; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			Điện thoại:
		</div>
		<div class="col-md-9">
			<?php echo $dien_thoai; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			Địa chỉ:
		</div>
		<div class="col-md-9">
			<?php echo $dia_chi; ?>
		</div>
	</div>
</div>

<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>
<table class="table table-hover gio_hang">
	<thead>
		<tr>
			<th>Mã sách</th>
			<th>Tên sách</th>
			<th>Hình sách</th>
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
			<td>
				<img width="200" src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents("images/sach/".$mat_hang->hinh)) ?>" />
			</td>
			<td><?php echo number_format($mat_hang->don_gia,0,",","."); ?></td>
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