<?php
session_start();
if(!$_SESSION["nguoi_dung"] || $_SESSION["nguoi_dung"]->id_loai_user <= 4)
{
	header("location: login.php");
}

include_once("../libraries/xl_loai_sach.php");
$xl_loai_sach = new xl_loai_sach();
$ds_loai_sach = $xl_loai_sach->danh_sach_loai_sach_cha();

//echo "<pre>",print_r($ds_loai_sach),"</pre>";

if($_POST["chon_loai_sach"])
{

	foreach($_POST["chon_loai_sach"] as $id_loai_sach_xoa)
	{
		if($xl_loai_sach->danh_sach_loai_sach_con($id_loai_sach_xoa))
		{
			echo "<script>alert('Không thể xóa loại sách có ID:$id_loai_sach_xoa  khi nó còn có loại sách con!')</script>";
		}
		else if($xl_loai_sach->lay_1_sach_de_kiem_tra_loai_sach($id_loai_sach_xoa))
		{
			echo "<script>alert('Không thể xóa loại sách có ID:$id_loai_sach_xoa  khi còn sách thuộc loại này!')</script>";
		}
		else
		{
			$ket_qua = $xl_loai_sach->xoa_loai_sach_theo_id($id_loai_sach_xoa);
		}
	}

	if($ket_qua)
	{
		echo "<script>alert('Đã xóa các mục bạn chọn!')</script>";
		echo "<script>window.location = 'danh_sach_loai_sach.php'</script>";
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
				<h1 class="page-header">Quản lý loại sách</h1>
			</div>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách loại sách</div>
					<form action="" method="post">
						<div class="panel-body">
							<table class="table table-striped table-hover" id="table">
					            <thead>
					                <tr>
					                    <th data-field="id">ID</th>
					                    <th data-field="ho_ten_nguoi_nhan">Tên loại sách</th>
					                    <th>Chọn</th>
					                </tr>
					            </thead>
					            <tbody>
					            	<?php
					            	foreach($ds_loai_sach as $loai_sach)
					            	{
					            	?>
							        <tr>
										<td style="text-align: center;"><?php echo $loai_sach->id; ?></td>
										<td style="text-align: left;">
											<a href="cap_nhat_loai_sach.php?id=<?php echo $loai_sach->id; ?>">
												<?php echo $loai_sach->ten_loai_sach; ?>
											</a>
										</td>
										<td style="text-align: center;">
											<input type="checkbox" name="chon_loai_sach[]" value="<?php echo $loai_sach->id; ?>" />
										</td>
							        </tr>
							        <?php
							        	if($loai_sach->ds_con)
							        	{
							        		foreach($loai_sach->ds_con as $loai_sach_con)
							        		{
						        			?>
						        				<tr>
													<td style="text-align: center;"><?php echo $loai_sach_con->id; ?></td>
													<td style="text-align: left;">
														<a href="cap_nhat_loai_sach.php?id=<?php echo $loai_sach_con->id; ?>">
															|== <?php echo $loai_sach_con->ten_loai_sach; ?>
														</a>
													</td>
													<td style="text-align: center;">
														<input type="checkbox" name="chon_loai_sach[]" value="<?php echo $loai_sach_con->id; ?>" />
													</td>
										        </tr>
						        			<?php
							        		}
							        	}
							   		}
							        ?>
							   </tbody>
					        </table>
					        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<a href="cap_nhat_loai_sach.php">
									<button type="button" class="btn btn-primary">
										<span class="glyphicon glyphicon-star"></span> Thêm loại sách mới
									</button>
								</a>
								<button onclick="return kiem_tra_xoa();" type="submit" class="btn btn-danger">
									<span class="glyphicon glyphicon-remove"></span> Xóa loại sách đã chọn
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
			            "zeroRecords": "Không có loại sách nào",
			            "info": "Đang hiển thị trang _PAGE_ trong _PAGES_",
			            "infoEmpty": "Không có loại sách nàoe",
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
			        },
			        "bSort": false
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
