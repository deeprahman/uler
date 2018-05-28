<?php
include "html/header.html";
if (isset($_SESSION['msg'])) {
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'>" . $_SESSION['msg'] . "</h3><br>";
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'> ID:" . $_SESSION['id'] . "</h3><br>";
}
if (isset($_SESSION['report'])) {
    echo "<div class='alert alert-success' role='alert' style='width: 400px;margin: auto'><p align='center'>{$_SESSION['report']}</p></div>";
}
if(isset($message)){
    echo "<div class='alert alert-warning' role='alert' style='width: 400px;margin: auto'><p align='center'>{$message}</p></div>";
}
?>
<!--HTML Begins-->
<div class=" row container-fluid col-sm-8 offset-sm-2" style="margin-top: 70px;">
    <div class="row alert alert-info" style="width: 450px;margin: auto;">
        <form action="arrival.php" method="post">
            <button type="submit" name="arrival" value="ok">Put an Arrival Stamp</button>
        </form>
    </div>
</div>
<div class="row container-fluid col-sm-8 offset-sm-2" style="margin-top: 70px;">
    <div class="row alert alert-dark" style="width: 450px;margin: auto;">
        <form action="depart.php" method="post">
            <button type="submit" name="departure" value="ok">Put a Departure Stamp</button>
        </form>
    </div>
</div>

<?php include "html/footer.html" ?>
