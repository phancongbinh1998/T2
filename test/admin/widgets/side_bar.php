<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<!--form role="search">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		</div>
	</form-->
	<ul class="nav menu">
		<?php
		if($_SESSION["nguoi_dung"]->id_loai_user == 5 || $_SESSION["nguoi_dung"]->id_loai_user == 7)
		{
		?>
		<li class="active"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
		<!--li><a href="widgets.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>
		<li><a href="charts.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
		<li><a href="tables.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
		<li><a href="forms.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>
		<li><a href="panels.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
		<li><a href="icons.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li-->
		<li class="parent">
			<a data-toggle="collapse" href="#sub-item-1">
				<span><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg></span> Quản lý bán hàng 
			</a>
			<ul class="children collapse" id="sub-item-1">
				<li>
					<a class="" href="danh_sach_san_pham.php">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý sách
					</a>
				</li>
				<li>
					<a class="" href="danh_sach_loai_sach.php">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý loại sách
					</a>
				</li>
			</ul>
		</li>
		<li class="parent">
			<a data-toggle="collapse" href="#sub-item-3">
				<span><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg></span> Quản lý đơn hàng 
			</a>
			<ul class="children collapse" id="sub-item-3">
				<li>
					<a class="" href="danh_sach_don_hang.php">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Danh sách đơn đặt hàng
					</a>
				</li>
			</ul>
		</li>
		<?php
		}
		if($_SESSION["nguoi_dung"]->id_loai_user == 6 || $_SESSION["nguoi_dung"]->id_loai_user == 7)
		{
		?>
		<li class="parent">
			<a data-toggle="collapse" href="#sub-item-2">
				<span><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"></use></svg></span> Quản lý giao diện 
			</a>
			<ul class="children collapse" id="sub-item-2">
				<li>
					<a class="" href="danh_sach_slide_banner.php">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Quản lý slide banner
					</a>
				</li>
			</ul>
		</li>
		<li class="parent">
			<a data-toggle="collapse" href="#sub-item-4">
				<span class="glyphicons glyphicons-newspaper" style="margin: 0 12px 0 0" aria-hidden="true"></span> Quản lý tin tức 
			</a>
			<ul class="children collapse" id="sub-item-4">
				<li>
					<a class="" href="danh_sach_tin_tuc.php">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Danh sách tin tức
					</a>
				</li>
			</ul>
		</li>
		<?php
		}
		if($_SESSION["nguoi_dung"]->id_loai_user == 7)
		{
		?>
		<li class="parent">
			<a data-toggle="collapse" href="#sub-item-5">
				<span class="glyphicons glyphicons-user-structure" style="margin: 0 12px 0 0" aria-hidden="true"></span> Quản lý người dùng 
			</a>
			<ul class="children collapse" id="sub-item-5">
				<li>
					<a class="" href="danh_sach_nguoi_dung.php">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Danh sách người dùng
					</a>
				</li>
			</ul>
		</li>
		<?php
		}
		?>
		<li role="presentation" class="divider"></li>
		<!--li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li-->
	</ul>

</div><!--/.sidebar-->