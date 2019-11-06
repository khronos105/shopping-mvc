<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aroma Shop - Home</title>
	<link rel="icon" href="/assets/img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="/vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="/vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="/vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="/vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="/"><img src="/assets/img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
		  </button>
		  
		  <?php $categorias = Utils::showCategorias(); ?>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
              <?php while($cat = $categorias->fetch_object()): ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url?>category/view&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                </li>
              <?php endwhile; ?>
            </ul>

            <ul class="nav nav-shop">
                <li class="nav-item submenu dropdown">
                    <a class="nav-link dropdown-toggle"class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-user"></i>
                        <?php if(isset($_SESSION['identity'])){ echo $_SESSION['identity']->fname . " ". $_SESSION['identity']->lname; } ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if(isset($_SESSION['identity'])){ ?>
                            <li class="nav-item"><a class="nav-link" href="/user/index">My Account</a></li>
                            <?php if(isset($_SESSION['admin'])){ ?>
                                <li class="nav-item"><a class="nav-link" href="/category/index">Manage Categories</a></li>
                                <li class="nav-item"><a class="nav-link" href="/product/manage">Manage Products</a></li>
                                <li class="nav-item"><a class="nav-link" href="/order/all_orders">Manage Orders</a></li>
                            <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="/user/billing">Billing Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="/order/my_orders">My Orders</a></li>
                            <li class="nav-item"><a class="nav-link" href="/user/reset_pass">Reset Password</a></li>
                            <li class="nav-item"><a class="nav-link" href="/user/logout">Log out</a></li>
                        <?php }else{ ?>
                            <li class="nav-item"><a class="nav-link" href="/user/login">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="/user/register">Register</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/carrito/index">
                        <i class="ti-shopping-cart"></i>
                        <span class="nav-shop__circle"><?php if(Utils::statsCarrito()['count']>0 && !isset($_SESSION['pedido'])){echo Utils::statsCarrito()['count'];} ?></span>
                    </a>
                </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->
