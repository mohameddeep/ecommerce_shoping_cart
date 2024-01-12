<?php 
session_start();

// if(isset($_SESSION['errors'])){
//     $_SESSION['errors']=$error;
// };
//var_dump($_SESSION['errors']);
require "../../inc/admin/header.php";
// require "../../inc/admin/nav.php";
?>


<div class="container pt-5">
    <h2 class='text-center text-white text-uppercase'>Admin Login</h2>

    <div class="row text-white mt-5">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="box-content">
                <div class="clearfix space40"></div>
                <form action="../../handelers/admin/login.php" method="get" class="logregform">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Username or E-mail Address</label>
                                <input type="text" value="" name="email" class="form-control">
                            </div>
                            <?php if(isset($_SESSION['errors']["email"]) && !empty($_SESSION['errors']["email"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['email']; ?></p>

                        <?php }?>
                    </div>
                        </div>
                    </div>
                    <div class="clearfix space20"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="pull-right text-white" href="#">(Lost Password?)</a>
                                <label>Password</label>
                                <input type="text" value="" name="password" class="form-control">
                            </div>
                            <?php if(isset($_SESSION['errors']["password"]) && !empty($_SESSION['errors']["password"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['password']; ?></p>

                        <?php }?>
                        </div>
                    </div>
                    <div class="clearfix space20"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="remember-box checkbox">
                            <label for="rememberme">
                            <input type="checkbox" id="rememberme" name="rememberme" class='mr-2'>Remember Me
                            </label>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="login" class="btn button btn-md pull-right">Login</button>
                        </div>
                    </div>
                </form>

                <?php session_unset(); ?>
            </div>
        </div>
    </div>

  

   
</div>

<?php 


require "../../inc/admin/footer.php";
?>