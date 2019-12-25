<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img src="../images/logo.png" style="height: 50px;margin-top: -15px;" /><span>Bookstore</span> Quản trị</a>
			<ul class="user-menu">
				<li class="dropdown pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $_SESSION["nguoi_dung"]->ho_ten; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#" id="thong_tin_nguoi_dung"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Thông tin quản trị</a></li>
						<li><a href="#" id="doi_mat_khau"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Đổi mật khẩu</a></li>
						<li><a href="../dang_xuat.php"><span class="glyphicons glyphicons-log-out" style="margin: 0 6px 0 0; font-size: 20px;" aria-hidden="true"></span> Đăng xuất</a></li>
					</ul>
				</li>
			</ul>
		</div>
						
	</div><!-- /.container-fluid -->
</nav>


<div class="modal fade in" id="doi_mat_khau_modal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">×</button>
	      <h4><span class="glyphicon glyphicon-lock"></span> Đổi mật khẩu</h4>
	    </div>
	    <form role="form" action="doi_mat_khau_admin.php" method="post">
		    <div class="modal-body">
		      
		        <div class="form-group">
		          <label for="usrname"> Mật khẩu cũ:</label>
		          <input type="password" class="form-control" name="mat_khau" id="mat_khau" placeholder="Mật khẩu cũ">
		        </div>
		        <div class="form-group">
		          <label for="psw"> Mật khẩu mới:</label>
		          <input type="password" class="form-control" name="mat_khau_moi" id="mat_khau_moi" placeholder="Mật khẩu mới">
		        </div>
		        <div class="form-group">
		          <label for="psw"> Xác nhận mật khẩu mới:</label>
		          <input type="password" class="form-control" name="re_mat_khau_moi" id="re_mat_khau_moi" placeholder="Xác nhận mật khẩu mới">
		        </div>
		        
		      
		    </div>
		    <div class="modal-footer">
		      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-off"></span> Đổi mật khẩu</button>
		    </div>
	    </form>
	  </div>
	  
	</div>
</div>



<div class="modal fade in" id="thong_tin_nguoi_dung_modal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">×</button>
	      <h4><span class="glyphicon glyphicon-info-sign" style="color: #05F;"></span> Thông tin của bạn</h4>
	    </div>
	    <form role="form" action="doi_mat_khau_admin.php" method="post">
		    <div class="modal-body">
		        <div class="form-group">
		          <div class="col-md-4 col-lg-4">
		          	<span class="glyphicon glyphicon-user"></span> Họ tên:
		          </div>
		          <div class="col-md-8 col-lg-8">
		          	<?php echo $_SESSION["nguoi_dung"]->ho_ten; ?>
		          </div>
		        </div>

		        <div style="clear:both;"></div>

		        <div class="form-group">
		          <div class="col-md-4 col-lg-4">
		          	<svg class="glyph stroked email" style="width: 20px;height: 20px"><use xlink:href="#stroked-email"/></svg> &nbsp;Email:
		          </div>
		          <div class="col-md-8 col-lg-8">
		          	<?php echo $_SESSION["nguoi_dung"]->email; ?>
		          </div>
		        </div>

		        <div style="clear:both;"></div>

		        <div class="form-group">
		          <div class="col-md-4 col-lg-4">
		          	<span class="glyphicon glyphicon-phone"></span> Điện thoại:
		          </div>
		          <div class="col-md-8 col-lg-8">
		          	<?php echo $_SESSION["nguoi_dung"]->dien_thoai; ?>
		          </div>
		        </div>

		        <div style="clear:both;"></div>

		        <div class="form-group">
		          <div class="col-md-4 col-lg-4">
		          	<span class="glyphicon glyphicon-home"></span> Địa chỉ:
		          </div>
		          <div class="col-md-8 col-lg-8">
		          	<?php echo $_SESSION["nguoi_dung"]->dia_chi; ?>
		          </div>
		        </div>
		        <div style="clear:both;"></div>
		    </div>
		    <!--div class="modal-footer">
		      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-off"></span> Đổi mật khẩu</button>
		    </div-->
	    </form>
	  </div>
	  
	</div>
</div>


<script>
	
$(document).ready(function(){
    $("#doi_mat_khau").click(function(){
        $("#doi_mat_khau_modal").modal();
    });
    $("#thong_tin_nguoi_dung").click(function(){
        $("#thong_tin_nguoi_dung_modal").modal();
    });
});
</script>