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

    This is the list page
<?php include "html/footer.html" ?>