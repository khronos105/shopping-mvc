<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <?php
        $title = "Edit product";
        $url_action = BASE_URL."product/save&id=".$pro->id;
    ?>
<?php else: ?>
	<?php
        $title = "Add new product";
        $url_action = BASE_URL."product/save";
    ?>
<?php endif; ?>
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1><?=$title?></h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/product/manage">Products</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="form_container">

    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme s_Product_carousel">
                        <div class="single-prd-item">
                            <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
                                <img src="<?=BASE_URL?>uploads/products/<?=$pro->imagen?>" class="thumb"/>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php //var_dump($product);die(); ?>
                <div class="col-lg-5 offset-lg-1">
                    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group p_star">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" name="name" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>"/>
                        </div>
                        <div class="form-group p_star">
                            <label for="description">Descripción</label>
                            <textarea rows="4" class="form-control" name="description"><?=isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>
                        </div>
                        <div class="form-group p_star">
                            <label for="price">Precio</label>
                            <input class="form-control" type="text" name="price" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ''; ?>"/>
                        </div>
                        <div class="form-group p_star">
                            <label for="stock">Stock</label>
                            <input class="form-control" type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ''; ?>"/>
                        </div>
                        <div class="form-group p_star">
                            <div>
                                <label for="category">Category</label>
                            </div>
                            <?php $categorias = Utils::showCategorias(); ?>
                            <div>
                                <select class="form-control" name="category">
                                    <?php while ($cat = $categorias->fetch_object()): ?>
                                        <option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''; ?>>
                                            <?= $cat->nombre ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group p_star">
                            <div>
                                <label for="image">Image</label>
                            </div>
                            <input type="file" name="image" />
                        </div>
                        <div class="form-group">
                            <button class="button button-paypal" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

