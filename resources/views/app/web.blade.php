@include('app.header')

		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="jumbotron-content">
							<h5>Un lugar para conocer</h5>

							<h1>Hostería San Benito</h1>

							<p>En Hostería San Benito encontrará un lugar nuevo, con la mejor atención personalizada y servicios de calidad.</p>
							<p>Nos encontramos a minutos de las termas de Concordia, uno de los principales atractivos de la ciudad...</p>

							{{-- <div class="jumbotron-actions">
								<a href="#" class="btn btn-primary">Download Now</a>

								<a href="#" class="btn btn-dark">View Features</a>
							</div><!-- /.jumbotron-actions --> --}}
						</div><!-- /.jumbotron-content -->
					</div><!-- /.col-md-6 -->

					<div class="col-md-6">
						<div class="jumbotron-image">
							<img src="css/images/temp/jumbotron-image.png" height="519" width="505" alt="">
						</div><!-- /.jumbotron-image -->
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.jumbotron -->
	</header><!-- /.header -->

@include('app/home-inner')
@include('app.footer')
