<?php
include "html/header.html";
if (isset($_SESSION['msg'])) {
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'>".$_SESSION['msg']."</h3><br>";
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'> ID:".$_SESSION['id']."</h3><br>";
}
if(isset($message)){
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>{$message}</p></div>";
}
?>
    <div class="container-fluid col-md-8 offset-md-2 alert">


        <div class="card w-50" style="margin: auto;">
            <div class="h3 text-center pt-2 pb-2">Log In</div>
            <!--        Form starts-->
            <form class="p-4" action="auth.php" method="post">
                <div class="form-row form-group pl-4">
                    <div class="col form-check">
                        <input class="form-check-input" type="radio" name="is_admin" id="Radio0" value="0" checked>
                        <label class="form-check-label" for="Radio0">
                            Login As Employee
                        </label>
                    </div>
                    <div class="col form-check">
                        <input class="form-check-input" type="radio" name="is_admin" id="Radio1" value="1">
                        <label class="form-check-label" for="Radio1">
                            Login As Admin
                        </label>
                    </div>
                </div>
                <!--            Username-->
                <div class="form-group">

                    <input type="text" name="username" class="form-control" id="usrname" aria-describedby="usrname-help"
                           placeholder="Username">
                </div>
                <!--            Password-->
                <div class="form-group">

                    <input type="password" name="password" class="form-control" id="Password1" placeholder="Password">
                </div>
                <!--            Checkout-->
                <div class="form-check">
                    <input type="checkbox" name="remember" value="ok" class="form-check-input" id="chk_box">
                    <label class="form-check-label" for="chk_box">Remember Me</label>
                </div>
                <!--            Button-->
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
            <!--        Form ends-->
        </div>

    </div>
<?php include "html/footer.html" ?>