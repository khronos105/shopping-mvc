<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $carrito = $_SESSION['carrito'];
                            foreach ($carrito as $indice => $elemento):
                            $producto = $elemento['producto'];
                        ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <?php if ($producto->imagen != null): ?>
                                                <img src="<?= BASE_URL ?>uploads/products/<?= $producto->imagen ?>"/>
                                            <?php else: ?>
                                                <img src="<?= BASE_URL ?>assets/img/logo.png"/>
                                            <?php endif; ?>
                                        </div>
                                        <div class="media-body">
                                            <p><?= $producto->nombre ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?= $producto->precio ?>$</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="<?= $elemento['unidades'] ?>" title="Quantity:"
                                               class="input-text qty">

                                        <a href="<?= BASE_URL ?>carrito/up&index=<?= $indice ?>" class="increase items-count"><i
                                                    class="ti-arrow-circle-up"></i></a>
                                        <a href="<?= BASE_URL ?>carrito/down&index=<?= $indice ?>" class="reduced items-count"><i
                                                    class="ti-arrow-circle-down"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <h5><?= $elemento['unidades']*$producto->precio ?>$</h5>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Total</h5>
                            </td>
                            <td>
                                <?php $stats = Utils::statsCarrito(); ?>
                                <h5><?= $stats['total'] ?>$</h5>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td class="d-none-l">

                            </td>
                            <td class="">

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="/">Continue Shopping</a>
                                    <div class="delete-carrito">
                                        <a href="<?= BASE_URL ?>carrito/delete_all" class="primary-btn ml-2 btn-empty-cart">Empty cart</a>
                                    </div>
                                    <a class="primary-btn ml-2" href="<?= BASE_URL ?>order/billing">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
            <p>The cart is empty, add some product</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

