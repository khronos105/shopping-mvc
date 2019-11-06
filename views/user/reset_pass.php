<?php
require 'helpers/flash.php';
?>
<!--================ Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <?php if (isset($_SESSION['identity'])): ?>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <h3>Reset Password</h3>
                        <?php $user = $_SESSION['identity']; ?>

                        <?php if(isset($billingDataMessage)){ ?>
                            <h4><?= $billingDataMessage ?></h4>
                        <?php } ?>

                        <form class="row contact_form" action="<?=base_url.'user/resetPass'?>" method="POST" novalidate="novalidate">
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="newPassword2" name="newPassword2" placeholder="Confirm Password">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="text-center">
                                    <a class="button button-paypal" onclick="$('.contact_form').submit()">Update</a>
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

