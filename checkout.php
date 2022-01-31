<?php
require('top.php');
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>

    <script>
        window.location.href = 'index.php';
    </script>

<?php
}

?>

<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">

                            <?php
                            $accordion_class = "accordion__title";
                            if (!isset($_SESSION['USER_LOGIN']) == 'yes') {
                                $accordion_class = "accordion__hide";

                            ?>

                                <div class="accordion__title">
                                    Checkout Method
                                </div>

                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form action="#">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="text" id="login_email" name="login_email" placeholder="Your Email*" style="width:100%">
                                                            <span class="field_error" id="login_email_error" style="color: red;"></span>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" id="login_pass" name="login_pass" placeholder="Your Password*" style="width:100%">
                                                            <span class="field_error" id="login_pass_error" style="color: red;"></span>
                                                        </div>
                                                        <p class="require">* Required fields</p>
                                                        <div class="dark-btn">
                                                            <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form action="#">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Name</label>
                                                            <input type="text" id="name" name="name" placeholder="Your Name*" style="width:100%">
                                                            <span class="field_error" id="name_error" style="color: red;"></span>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="text" id="email" name="email" placeholder="Your Email*" style="width:100%">
                                                            <span class="field_error" id="email_error" style="color: red;"></span>
                                                        </div>

                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="text" id="mobile" name="mobile" placeholder="Your Mobile*" style="width:100%">
                                                            <span class="field_error" id="mobile_error" style="color: red;"></span>
                                                        </div>



                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="text" id="pass" name="pass" placeholder="Your Password*" style="width:100%">
                                                            <span class="field_error" id="pass_error" style="color: red;"></span>
                                                        </div>
                                                        <div class="dark-btn">
                                                            <button type="button" onclick="user_register()" class="fv-btn">Register</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }  ?>

                            <div class="<?php echo $accordion_class ?>">
                                Address Information
                            </div>
                            <form action="" method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Street Address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="City/State" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Post code/ zip" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="<?php echo $accordion_class ?>">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            <input type="radio" name="cod" id="cod" required>
                                            <span>COD</span> <br>
                                            <input type="radio" name="pay" id="pay" required>
                                            <span>PAY</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="send__btn">
                                    <button type="submit" name='submit' class="fr__btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">

                        <?php
                        $total_amount = 0;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $productDetails = get_product($conn, "", "", "", $key);
                            $pname = $productDetails[0]['product_name'];
                            $mrp = $productDetails[0]['product_mrp'];
                            $price = $productDetails[0]['price'];
                            $quantity = $val['quantity'];
                            $image = $productDetails[0]['image'];
                            $total_amount = $total_amount + ($quantity * $price);

                        ?>

                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="media/product/<?php echo $image ?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo $pname ?></a>
                                    <span class="price"><?php echo $price;
                                                        echo '  (' . $quantity . ')' ?></span>

                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="manage_cart ('<?php echo $key ?>', 'remove')"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>



                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo $total_amount ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

<?php require('footer.php'); ?>