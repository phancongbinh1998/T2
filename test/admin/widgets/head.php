<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản trị admin</title>
<link rel="icon" href="../images/logo.ico" type="image/x-icon">
<link href="css/glyphicon.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>


<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
	$('#calendar').datepicker({
	});

	!function ($) {
	    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
	        $(this).find('em:first').toggleClass("glyphicon-minus");      
	    }); 
	    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
	}(window.jQuery);

	$(window).on('resize', function () {
	  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
	})
	$(window).on('resize', function () {
	  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
	})
</script>	