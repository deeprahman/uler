<?php
declare(strict_types=1);
include "html/header.html";
include_once "d_connection/database.php";
if (isset($_SESSION['msg'])) {
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'>".$_SESSION['msg']."</h3><br>";
    echo "<h3 style='color: #80bdff; text-align: center;border: 1px;'> ID:".$_SESSION['id']."</h3><br>";
}
if(isset($message)){
    echo "<div class='alert alert-danger' role='alert' style='width: 400px;margin: auto'><p align='center'>{$message}</p></div>";
}
//Extract from database
$look_up =['id','name_first','name_mid','name_last','address','email','city','zip','designation','gender','entry_epoch'];
$sql_select = <<<HERE
SELECT * FROM employee_info;
HERE;
try {
    $index = 0; //index for array where rows to be stored
    $results = $db->query($sql_select);
} catch (PDOException $exception) {
    exit($exception->getMessage());
}

?>
<!--HTML Begins-->
    <hr/>
    <div class="h2 text-primary pb-2" align="center" >Employee List</div>
    <table class="table">
        <thead>
        <tr>
            <?php foreach ($look_up as $heading):?>
            <th scope="col"><?=$heading?></th>
            <?php endforeach;?>
        </tr>
        </thead>
        <tbody>

            <?php foreach ($results as $row):?>
                <tr>
                <?php foreach ($row as $key => $value):?>
                    <?php if(in_array($key,$look_up,TRUE)):?>
                    <td>
                        <?= $value?>
                    </td>
                    <?php endif;?>
                <?php endforeach;?>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php include "html/footer.html" ?>