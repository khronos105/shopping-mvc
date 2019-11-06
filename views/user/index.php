<?php
require 'helpers/flash.php';
//var_dump($_SESSION['identity']);die();
?>
<!--================ Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <?php if (isset($_SESSION['identity'])): ?>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <h3>Account Details</h3>
                        <?php $user = $_SESSION['identity']; ?>

                        <?php if(isset($billingDataMessage)){ ?>
                            <h4><?= $billingDataMessage ?></h4>
                        <?php } ?>
                        <form class="row user_form" action="<?=base_url.'user/updateUserData'?>" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                            <div class="offset-3 col-md-6">
                                <div class="form-group p_star">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?=$user->fname?>">
                                </div>
                                <div class="form-group p_star">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?=$user->lname?>">
                                </div>
                                <div class="form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?=$user->email?>">
                                </div>
                            </div>
                            <div class="offset-3 col-md-6">
                                <div class="form-group p_star">
                                    <div class="image-holder">
                                        <span>
                                            <img class="user-image" src="<?php if($user->image){echo '/uploads/users/' . $user->image;}else{ echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKsaDridr6CIghDv1rmbeG4vJzuDlv-R5V2wS_2aFdWvoC-c-ReA";} ?>" alt="User Image">
                                            <div class="edit-image">Edit</div>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="User image">
                                </div>
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

