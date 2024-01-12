<?php 
session_start();


require "../../inc/user/header.php";
require "../../core/dbconnect.php";

?>

<div class="container text-white">
    <div class="row">
      <div class="col-md-12 my-5">
        <div class="page_header text-center">
            <h2>Shop - Account</h2>
           
        </div>
      </div>


        <div class="col-md-12">
    <div class="row shop-login">
    <div class="col-md-6">
    <?php if(isset($_SESSION['inncorect_user']) && !empty($_SESSION['inncorect_user'])){?>
                            <p class="text-danger"> <?php echo $_SESSION['inncorect_user']; ?></p>

                        <?php }?>
        <div class="box-content">
            <h3 class="heading text-center">I'm a Returning Customer</h3>
            <div class="clearfix space40"></div>

            <form class="logregform" method="post" action="../../handelers/user/auth/login.php">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Username or E-mail Address</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        
                    </div>
                </div>
                <div class="clearfix space20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a class="pull-right text-white" href="#">(Lost Password?)</a>
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clearfix space20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="remember-box checkbox">
                        <label for="rememberme">
                        <input type="checkbox" id="rememberme" name="rememberme">Remember Me
                        </label>
                        </span>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="login" class="btn button btn-md pull-right">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-content">
            <h3 class="heading text-center">Register An Account</h3>
            <div class="clearfix space40"></div>
            <form method="post" action="../../handelers/user/auth/register.php" class="logregform">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>E-mail Address</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <?php if(isset($_SESSION['errors']["email"]) && !empty($_SESSION['errors']["email"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['email']; ?></p>

                        <?php }?>
                    </div>
                </div>
                <div class="clearfix space20"></div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <?php if(isset($_SESSION['errors']["password"]) && !empty($_SESSION['errors']["password"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['password']; ?></p>

                        <?php }?>
                        <div class="col-md-12">
                            <label>confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">
                        <div class="space20"></div>
                        <button type="submit" name="register"class="btn button btn-md pull-right">Register</button>
                    </div>
                </div>
            </form>
            <?php unset($_SESSION['errors'],$_SESSION['inncorect_user']); ?>
        </div>
    </div>
</div>


                
        </div>
    </div>

   

   
</div>

<?php 
require "../../inc/user/footer.php";
?>