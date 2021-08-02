<main>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
						<div class="carousel-inner">
							<div class="carousel-item active">
								<center>
								<img class="d-block" src="/uploads/baner/84987-3.jpg" alt="">
								</center>
							</div>
							<!-- <div class="carousel-item">
								<center>
								<img class="d-block" src="https://image.freepik.com/free-vector/flat-abstract-geometric-real-estate-twitter-header_23-2149024020.jpg" alt="">
								</center>
							</div> -->
							<div class="carousel-item">
								<center>
								<img class="d-block" src="/uploads/baner/84987-3.jpg" alt="">
								</center>
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12 mt-2">
					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="/uploads/baner/84987-4.jpg" alt="First slide">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-2">
					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="/uploads/baner/84987-4.jpg" alt="First slide">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row align-items-center mt-4 text-center">
				<div class="col-lg-12">
					<div class="my-masonry">
						<div class="button-group filter-button-group " >
							
							
							<button class="btn" >all</button>
							<button class="btn" data-filter=".1"  >cat_type</button>
							<button class="btn" data-filter=".3"  >cat_type</button>
							<button class="btn" data-filter=".9" >cat_type</button>
							<button class="btn" data-filter=".10" >cat_type</button>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-12 mt-2">
<!-- 				<div class="col-4">
					<div class="product_grid" >
						<div class="card" id="product_grid">
							<img src="https://preorderjapan.com/wp-content/uploads/2021/07/%E0%B8%81%E0%B8%A3%E0%B8%AD%E0%B8%9A-19-600x600.jpg">
						</div>
						<label class="label-card">add</label>
					</div>
				</div> -->
				<?php for ($x = 0; $x < 15; $x++)  { 
					if ($x == 15) {
    break;
  }
				?>
				<div class="col-4 mt-4" id="colum-product">					
					<div class="product-grid">
						<div class="product-image">
							<a href="<?php echo route('product') ?>" class="image">
								<img class="pic-1" src="https://preorderjapan.com/wp-content/uploads/2021/07/%E0%B8%81%E0%B8%A3%E0%B8%AD%E0%B8%9A-19-600x600.jpg">
							</a>
							<!-- <span class="product-sale-label">Sale</span> -->
							<ul class="product-links">
								<li><a href="#"><i class="far fa-heart"></i></a></li>
								<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-random"></i></a></li> -->
								<li><a href="#"><i class="fa fa-eye"></i></a></li>
							</ul>
						</div>
						<center>
						<div class="product-content">
							<h3 class="title"><a href="#">##PD-name##</a></h3>

							<div class="price"><span>$93.10</span> $73.10</div>
						</div>
						</center>
					</div>					
				</div>
			<?php } ?>
<!-- 				<div class="col-4 mt-4" id="colum-product">					
					<div class="product-grid">
						<div class="product-image">
							<a href="#" class="image">
								<img class="pic-1" src="https://preorderjapan.com/wp-content/uploads/2021/07/%E0%B8%81%E0%B8%A3%E0%B8%AD%E0%B8%9A-19-600x600.jpg">
							</a>						
							<ul class="product-links">
								<li><a href="#"><i class="far fa-heart"></i></a></li>
								<li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>							
								<li><a href="#"><i class="fa fa-eye"></i></a></li>
							</ul>
						</div>
						<center>
						<div class="product-content">
							<h3 class="title"><a href="#">##PD-name##</a></h3>

							<div class="price"><span>$93.10</span> $73.10</div>
						</div>
						</center>
					</div>					
				</div> -->
			</div>
		</div>
				<!-- 		</div> -->
				<!--
							<div class="card mt-3 border-0">
									<div class="card-body">
											<div class="row">
													<div class="col-md-12">
															<h4>ATESTE</h4>
													</div>
											</div>
									</div>
				</div> -->

<!-- <div class="container"> -->
<!--   <h2>Modal Example</h2>
  <button type="button" class="btn btn-info btn-lg">Open Modal</button> -->

  <!-- Modal -->
  <div class="row">
  	<div class="col-12">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
       
        <div class="modal-body">
          <div class="col-6" id="colum-product">
          	<h3>เข้าสู่ระบบ</h3>
          	<h6>username</h6>
          	<input type="username" name="username" class="form-control">
          	<h6>password</h6>
          	<input type="password" name="username" class="form-control">
          </div>

          <div class="col-6" id="colum-product">
          	<div class="vl" id="colum-product"></div>
          	B side
          </div>
        </div>       
      </div>      
    </div>
  </div>
  </div>
  </div>
  
</div>
			
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		
		// Lift card and show stats on Mouseover
		$('#product_grid').hover(function(){
				$(this).addClass('label-card');
				
			};


// $('#exampleModal').on('show.bs.modal', function () {
//   $('#btn').trigger('focus')
// })

		};


	</script>