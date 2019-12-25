<?php
$thong_tin_sach = $xl_sach->thong_tin_sach_theo_id($_GET["id_sach"]);


?>
<section class="chi_tiet_sach">
	<div class="row thong_tin_co_ban_sach">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="title_module">
				<?php echo $thong_tin_sach->ten_sach; ?>
			</div>
		</div>
		
		<form action="them_vao_gio_hang.php" method="post">
			<div class="col-md-4 col-lg-4">
				<div class="thong_tin_hinh">
					<div class="chi_tiet_hinh">
						<img src="images/sach/<?php echo $thong_tin_sach->hinh; ?>" alt="" title="" />
					</div>
					<?php
					if($thong_tin_sach->doc_thu)
					{
					?>
						<div class="doc_thu_sach" data-toggle="modal" href='#modal-id'>Đọc thử</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-8 col-lg-8">
				<div class="thong_tin_sach">
					<div class="tac_gia">
						<?php
						if($thong_tin_sach->ten_tac_gia)
						{
						?>
							<span>Tác giả: </span><?php echo $thong_tin_sach->ten_tac_gia; ?>
						<?php
						}
						?>
					</div>
					<div class="gia_ban">
						<?php
						if($thong_tin_sach->don_gia)
						{
						?>
							<span>Giá bán tại Bookstore: </span><?php echo number_format($thong_tin_sach->don_gia,0,",","."); ?> ₫
						<?php
						}
						?>
					</div>
					<div>
						<?php
						if($thong_tin_sach->don_gia)
						{
						?>
							<span>Giá bìa: </span><span class="gia_bia"><?php echo number_format($thong_tin_sach->gia_bia,0,",","."); ?> ₫</span>
						<?php
						}
						?>
					</div>
					<div class="div_chua_btn_dat_hang">
						<input type="hidden" name="id_sach" value="<?php echo $thong_tin_sach->id; ?>" />
						<input type="number" name="so_luong_mua" value="1" min="1" max="10" />
						<input type="submit" class="btn_dat_mua" value="Thêm vào giỏ hàng"/>
					</div>

					<!-- facebook like share -->
					<div class="fb-like" data-href="http://locahost:81<?php echo $_SERVER["PHP_SELF"]; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<!-- END facebook like share -->
					
					<div class="cac_thong_tin_khac">
						<table class="table table-hover">
							<tbody>
								<?php
								if($thong_tin_sach->don_gia)
								{
								?>
								<tr>
									<td style="width: 300px;">Nhà xuất bản: </td>
									<td><?php echo $thong_tin_sach->ten_nha_xuat_ban; ?></td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->kich_thuoc)
								{
								?>
								<tr>
									<td style="width: 300px;">Kích thước: </td>
									<td><?php echo $thong_tin_sach->kich_thuoc; ?></td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->sku)
								{
								?>
								<tr>
									<td style="width: 300px;">Mã SKU: </td>
									<td><?php echo $thong_tin_sach->sku; ?></td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->trong_luong)
								{
								?>
								<tr>
									<td style="width: 300px;">Trọng lượng vận chuyển (gram): </td>
									<td><?php echo $thong_tin_sach->trong_luong; ?></td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->ngay_xuat_ban)
								{
								?>
								<tr>
									<td style="width: 300px;">Ngày xuất bản: </td>
									<td><?php echo $thong_tin_sach->ngay_xuat_ban; ?></td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->ten_loai_sach)
								{
								?>
								<tr>
									<td style="width: 300px;">Thuộc thể loại: </td>
									<td><?php echo $thong_tin_sach->ten_loai_sach; ?></td>
								</tr>
								<?php
								}
								?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="thanh_ngan_cach_module"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 gioi_thieu_sach">
		<?php echo $thong_tin_sach->gioi_thieu; ?>
	</div>

	<!-- facebook comment -->
	<div class="fb-comments" data-href="http://<?php echo $_SERVER["HTTP_HOST"] .$_SERVER["REQUEST_URI"]; ?>" data-numposts="5"></div>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- END facebook comment -->

</section>
<?php
if($thong_tin_sach->doc_thu)
{
	$noi_dung_doc_thu = file_get_contents($thong_tin_sach->doc_thu);
	$mang_duong_dan_doc_thu = explode("/", $thong_tin_sach->doc_thu);
	array_pop($mang_duong_dan_doc_thu);array_pop($mang_duong_dan_doc_thu);

	$duong_dan = implode("/", $mang_duong_dan_doc_thu);
	//echo $duong_dan;
	$noi_dung_doc_thu = str_replace("../", $duong_dan."/", $noi_dung_doc_thu);
	?>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog ">
			<div class="modal-content">
				<button type="button" class="close dong_doc_thu" data-dismiss="modal">×</button>
				<div class="modal-body sach_doc_thu">
					<?php echo $noi_dung_doc_thu; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>