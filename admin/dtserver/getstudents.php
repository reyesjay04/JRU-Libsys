<?php

// DB table to use
$table = 'users';
// Table's primary key
$primaryKey = 'id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.

// array( 'db' => '`a`.`user_fname`',     'dt' => 0,  'field' => 'user_fname' ),
// array( 'db' => '`a`.`user_lname`',     'dt' => 1,  'field' => 'user_lname' ),
// array( 'db' => 'COUNT(`b`.`store_id`) as store_id',     'dt' => 2,  'field' => 'store_id' ),

$columns = array(
    array(
        'db' => '`a`.`picture`', 
        'dt' => 0,
        'field' => 'picture',
        'formatter' => function($d, $row){
            return ('<img src="'.$d.'" width="30px" height="30px">');
        }
    ),
    array('db' => '`a`.`reference_id`', 'dt' => 1, 'field' => 'reference_id'),
    array('db' => '`a`.`first_name`', 'dt' => 2, 'field' => 'first_name'),   
    array('db' => '`a`.`last_name`', 'dt' => 3 , 'field' => 'last_name' ),
    array('db' => '`a`.`email`', 'dt' => 4 , 'field' => 'email'),
    array('db' => '`a`.`contact_number`', 'dt' => 5 , 'field' => 'contact_number'),
    array('db' => '`a`.`gender`', 'dt' => 6 , 'field' => 'gender'),
    array('db' => '`a`.`department_code`', 'dt' => 7 , 'field' => 'department_code'),
    array('db' => '`b`.`course`', 'dt' => 8 , 'field' => 'course'),
    array(
        'db' => '`a`.`id`', 
        'dt' => 9,
        'field' => 'id',
        'formatter' => function( $d, $row ){ 
            return ('<div class="btn-group"><button type="button" class="btn btn-danger" id='.$d.' onclick="deletestud(this.id)"><i class="fas fa-trash"></i></i></button>');
        }
    )

);

$joinQuery = "FROM users a
INNER JOIN course b ON a.course_code = b.code
WHERE a.user_role = 'Student'";
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

