<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>
                    <?php if (isset($gestion)): ?>
                        <h3>Manage the orders</h3>
                    <?php else: ?>
                        <h3>My orders</h3>
                    <?php endif; ?>
                </h1>
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

<div class="my_orders">
    <div class="container">
        <div class="table-responsive">
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orders->fetch_object()): ?>
                        <tr>
                            <td>
                                <h6><a href="<?= BASE_URL ?>order/detail&id=<?= $order->id ?>"><?= $order->id ?></a></h6>
                            </td>
                            <td>
                                <h6><?= $order->cost ?> $</h6>
                            </td>
                            <td>
                                <h6><?= $order->date ." ".  $order->time ?></h6>
                            </td>
                            <td>
                                <h6><?=Utils::showStatus($order->status)?></h6>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br>
            <br>
        </div>
    </div>
</div>


