<?php
    $order = $orderData;
    $products = $orderProducts;
?>

    <!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Order Details</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/order/my_orders">My Orders</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
    <div class="container">
        <p class="billing-alert">
            <a href="/order/my_orders"><i class="ti-angle-left"></i>
                Other orders</a>
        </p>
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
            <?php if(isset($_SESSION['admin'])): ?>
                <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                    <div class="confirmation-card">
                        <h3 class="billing-title">Change order status</h3>
                        <form action="<?=base_url?>order/status" method="POST">
                            <input type="hidden" value="<?=$order->id?>" name="order_id"/>
                            <div class="">
                                <select name="order_status">
                                    <option value="confirm" <?=$order->status == "pending" ? 'selected' : '';?>>Pending</option>
                                    <option value="preparing" <?=$order->status == "preparing" ? 'selected' : '';?>>Preparing</option>
                                    <option value="ready" <?=$order->status == "ready" ? 'selected' : '';?>>Ready to send</option>
                                    <option value="sent" <?=$order->status == "sent" ? 'selected' : '';?>>Sent</option>
                                </select>
                            </div>
                            <div class="">
                                <button type="submit" value="submit" class="button button-login w-100">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
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
                    <?php while ($producto = $products->fetch_object()): ?>
                        <tr>
                            <td>
                                <p><?= $producto->nombre ?></p>
                            </td>
                            <td>
                                <h5>x <?= $producto->unidades ?></h5>
                            </td>
                            <td>
                                <p><?= $producto->precio * $producto->unidades ?></p>
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