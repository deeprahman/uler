<?php
/**
 * Created by PhpStorm.
 * User: dprah
 * Date: 5/30/2018
 * Time: 1:08 AM
 */
declare(strict_types=1);

$sql_select = <<<HERE
SELECT * FROM employee_info;
HERE;
try {
    $results = $db->query($sql_select);

} catch (PDOException $exception) {
    exit($exception->getMessage());
}

foreach ($results as $row) { //Stores each record in a row
    $tablerow_begins = <<<HERE
<tr>
HERE;
    foreach ($row as $key => $value) { //Go through the each element of the reow
        ${$key} = $value; //Using variable-variable
        $tabledata = <<<HERE
<td>{${$key}}</td>
HERE;

    }
    $tablerow_ends = <<<HERE
</tr>
HERE;

}