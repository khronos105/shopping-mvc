<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): $message = '<p class="alert_green">Registration completed successfully ,please login to access your account</p>'; ?>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>
<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="button button-account" href="<?=base_url?>user/register">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form"  action="<?=base_url?>user/loginAction" method="post" id="contactForm" >
                        <?php if(isset($message)){ echo $message; } ?>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="name" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <?php if(isset($_SESSION['error_login'])){ echo $_SESSION['error_login']; unset($_SESSION['error_login']); } ?>
                            <button type="submit" value="submit" class="button button-login w-100">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
