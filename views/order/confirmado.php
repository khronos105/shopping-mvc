<?php //var_dump($order); die(); ?>

<?php if (isset($orderComplete) && $orderComplete == 'complete'): ?>

<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
    <div class="container">
        <p class="text-center billing-alert">Thank you. Your order has been received.</p>
        <div class="row mb-5">
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">Order Info</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Order id</td>
                            <td>: <?= $order->id ?></td>
                        </tr>
                        <tr>
                            <td>Date & Time</td>
                            <td>: <?= $order->date ." " .  $order->time ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>: <?= $order->cost ?> $</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">Billing Address</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Country</td>
                            <td>: <?=$order->country ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>: <?=$order->city ?></td>
                        </tr>
                        <tr>
                            <td>Street</td>
                            <td>: <?=$order->address ?></td>
                        </tr>
                        <tr>
                            <td>Postcode</td>
                            <td>: <?=$order->zip ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="order_details_table">
            <h2>Order Details</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($product = $products->fetch_object()): ?>
                        <tr>
                            <td>
                                <p><?= $product->nombre ?></p>
                            </td>
                            <td>
                                <h5>x <?= $product->unidades ?></h5>
                            </td>
                            <td>
                                <p><?= $product->precio * $product->unidades ?></p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td>
                            <h4>Total</h4>
                        </td>
                        <td>
                            <h5></h5>
                        </td>
                        <td>
                            <h4><?= $order->cost ?> $</h4>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->




<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>