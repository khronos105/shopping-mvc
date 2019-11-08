<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
                <div class="add-prod-wrapper">
                    <a href="/product/add" class="button button-small">Add new product</a>
                </div>
                <div class="table-responsive">
                    <?php if($products->num_rows>0): ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($product = $products->fetch_object()):
                            ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <?php if ($product->imagen != null): ?>
                                                <img src="<?= BASE_URL ?>uploads/products/<?= $product->imagen ?>"/>
                                            <?php else: ?>
                                                <img src="<?= BASE_URL ?>assets/img/logo.png"/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p><?= $product->nombre ?></p>
                                </td>
                                <td>
                                    <h5><?= $product->precio ?>$</h5>
                                </td>
                                <td>
                                    <h5><?= $product->stock ?></h5>
                                </td>
                                <td>
                                    <a href="<?=BASE_URL?>product/edit&id=<?=$product->id?>" class="button button-gestion">Edit</a>
                                    <a href="<?=BASE_URL?>product/delete&id=<?=$product->id?>" class="button button-gestion button-red">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <h2>There are not products</h2>
                        <div class="text-center">
                            <a href="<?=BASE_URL?>product/add" class="button button-small">
                                Add new product
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

