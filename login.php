<?php
require('top.php');


?>

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Login</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="login_email" name="login_email" placeholder="Your Email*" style="width:100%">
                                </div>
                                <span class="field_error" id="login_email_error" style="color: red;"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" id="login_pass" name="login_pass" placeholder="Your Password*" style="width:100%">
                                </div>
                                <span class="field_error" id="login_pass_error" style="color: red;"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                            </div>
                        </form>
                        <div class="login_fail">
                            <p class="field_success" style="color: red;"> </p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Register</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form" action="#" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="name" name="name" placeholder="Your Name*" style="width:100%">
                                </div> <span class="field_error" id="name_error" style="color: red;"></span>

                            </div>

                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="email" name="email" placeholder="Your Email*" style="width:100%">
                                </div> <span class="field_error" id="email_error" style="color: red;"></span>

                            </div>

                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="mobile" name="mobile" placeholder="Your Mobile*" style="width:100%">
                                </div> <span class="field_error" id="mobile_error" style="color: red;"></span>

                            </div>

                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="pass" name="pass" placeholder="Your Password*" style="width:100%">
                                </div> <span class="field_error" id="pass_error" style="color: red;"></span>

                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="user_register()" class="fv-btn">Register</button>
                            </div>
                        </form>
                        <div class="reg_success">
                            <p class="field_success" style="color: green;"></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
</section>
<!-- End Contact Area -->


<?php require('footer.php'); ?>