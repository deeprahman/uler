<?php
include "html/header.html";
if (isset($_SESSION['msg'])) {
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'>" . $_SESSION['msg'] . "</h3><br>";
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'> ID:" . $_SESSION['id'] . "</h3><br>";
}
if (isset($message)) {
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>{$message}</p></div>";
}
include "gallery.php";
?>
<div class="container-fluid col-md-10 offset-md-1">

    <div class="row alert alert-info mt-1" style="width: 450px;margin: auto;">
        <div class="h3 text-center pt-2 pb-2">Choose a valid image file</div>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>

                        <input class="form-control" type="file" name="file" id="choose-file">
                    </td>
                    <td>
                        <input class="form-control" type="submit" name="submit" value="Upload">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!--Image Gallery-->
    <hr>
    <div class="h3 text-center mb-4">Uploaded Images</div>
    <div class="gallery">
        <?php
        foreach ($results

        as $row):
        $image = "uploaded_files/" . $row['present_name'];
        ?>

        <img src="<?= $image ?>" alt="image" class="float-left img-thumbnail m-3" width="304" height="236" >
        <?php endforeach;?>
    </div>
</div>

<?php include "html/footer.html" ?>
