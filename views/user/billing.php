<?php
require 'helpers/countries.php';
require 'helpers/flash.php';
?>
<!--================ Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <?php if (isset($_SESSION['identity'])): ?>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <h3>Billing Details</h3>
                        <?php $user = $_SESSION['identity']; ?>

                        <?php if(isset($billingDataMessage)){ ?>
                            <h4><?= $billingDataMessage ?></h4>
                        <?php } ?>
                        <form class="row contact_form" action="<?=BASE_URL.'user/updateBilling'?>" method="POST" novalidate="novalidate">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" value="<?=$user->phone?>" >
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <select class="country_select" name="country">
                                    <option value="">Select your Country</option>
                                    <?php foreach($countries as $country){ ?>
                                        <?php if($country == $user->country){ ?>
                                            <option selected><?=$country?></option>
                                        <?php } else { ?>
                                            <option><?=$country?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" placeholder="Town/City" value="<?=$user->city?>">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="address" placeholder="Address" value="<?=$user->address?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" value="<?=$user->zip?>">
                            </div>
                            <div class="offset-3 col-md-6 form-group">
                                <div class="text-center">
                                    <button type="submit" class="button button-paypal">Update</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            <?php else: ?>
                <h1>You need to be authenticated</h1>
                <p>You need to be logged in to place your order.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

