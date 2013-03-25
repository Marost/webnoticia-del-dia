<?php
require_once("panel@noticiadia/conexion/conexion.php");
require_once("panel@noticiadia/conexion/funciones.php");

//NOTICIAS
$rst_noticias=mysql_query("SELECT * FROM lndd_noticias WHERE fecha_publicacion<='$fechaActual' AND publicar=1 ORDER BY fecha_publicacion DESC", $conexion);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $web_nombre; ?></title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/preview.css" media="screen" />

	<!-- THE GOOGLE FONT LOAD -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- get jQuery from the google apis -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
    
    <!-- MEGAFOLIO PRO GALLERY CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="libs/megafolio/css/settings.css" media="screen" />

    <!-- MEGAFOLIO PRO GALLERY JS FILES  -->
	<script src="libs/megafolio/js/jquery.themepunch.plugins.min.js"></script>
    <script src="libs/megafolio/js/jquery.themepunch.megafoliopro.js"></script>

	<!-- THE FANYCYBOX ASSETS -->
	<link rel="stylesheet" href="libs/megafolio/fancybox/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
	<script src="libs/megafolio/fancybox/jquery.fancybox.pack.js?v=2.1.3"></script>

	<script type="text/javascript">
	jQuery(document).ready(function() {
		var api=jQuery('.megafolio-container').megafoliopro(
			{
				filterChangeAnimation:"pagebottom",
				filterChangeSpeed:400,
				filterChangeRotate:99,
				filterChangeScale:0.6,
				delay:20,
				defaultWidth:980,
				paddingHorizontal:10,
				paddingVertical:10,
				layoutarray:[9,11,5,3,7,12,4,6,13]
			});

		jQuery(".fancybox").fancybox();

		jQuery('.filter').click(function() {
			jQuery('.filter').each(function() { jQuery(this).removeClass("selected")});
			api.megafilter(jQuery(this).data('category'));
			jQuery(this).addClass("selected");
		});

	});
</script>

</head>
<body class="megaexamples">

	<div class="filter_padder" >
		<div class="filter_wrapper" style="max-width:650px;">
			<div class="filter selected" data-category="cat-all">Política</div>
			<div class="filter" data-category="cat-one">Economía</div>
			<div class="filter" data-category="cat-two">Deportes</div>
			<div class="filter" data-category="cat-three">Espectaculos</div>
			<div class="filter" data-category="cat-four">Tecnología</div>
			<div class="filter last-child" data-category="cat-five">Mundo</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>

	<div class="container">

		<!-- The GRID System -->
		<div class="megafolio-container noborder norounded dark-bg-entries">
			
			<?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
					$noticias_id=$fila_noticias["id"];
					$noticias_url=$fila_noticias["url"];
					$noticias_titulo=$fila_noticias["titulo"];
					$noticias_contenido=$fila_noticias["contenido"];
					$noticias_fecha_hora=explode(" ", $fila_noticias["fecha_publicacion"]);
					$noticias_fecha=explode("-", $noticias_fecha_hora[0]);
					$noticias_hora=explode(":", $noticias_fecha_hora[1]);

					$noticias_imagen=$fila_noticias["imagen"];
					$noticias_imagen_carpeta=$fila_noticias["imagen_carpeta"];
			?>
			<div class="mega-entry cat-one cat-all" 
			data-src="/upload/<?php echo $noticias_imagen_carpeta."".$noticias_imagen; ?>" data-lowsize="">

				<div class="mega-covercaption mega-square-bottom mega-landscape-left mega-portrait-bottom mega-orange">

					<div class="mega-title"><?php echo $noticias_titulo; ?></div>
					<?php echo primerParrafo($noticias_contenido); ?>
				</div>

			</div>
			<?php } ?>

		</div>
	</div>
	
</body>
</html>