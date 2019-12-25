<?php
include_once("libraries/xl_tin_tuc.php");
$xl_tin_tuc = new xl_tin_tuc();
$danh_sach_tin_tuc = $xl_tin_tuc->danh_sach_tin_tuc_hien_thi();
//echo "<pre>",print_r($danh_sach_tin_tuc),"</pre>";

$so_luong_hien_thi = 8;
$so_trang = ceil(count($danh_sach_tin_tuc)/$so_luong_hien_thi);
if($_GET["page"])
{
	$trang_hien_tai = $_GET["page"];
}
else
{
	$trang_hien_tai = 1;
}

$ds_tin_tuc_phan_trang = $xl_tin_tuc->danh_sach_tin_tuc_hien_thi(($trang_hien_tai - 1) * $so_luong_hien_thi, $so_luong_hien_thi);
?>
<section class="ds_sp_noi_bat container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="title_module">
				Tin tức
			</div>
			<?php
			for($i = 0; $i < count($ds_tin_tuc_phan_trang); $i++)
			{
				if($i % 2 == 0)
				{
				?>
				<div class="row">
				<?php
				}
					?>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 tin_tuc_block">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 hinh_tin_tuc">
								<img src="images/tin_tuc/<?php echo $ds_tin_tuc_phan_trang[$i]->hinh_dai_dien; ?>" />
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 thong_tin_mo_ta_tin_tuc">
								<a href="chi_tiet_tin_tuc.php?id_tin_tuc=<?php echo $ds_tin_tuc_phan_trang[$i]->id; ?>">
									<div class="tieu_de_tin">
										<?php echo $ds_tin_tuc_phan_trang[$i]->tieu_de_tin; ?>
									</div>
								</a>
								<div class="mo_ta_tom_tat">
									<?php echo $ds_tin_tuc_phan_trang[$i]->noi_dung_tom_tat; ?>
								</div>
							</div>
						</div>
					<?php
				if($i % 2 == 1 || $i == (count($ds_tin_tuc_phan_trang) - 1))
				{
				?>
				</div>
				<?php
				}
			}
			?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php
				echo $phan_trang->pageList($trang_hien_tai,$so_trang);
				?>
			</div>
		</div>
	</div>
</section>