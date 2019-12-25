<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_slide_banner.php");
$xl_slide_banner = new xl_slide_banner();
$ds_slide_banner = $xl_slide_banner->danh_sach_tat_ca_slide_banner();

if($_POST["chon_slide_banner"])
{
	foreach($_POST["chon_slide_banner"] as $id_slide_banner_xoa)
	{
		$ket_qua = $xl_slide_banner->xoa_slide_banner_theo_id($id_slide_banner_xoa);
	}

	if($ket_qua)
	{
		echo "<script>alert('Đã xóa các mục bạn chọn!')</script>";
		echo "<script>window.location = 'danh_sach_slide_banner.php'</script>";
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
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh slide banner sản phẩm</div>
					<form action="" method="post">
						<div class="panel-body">
							<table class="table table-striped table-hover" id="table">
					            <thead>
					                <tr>
					                    <th data-field="id">ID</th>
					                    <th data-field="hinh">Hình</th>
					                    <th data-field="ten_slide">Tên slide banner</th>
					                    <th>Chọn</th>
					                </tr>
					            </thead>
					            <tbody>
					            	<?php
					            	foreach($ds_slide_banner as $slide_banner)
					            	{
					            	?>
							        <tr>
										<td style="text-align: center;"><?php echo $slide_banner->id; ?></td>
										<td style="text-align: center;">
											<a href="cap_nhat_slide_banner.php?id=<?php echo $slide_banner->id; ?>">
												<img src="../images/slide_banner/<?php echo $slide_banner->hinh; ?>" style="width: 100%; max-width: 300px;" />
											</a>
										</td>
										<td style="text-align: center;">
											<a href="cap_nhat_slide_banner.php?id=<?php echo $slide_banner->id; ?>"><?php echo $slide_banner->ten_slide; ?></a>
										</td>
										<td style="text-align: center;"><input type="checkbox" name="chon_slide_banner[]" value="<?php echo $slide_banner->id; ?>" /></td>
							        </tr>
							        <?php
							   		}
							        ?>
							   </tbody>
					        </table>
					        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<a href="cap_nhat_slide_banner.php">
									<button type="button" class="btn btn-primary">
										<span class="glyphicon glyphicon-star"></span> Thêm slide banner mới
									</button>
								</a>
								<button onclick="return kiem_tra_xoa();" type="submit" class="btn btn-danger">
									<span class="glyphicon glyphicon-remove"></span> Xóa slide banner đã chọn
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
			            "zeroRecords": "Không có slide banner nào",
			            "info": "Đang hiển thị trang _PAGE_ trong _PAGES_",
			            "infoEmpty": "Không có slide banner nàoe",
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
