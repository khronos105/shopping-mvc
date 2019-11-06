

<?php if (isset($product)): ?>


  <!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="owl-carousel owl-theme s_Product_carousel">
						<div class="single-prd-item">
							<?php if ($product->imagen != null): ?>
								<img class="img-fluid" src="<?= base_url ?>uploads/products/<?= $product->imagen ?>" />
							<?php else: ?>
								<img class="img-fluid" src="<?= base_url ?>assets/img/logo.png" />
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php //var_dump($product);die(); ?>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?= $product->nombre ?></h3>
						<h2><?= $product->precio ?></h2>
						<ul class="list">
							<li><a class="active" href="#"><span>Category</span> : <?= $product->catnombre ?></a></li>
							<li><a><span>Stock</span> : <?= $product->stock ?></a></li>
						</ul>
						<p><?= $product->descripcion ?></p>
						<div class="product_count">
							<a class="button primary-btn" href="<?=base_url?>carrito/add&id=<?=$product->id?>">Add to Cart</a>               
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->
	
<?php else: ?>
	<h1>El producto no existe</h1>
<?php endif; ?>
