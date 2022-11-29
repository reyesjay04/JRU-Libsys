<?php

// DB table to use
$table = 'articles';
// Table's primary key
$primaryKey = 'id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.


$columns = array(
    array('db' => 'art.title', 'dt' => 0,  'field' => 'title' ),
    array('db' => 'dept.name', 'dt' => 1,  'field' => 'name' ),
    array('db' => 'cr.course', 'dt' => 2, 'field' => 'course'),
    array('db' => 'art.content', 'dt' => 3 , 'field' => 'content' ),
    array(
        'db' => 'art.availability', 
        'dt' => 4,
        'field' => 'availability',
        'formatter' => function( $d, $row ){ 
            switch ($d) { 
                case "PUB";
                    return "PUBLIC";
                break;
                case "PR";
                    return "PRIVATE";
                break;
                case "BOTH";
                    return "PUBLIC and PRIVATE";
                break;
            }
        }
    ),
    array('db' => 'u.first_name', 'dt' => 5 , 'field' => 'first_name'),
    array('db' => 'u.last_name', 'dt' => 6 , 'field' => 'last_name'),
    array(
        'db' => 'art.id', 
        'dt' => 7,
        'field' => 'id',
        'formatter' => function( $d, $row ){ 
            return ('
            <div class="btn-group">
                <button type="button" class="btn btn-danger" id='.$d.'  onclick="disapprovepost(this.id)"><i class="fas fa-ban"></i></i></button>
            </div>');
        }
    )
);

$joinQuery = "FROM articles art 
LEFT JOIN users u ON u.id = art.main_author_id
LEFT JOIN department dept ON dept.code = art.dept_code
LEFT JOIN course cr  ON cr.code = art.cat_code
WHERE art.status = 'Y' ";
$extraWhere = "";

// Include SQL query processing class
require('../../res/ssp.customized.class.php' );
require('../../res/functions.php');


$groupBy = "";
$having = "";

// Output data as json format
echo json_encode(
     //SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    // SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll='user_role = "Students"'.$FinalRole.'')
     SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);

?>

