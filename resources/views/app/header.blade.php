<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>Hosteria San Benito</title>

	<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />

	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/web/css/style.css') }}" />

	<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.css') }}" />

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>
	{{-- hos<script src="{{ asset('js/jquery/jquery.bxslider.min.js') }}"></script> --}}
	{{-- <script src="js/functions.js"></script> --}}
	<script src="{{ asset('js/app/utils.js') }}"></script>


	<link  href="{{ asset('js/lightbox/jquery.fancybox.min.css') }}" rel="stylesheet" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8">
	<script src="{{ asset('js/lightbox/jquery.fancybox.js') }}" type="text/javascript" charset="utf-8"></script>

</head>
<body>
<div class="wrapper">
	<header class="header">
		<nav class="navbar">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav">
						<span class="sr-only">Toggle navigation</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>

					{{-- <a class="navbar-brand" href="#"> --}}
          <a class="navbar-brand" href="#">
            <h5>Hostería San Benito</h5>
          </a>
				</div><!-- /.navbar-header -->

				<div class="collapse navbar-collapse" id="nav">
					<ul class="nav navbar-nav navbar-right">
						<li class="activesss">
							<a href="#header">Home</a>
						</li>

						<li>
							<a href="#section-services">Servicios</a>
						</li>

						<li>
							<a href="#section-promotions">Promociones</a>
						</li>

						<li>
							<a href="#section-gallery">Galeria</a>
						</li>

						<li>
							<a href="#section-pricing">Pesca</a>
						</li>

						<li>
							<a href="#section-contacts">Contacto</a>
						</li>
					</ul>
				</div>
			</div><!-- /.container -->
		</nav><!-- /.navbar navbar-default -->
