<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Add new Category</h1>
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
                    <form class="add-category" action="<?=BASE_URL?>category/add" method="POST">
                        <div>
                            <input type="text" name="title" placeholder="Title" required/>
                        </div>
                        <div>
                            <button type="submit" class="button button-paypal">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
