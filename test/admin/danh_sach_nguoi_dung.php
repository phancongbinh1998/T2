<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_nguoi_dung.php");
$xl_nguoi_dung = new xl_nguoi_dung();
$ds_nguoi_dung = $xl_nguoi_dung->danh_sach_tat_ca_nguoi_dung(true);

//echo "<pre>",print_r($ds_nguoi_dung),"</pre>";

if($_POST["chon_nguoi_dung"])
{
	foreach($_POST["chon_nguoi_dung"] as $id_nguoi_dung_xoa)
	{
		$ket_qua = $xl_nguoi_dung->xoa_nguoi_dung_theo_id($id_nguoi_dung_xoa);
	}

	if($ket_qua)
	{
		echo "<script>alert('Đã xóa các mục bạn chọn!')</script>";
		echo "<script>window.location = 'danh_sach_nguoi_dung.php'</script>";
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
				<h1 class="page-header">Quản lý người dùng</h1>
			</div>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách người dùng</div>
					<form action="" method="post">
						<div class="panel-body">
							<table class="table table-striped table-hover" id="table">
					            <thead>
					                <tr>
					                    <th data-field="id">ID</th>
					                    <th data-field="tai_khoan">Tài khoản</th>
					                    <th data-field="ho_ten">Họ tên</th>
					                    <th data-field="trang_thai">Quyền hạn</th>
					                    <th>Chọn</th>
					                </tr>
					            </thead>
					            <tbody>
					            	<?php
					            	foreach($ds_nguoi_dung as $nguoi_dung)
					            	{
					            	?>
							        <tr>
										<td style="text-align: center;"><?php echo $nguoi_dung->id; ?></td>
										<td style="text-align: left;">
											<a href="cap_nhat_nguoi_dung.php?id=<?php echo $nguoi_dung->id; ?>">
												<?php echo $nguoi_dung->tai_khoan; ?>
											</a>
										</td>
										<td style="text-align: left;">
											<a href="cap_nhat_nguoi_dung.php?id=<?php echo $nguoi_dung->id; ?>">
												<?php echo $nguoi_dung->ho_ten; ?>
											</a>
										</td>
										<td style="text-align: center;">
											<?php echo $nguoi_dung->ten_loai_nguoi_dung; ?>
										</td>
										<td style="text-align: center;"><input type="checkbox" name="chon_nguoi_dung[]" value="<?php echo $nguoi_dung->id; ?>" /></td>
							        </tr>
							        <?php
							   		}
							        ?>
							   </tbody>
					        </table>
					        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					        	<a href="cap_nhat_nguoi_dung.php">
									<button type="button" class="btn btn-primary">
										<span class="glyphicon glyphicon-star"></span> Thêm người dùng mới
									</button>
								</a>
								<button onclick="return kiem_tra_xoa();" type="submit" class="btn btn-danger">
									<span class="glyphicon glyphicon-remove"></span> Xóa người dùng đã chọn
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
			            "zeroRecords": "Không có người dùng nào",
			            "info": "Đang hiển thị trang _PAGE_ trong _PAGES_",
			            "infoEmpty": "Không có người dùng nàoe",
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
