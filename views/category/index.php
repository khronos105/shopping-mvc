<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Manage Categories</h1>
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


<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
    <div class="container">
        <div class="row mb-5">
            <div class="offset-4 col-md-8 col-xl-4 mb-4 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">All Categories</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($cat = $categorias->fetch_object()): ?>
                                <tr>
                                    <td><?=$cat->id;?></td>
                                    <td><?=$cat->nombre;?></td>
                                    <td>
                                        <form action="<?=base_url?>category/delete" method="POST">
                                            <input type="hidden" name="cat_id" value="<?=$cat->id?>">
                                            <button type="submit" class="btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="3">
                                    <a href="<?=base_url?>category/create" class="button button-login w-100">Add new category</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>