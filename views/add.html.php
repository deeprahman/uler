<?php
include "html/header.html";
if (isset($_SESSION['msg'])) {
    echo "<h5 style='color: #80bdff; text-align: center;'>".$_SESSION['msg']."</h5><br>";
    echo "<h5 style='color: #80bdff; text-align: center;'>Admin ID:".$_SESSION['id']."</h5><br>";
}
if (isset($_SESSION['status'])){
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>STATUS :{$_SESSION['status']}</p></div>;";
}
if(isset($message)){
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>{$message}</p></div>";
}
?>
    <div class="container-fluid col-sm-8 offset-sm-2">
        <div class="card w-60" style="margin: auto;">
            <div class="h3 text-center pt-2 pb-2">Add New Employee</div>
            <hr>
            <!-- Form starts -->
            <form id="emp" class="p-4" action="addEmplye.php" method="post">

                <div class="form-row form-group">
                    <div class="col-sm-6">
                        <input type="text" name="firstname" class="form-control" placeholder="First name" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="middlename" class="form-control" placeholder="Middle name" required>
                    </div>
                    <div class="col-sm-6 pt-2">
                        <input type="text" name="lastname" class="form-control" placeholder="Last name" required>
                    </div>
                </div>
                <hr>
                <div class="form-row form-group">
                    <div class="col-sm-4">
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="city" class="form-control" placeholder="City" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="zip" class="form-control" placeholder="Zip code" required>
                    </div>
                </div>
                <hr>
                <div class="form-row form-group">
                    <div class="col-sm-5">
                        <input type="text" name="designation" class="form-control" placeholder=" Employee Designation" required>
                    </div>
                    <div class="col-sm-5 ">
                        <lebel for="gender">Gender: </lebel>
                        <select name="gender" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-row form-group">
                    <div class="col-sm-6">
                        <input type="text" name="emp_username" class="form-control" placeholder="Username (Do not use previously assigned one)" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" name="emp_password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-sm-6 offset-sm-3 pt-2">
                        <input type="text" name="id" class="form-control" placeholder="Employee ID (Do not use previously assigned one)" required>
                    </div>
                </div>
            </form>
            <!-- Form ends -->
        </div>
        <div class="w-60 pt-3 col-sm-6 offset-sm-3" style="margin: auto;">
            <input form="emp" type="submit" name="submit" value="Add to Database" class="form-control btn btn-success">
        </div>
    </div>
<?php include "html/footer.html" ?>