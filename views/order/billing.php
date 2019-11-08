<?php

require 'helpers/countries.php';
//var_dump($_SESSION); die();
?>
<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <?php if (isset($_SESSION['identity'])): ?>
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <?php $user = $_SESSION['identity']; ?>
                        <form class="row contact_form" action="<?=BASE_URL.'order/add'?>" method="POST" novalidate="novalidate">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?=$user->fname?>">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?=$user->lname?>">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number"  value="<?=$user->phone?>">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?=$user->email?>">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="country">
                                    <option value="">Select country</option>
                                    <?php foreach($countries as $country){ ?>
                                        <?php if($country == $user->country){ ?>
                                            <option selected><?=$country?></option>
                                        <?php } else { ?>
                                            <option><?=$country?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" placeholder="Town/City" value="<?=$user->city?>">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="address" placeholder="Address" value="<?=$user->address?>">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" value="<?=$user->zip?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
                                    <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                                    <?php
                                        $carrito = $_SESSION['carrito'];
                                        foreach ($carrito as $indice => $elemento):
                                        $producto = $elemento['producto'];
                                    ?>
                                    <li>
                                        <a><?= $producto->nombre ?> <span class="middle">x <?= $elemento['unidades'] ?></span> <span class="last"><?= $elemento['unidades']*$producto->precio ?>$</span></a>
                                    </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <ul class="list list_2">
                                <?php $stats = Utils::statsCarrito(); ?>
                                <li><a href="#">Total <span><?= $stats['total'] ?>$</span></a></li>
                            </ul>
                            <div class="payment_item">
                                <p>Please send a check to Aroma Store.</p>
                            </div>
                            <?php if(isset($_SESSION['billing'])){ ?>
                                <div class="payment_item">
                                    <p class="error"><?php echo $_SESSION['billing']; ?></p>
                                </div>
                            <?php
                                unset($_SESSION['billing']);
                            } ?>
                            <div class="text-center">
                                <button class="button button-paypal" onclick="$('.contact_form').submit()">Confirm your purchase</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <h1>Necesitas estar identificado</h1>
                <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

