<?php

$thong_tin_tin_tuc = $xl_tin_tuc->thong_tin_tin_tuc_theo_id($_GET["id_tin_tuc"]);


?>
<section class="chi_tiet_tin_tuc container-fluid">
	<div class="row thong_tin_co_ban_tin_tuc">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="title_module">
				<?php echo $thong_tin_tin_tuc->tieu_de_tin; ?>
			</div>
			<!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noi_dung_tom_tat">
				<?php echo $thong_tin_tin_tuc->noi_dung_tom_tat; ?>
			</div-->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noi_dung_chi_tiet">
				<?php echo $thong_tin_tin_tuc->noi_dung_chi_tiet; ?>
				<div class="medal_bai_viet"></div>
			</div>
		</div>
	</div>
</section>