<?php
/**
 * Active security features:
 * 1.Limit the number of file can be uploaded (Not active)
 * 2.Limit the size of the file.
 * 3.Protection against file name injection attack.
 * 4.Move to separate upload directory.
 * 5.Purge the exif data.
 */

use classes\FileUpload;

//Check if the file is uploaded and the submit button is clicked
if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
    //Limit upload file size
    if (filesize($_FILES['file']['tmp_name']) > 400) {
//        header("location:index.php");
        exit("MAX SIZE EXCEEDS!");
    }

    //include the PHP file for FIleUpload class
    include "classes/FileUpload.php";
    //Instantiate the FileUpload class
    $file_uplaod = new FileUpload($_FILES['file'],TRUE);
    //Restrict MIME type
    $alowed_mime = ["image/jpeg","image/png"];
    if (!in_array($file_uplaod->chkMime(),$alowed_mime)){
        header("location:index.html.php");
        exit("NOT A VALID IMAGE FILE!");
    }
    //Move file to specified directory
//    $tar_dir = "C:\\Users\\dprah\\Desktop\\target";
    $tar_dir = "uploaded_files";
    $upload_status=$file_uplaod->moveFile($tar_dir);
    if ($upload_status){
        echo "Uplaod OK";
    } else{
        header("location:index.html.php");
        exit();
    }
} else {
    //Go back to the index page
    header("location:index.html.php");
}