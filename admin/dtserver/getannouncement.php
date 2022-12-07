<?php

// DB table to use
$table = 'announcement';
// Table's primary key
$primaryKey = 'id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.


$columns = array(
    array('db' => 'title', 'dt' => 0 ),
    array('db' => 'description', 'dt' => 1 ),
    array('db' => 'filename', 'dt' => 2 ),
    array('db' => 'created_at', 'dt' => 3 ),
    array(
            'db' => 'id', 
            'dt' => 4,
            'formatter' => function( $d, $row ){ 
                return ('<div class="btn-group"><button type="button" class="btn btn-danger" id='.$d.' onclick="deleteannouncement(this.id)"><i class="fas fa-trash"></i></i></button>');
            }
        )
);
// Include SQL query processing class
require('../../res/ssp.class.php');
require('../../res/functions.php');


// Output data as json format
echo json_encode(
     SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    //SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=''.$FinalRole.'')
);
?>

