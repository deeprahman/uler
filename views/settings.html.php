<?php
include "html/header.html";
include "misc_includes/email.php";
if (isset($_SESSION['msg'])) {
    echo "<h5 style='color: #80bdff; text-align: center;'>" . $_SESSION['msg'] . "</h5><br>";
    echo "<h5 style='color: #80bdff; text-align: center;'>Admin ID:" . $_SESSION['id'] . "</h5><br>";
}
if (isset($_SESSION['status'])) {
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>STATUS :{$_SESSION['status']}</p></div>;";
}
if (isset($message)) {
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>{$message}</p></div>";
}
?>
    <div class="container-fluid col-md-8 offset-md-2">
        <div class="row" style="margin: auto;">
            <div class="card alert-dark w-50 col-md-5 m-2">
<!--                Add Admin-->
                <form class="p-2 card-body" action="settings.php" method="post">
                    <div class="h5 text-center">New Administrator</div>
                    <hr/>
                    <div class="form-group">
                        <input type="text" class="form-control" name="n_name" placeholder="New username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="n_pass" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="n_conf" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control" name="n_submit">Add New Admin
                        </button>
                    </div>
                </form>
            </div>
<!--            Delete Admin-->
            <div class="card alert-warning w-50 col-md-5 m-2">
                <form class="p-2 card-body" action="settings.php" method="post">
                    <div class="h5 text-center">Delete Administrator</div>
                    <hr/>
                    <div class="form-group">
                        <input type="text" class="form-control" name="e_name" placeholder="Existing username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="e_pass" placeholder="Existing Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="e_conf" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger form-control" name="e_submit">Delete From Database
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="margin: auto;">
            <div class="card alert-info w-50 col-md-10 m-3">
<!--                Active New Email-->
                <form class="p-2 card-body" action="settings.php" method="post">
                    <div class="h5 text-center">Active Email Address</div>
                    <hr/>
                    <div class="form-group">
                        <label for="active">Currently Active Email Address:
                            <input type="email" id="active" readonly class="plaintext"
                                   value="<?= $email?>"></label>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="new_email" placeholder="New Email Address">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="conf_email" placeholder="Confirm Email Address">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger form-control" name="email_submit">Activate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include "html/footer.html" ?>