<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_don_hang.php");
$xl_don_hang = new xl_don_hang();
$ds_don_hang = $xl_don_hang->danh_sach_tat_ca_don_hang(true);

//echo "<pre>",print_r($ds_don_hang),"</pre>";

if($_POST["chon_don_hang"])
{
	foreach($_POST["chon_don_hang"] as $id_don_hang_xoa)
	{
		$ket_qua = $xl_don_hang->xoa_don_hang_theo_id($id_don_hang_xoa);
	}

	if($ket_qua)
	{
		echo "<script>alert('Đã xóa các mục bạn chọn!')</script>";
		echo "<script>window.location = 'danh_sach_don_hang.php'</script>";
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
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách đơn hàng</div>
					<form action="" method="post">
						<div class="panel-body">
							<table class="table table-striped table-hover" id="table">
					            <thead>
					                <tr>
					                    <th data-field="id">ID</th>
					                    <th data-field="ho_ten_nguoi_nhan">Người nhận</th>
					                    <th data-field="so_dien_thoai_nguoi_nhan">Số điện thoại</th>
					                    <th data-field="trang_thai">Trạng thái</th>
					                    <th data-field="tong_tien">Tổng tiền</th>
					                    <th>Chọn</th>
					                </tr>
					            </thead>
					            <tbody>
					            	<?php
					            	foreach($ds_don_hang as $don_hang)
					            	{
					            	?>
							        <tr>
										<td style="text-align: center;"><?php echo $don_hang->id; ?></td>
										<td style="text-align: left;">
											<a href="cap_nhat_don_hang.php?id=<?php echo $don_hang->id; ?>">
												<?php echo $don_hang->ho_ten_nguoi_nhan; ?>
											</a>
										</td>
										<td style="text-align: left;">
											<a href="cap_nhat_don_hang.php?id=<?php echo $don_hang->id; ?>">
												<?php echo $don_hang->so_dien_thoai_nguoi_nhan; ?>
											</a>
										</td>
										<td style="text-align: center;">
											<img src="../images/<?php echo $don_hang->trang_thai ?>.png" title="<?php echo ($don_hang->trang_thai == 1)?"Đã thanh toán":(($don_hang->trang_thai == 2)?"Đã đặt hàng":"Đã hủy") ?>" />
										</td>
										<td style="text-align: right;">
											<?php echo number_format($don_hang->tong_tien,0,",","."); ?> ₫
										</td>
										<td style="text-align: center;"><input type="checkbox" name="chon_don_hang[]" value="<?php echo $don_hang->id; ?>" /></td>
							        </tr>
							        <?php
							   		}
							        ?>
							   </tbody>
					        </table>
					        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<button onclick="return kiem_tra_xoa();" type="submit" class="btn btn-danger">
									<span class="glyphicon glyphicon-remove"></span> Xóa đơn hàng đã chọn
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!--/.row-->	
	</div><!--/.main-->
	<script src="js/jquery_datatable.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		
            $(document).ready(function() {
			    $('#table').DataTable({
			   		"language": {
			            "lengthMenu": "Hiển thị _MENU_ dòng trên một trang",
			            "zeroRecords": "Không có đơn hàng nào",
			            "info": "Đang hiển thị trang _PAGE_ trong _PAGES_",
			            "infoEmpty": "Không có đơn hàng nàoe",
			            "sSearch": "Tìm kiếm ",
			            "oPaginate": {
							"sFirst": "Trang đầu",
							"sPrevious": "Trang trước",
							"sNext": "Trang sau",
							"sLast": "Trang cuối"
						},
						"oAria": {
							"sSortAscending":  ":Sắp xếp tăng dần",
							"sSortDescending": ":Sắp xếp giảm dần"
						}
			        }
			    }); 
			});
            
	</script>

	<script>
	function kiem_tra_xoa()
	{
		kq = confirm("Bạn có chắc chắn là muốn xóa các dòng đã chọn?");
		return kq;
	}
	</script>

	<style>
		.fixed-table-loading{
			display: none;
		}
		.table thead th{
			text-align: center;
		}
	</style>
</body>

</html>
