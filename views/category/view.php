<?php if (isset($categoria)): ?>
	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1><?= $categoria->nombre ?></h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->


	<!-- ================ category section start ================= -->		  
<section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row">
				<?php if ($productos->num_rows == 0): ?>
					<h2>No hay productos para mostrar</h2>
				<?php else: ?>
					<?php while ($product = $productos->fetch_object()): ?>
					<?php $objectCategory = Utils::getCategoryById($product->categoria_id); ?>
						<div class="col-md-6 col-lg-4">
							<div class="card text-center card-product">
								<div class="card-product__img">
									<img class="card-img" src="<?=BASE_URL?>uploads/products/<?=$product->imagen?>" alt="">
									<ul class="card-product__imgOverlay">
										<li>
											<a href="<?=BASE_URL?>carrito/add&id=<?=$product->id?>">
												<button><i class="ti-shopping-cart"></i></button>
											</a>
										</li>
									</ul>
								</div>
								<div class="card-body">
									<p><?=$objectCategory->nombre?></p>
									<h4 class="card-product__title"><a href="<?=BASE_URL?>product/view&id=<?=$product->id?>"><?=$product->nombre?></a></h4>
									<p class="card-product__price"><?=$product->precio?>$</p>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
            </div>
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
	<!-- ================ category section end ================= -->		  

	<?php else: ?>
		<!-- ================ start banner area ================= -->	
		<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>The selected Category doesn't exist</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
<?php endif; ?>
