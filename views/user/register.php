<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): $message = '<strong class="alert_red">Registration failed, enter data correctly</strong>'; ?>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>


<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>Already have an account?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="button button-account" href="/user/login">Login Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner register_form_inner">
                    <h3>Create an account</h3>
                    <form class="row login_form" action="<?=base_url?>user/registerAction" id="register_form" method="POST">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <?php if(isset($message)){ echo $message; } ?>
                            <button type="submit" value="submit" class="button button-register w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
