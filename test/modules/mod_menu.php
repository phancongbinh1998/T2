<?php
include_once('libraries/xl_loai_sach.php');
$xl_loai_sach = new xl_loai_sach();
$ds_loai_cha = $xl_loai_sach->danh_sach_loai_sach_cha();
$xl_loai_sach->disconect();
//echo "<pre>",print_r($ds_loai_cha),"</pre>";

//print_r($_SESSION);

//xử lý lấy số lượng giỏ hàng
$mang_gio_hang = $_SESSION["gio_hang"];
if($mang_gio_hang)
{
  foreach($mang_gio_hang as $mat_hang)
  {
    $tong_so_luong += $mat_hang->so_luong;
  }
}

?>
<nav class="navbar navbar-inverse" style="border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="padding: 0px 15px 0 15px; margin: 0;">
      	<div><img src="images/logo.png" style="height: 50px;" alt="" /> Bookstore</div>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Trang chủ</a></li>
        <li class="dropdown">
        	<a href="#" data-toggle="dropdown" class="dropdown-toggle">Danh mục sách</a>
        	<ul class="dropdown-menu" id="menu1">
        		<?php
        		foreach($ds_loai_cha as $loai_cha)
        		{
        		?>
        		<li <?php if($loai_cha->ds_con) echo 'class="dropdown-submenu"'; ?>>
        			<a href="sach_theo_loai.php?loai_sach=<?php echo $loai_cha->id; ?>"><?php echo $loai_cha->ten_loai_sach; ?></a>
        			<?php
        			if(isset($loai_cha->ds_con))
        			{
      				?>
      				<ul class="dropdown-menu hidden-xs hidden-sm">
      					<?php
      					foreach($loai_cha->ds_con as $loai_con)
      					{
      					?>
    						<li><a href="sach_theo_loai.php?loai_sach=<?php echo $loai_con->id; ?>"><?php echo $loai_con->ten_loai_sach; ?></a></li>
    						<?php
    						}
    						?>
    					</ul>
      				<?php
        			}
        			?>
        		</li>
        		<?php
        		}
        		?>
        	</ul>
        </li>
        <li><a href="tin_tuc_blog.php">Tin tức</a></li> 
        <li><a href="lien_he.php">Liên hệ</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="trang_gio_hang.php">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            <?php
            if($tong_so_luong)
            {
            ?>
            <div class="so_luong_gio_hang"><?php echo $tong_so_luong;?></div>
            <?php
            }
            ?>
          </a>
        </li>
        <?php
        if(!$_SESSION["nguoi_dung"])
        {  
        ?>
        <li><a href="#" id="myBtn"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a></li>
        <?php
        }
        else
        {
        ?>
        <li>
          <a href="#" data-toggle="dropdown" class="dropdown-toggle">Chào bạn <?php echo $_SESSION["nguoi_dung"]->ho_ten; ?></a>
          <ul class="dropdown-menu" id="menu2">
            <li><a href="thong_tin_don_hang.php">Quản lý đơn hàng</a></li>
            <li><a href="dang_xuat.php">Thoát</a></li>
          </ul>
        </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>


<?php
if(!$_SESSION["nguoi_dung"])
{        
?>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Đăng nhập</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="dang_nhap.php" method="post">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Tên đăng nhập</label>
              <input type="text" class="form-control" name="ten_dang_nhap" id="ten_dang_nhap" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Mật khẩu</label>
              <input type="password" class="form-control" name="mat_khau" id="mat_khau" placeholder="Mật khẩu">
            </div>
            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Đăng nhập</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Thoát</button>
          <p>Bạn chưa là thành viên? <a href="dang_ky.php">Đăng ký</a></p>
        </div>
      </div>
      
    </div>
  </div> 
</div>
 
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<?php
}
?>