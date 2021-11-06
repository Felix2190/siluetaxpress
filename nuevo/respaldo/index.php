<?php 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		    <meta name="Description" CONTENT="Author: Lezlie, silueta express, SILUETA EXPRESSS">
		<title>Silueta Express</title>
		    <meta name="robots" content="index,follow">
		    <meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
			<link rel="stylesheet" type="text/css" href="assets/css/banner_style.css" />
	<script type="text/javascript" src="js/lib/banner/jquery.js"></script>
	<script type="text/javascript" src="js/system/headerLogo.js"></script>
	
	<script type="text/javascript">
	function verPromocion(div){
		$("#div_acapulco").hide();
		$("#div_toluca").hide();
		$("#div_"+div).show();
		$('html,body').animate({
		    scrollTop: $("#div_"+div).offset().top
		}, 2000);
	}
	</script>
	</head>
	<body>
		<div id="page-wrapper">
		<?php 
		include_once 'navhome.php';
		include_once 'banner.php';
		?>

		<div id="main">
		<div class="container">
				<div class="row main-row">
				<div class="12u">
					
					<div class="12u 12u(mobile)">

						<section>
							<h2>Promociones</h2>
							<p></p>						
						</section>
						
					</div>
					
				<div class="row main-row">
					<div class="12u 12u(mobile)">
						
							<h3><img alt="" src="images/icons/social/16/button-green.png">&emsp;<a onclick="verPromocion('acapulco');">En Acapulco</a></h3>
							<div class="row" style="display: none;" id="div_acapulco">
								<div class="5u 12u(mobile)">
									<section>
        								<img src="images/enero4.jpeg" alt=""  style="width: 92%">
        							</section>
        							<section>
        								<img src="images/enero1.jpeg" alt=""  style="width: 70%">
        							</section>
        						</div>
								
								<div class="7u 12u(mobile)">
									<section>
        								<img src="images/enero3.jpeg" alt=""  style="width: 75%">
        							</section>
        							<section>
        								<img src="images/enero2.jpeg" alt=""  style="width: 97%">
        							</section>
								</div>
							</div>
							
							<h3><img alt="" src="images/icons/social/16/button-green.png">&emsp;<a onclick="verPromocion('toluca');">En Toluca</a></h3>
							<div class="row" style="display: none;" id="div_toluca">
							
								<div class="6u 12u(mobile)">
							
        						<section>
        						<img src="images/metepec.jpeg" alt=""  style="width: 75%">
        						</section>
        						
        						<section>
        						<img src="images/metepec2.jpeg" alt=""  style="width: 75%">
        						</section>
        						
        						<section>
        						<img src="images/metepec5.jpeg" alt=""  style="width: 75%">
        						</section>
        						
        						
								</div>
								
								<div class="6u 12u(mobile)">
							
        						<section>
        						<img src="images/metepec3.jpeg" alt=""  style="width: 70%">
        						</section>
        					
        						<section>
        						<img src="images/metepec4.jpeg" alt=""  style="width: 70%">
        						</section>
        						
								</div>
								
							</div>
							
					</div>
					
				</div>
						<div class="7u" style="display: none;">
						
							<h3>Nuevas </h3>
							<div class="row" style="margin-left: 5%;">
        						<section>
        						<img src="images/agosto1.jpeg" alt=""  style="width: 80%">
        						</section>
        					</div>
        					<div class="row" style="margin-left: 5%;">
        						<section>
        						<img src="images/agosto2.jpeg" alt=""  style="width: 80%">
        						</section>
        						
        					</div>
        					<div class="row" style="margin-left: 5%;">
        						<section>
        						<img src="images/agosto3.jpeg" alt=""  style="width: 80%">
        						</section>
        					</div>
        					
						</div>
						<div class="7u" style="display: none;">
							
							<h3>Pr&oacute;ximas (mayo)</h3>
							<div class="row" style="margin-left: 5%;">
        						<section>
        						<img src="images/mayo1.jpeg" alt=""  style="width: 80%">
        						</section>
        					</div>
        					<div class="row" style="margin-left: 1%;">
        						<section>
        						<img src="images/mayo3.jpeg" alt=""  style="width: 95%">
        						</section>
        						
        					</div>
        					<div class="row" style="margin-left: 5%;">
        						<section>
        						<img src="images/mayo2.jpeg" alt=""  style="width: 80%">
        						</section>
        					</div>
        					
						</div>
						
						
						<div class="5u" style="display: none;">
						<h3>Por apertura en Metepec</h3>
						<section>
												
						<div class="row" style="margin-left: 5%;">
						
        						<section>
        						<img src="images/metepec.jpeg" alt=""  style="width: 95%">
        						</section>
        					
        						<section>
        						<img src="images/metepec2.jpeg" alt=""  style="width: 85%">
        						</section>
        					
        						<section>
        						<img src="images/metepec3.jpeg" alt=""  style="width: 85%">
        						</section>
        						
        						<section>
        						<img src="images/metepec4.jpeg" alt=""  style="width: 85%">
        						</section>
        					
        						<section>
        						<img src="images/metepec5.jpeg" alt=""  style="width: 85%">
        						</section>
        						
						
						</div>
						
						</section>

					</div>
					
					
					<div class="12u" style="display: none;">

						<section>
							<h2>Otras</h2>
						</section>
						
					</div>
					
					<div class="6u" style="display: none;">						
					<section>
    				<img src="images/facial.jpg" alt=""  style="width: 80%">
    				</section>
        					
    				<section>
      				<img src="images/reduce.jpg" alt=""  style="width: 80%">
        			</section>
        					
					</div>
					
					<div class="6u"style="display: none;">
						<section>
        				<img src="images/depilacion.jpg" alt=""  style="width: 90%;">
        				</section>
        				<section>
        				<img src="images/reduce2.jpg" alt=""  style="width: 80%">
        				</section>
        						
					</div>
					
					
			</div>

				

			</div>

		</div>

		</div>
		
		<?php include_once 'footer.php';?>
		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
<script type="text/javascript" src="js/lib/banner/wowslider.js"></script>
<script type="text/javascript" src="js/lib/banner/script.js"></script>

	</body>
</html>