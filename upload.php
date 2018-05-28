<?php
declare(strict_types = 1);
/**
 * Active security features:
 * 1.Limit the number of file can be uploaded (Not active)
 * 2.Limit the size of the file.
 * 3.Protection against file name injection attack.
 * 4.Move to separate upload directory.
 */
include "misc_includes/session_start.php";


use classes\FileUpload;

include "d_connection/database.php";
//Check if the file is uploaded and the submit button is clicked
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    //Limit upload file size
    if (filesize($_FILES['file']['tmp_name']) > 4000000) {
        exit("<div align='center'><h4>MAX SIZE EXCEEDS!</h4><br/><p>The Image size is greater than 4MB.</p>></div>");
    }

    //include the PHP file for FIleUpload class
    include "classes/FileUpload.php";
    //Instantiate the FileUpload class
    $file_uplaod = new FileUpload($_FILES['file'], TRUE);
//    The array contains integer value for image type in PHP
    $allow_img_int = array(1, 2, 3);
    $image_exif_check = exif_imagetype($_FILES['file']['tmp_name']);
    if (!in_array($image_exif_check, $allow_img_int)) {
        exit("<h1 align='center'>NOT A VALID IMAGE FILE!</h1>");
    }
//    Move file to specified directory
    $tar_dir = "uploaded_files";
    $upload_status = $file_uplaod->moveFile($tar_dir);
    if ($upload_status) {
        $names = $file_uplaod->getNames();
//        Insert the uploaded file details into the database
        $id = (int) $_SESSION['id'];
        $sql_insert = <<<HERE
INSERT INTO photo_upload (present_name, base_name, user_id, upload_epoch) VALUES (?,?,?,now())
HERE;

        try {

            $prepared = $db->prepare($sql_insert);
            $prepared->bindValue(1,$names['presentName']);
            $prepared->bindValue(2,$names['base']);
            $prepared->bindValue(3,$id);

            $prepared->execute();
        }catch(PDOException $exception){
            exit("Could not execute the SQL statement ".$exception->getMessage());
        }

        $_SESSION['upload'] = TRUE;
        header("location:.");

    } else {
        exit("<h5 align='center'>File could not be uploaded!</h5>>");
    }
} else {
    header("location:.");
}