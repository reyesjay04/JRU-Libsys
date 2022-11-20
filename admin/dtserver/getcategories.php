<?php

// DB table to use
$table = 'categories';
// Table's primary key
$primaryKey = 'cat_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(
    array('db' => 'cat_code', 'dt' => 0 ),
    array('db' => 'cat_name', 'dt' => 1 ),
    array('db' => 'created_by', 'dt' => 2 ),
    array('db' => 'created_at', 'dt' => 3 ),
    array(
            'db' => 'status', 
            'dt' => 4,
            'formatter' => function( $d, $row ){
                if ($d == "N") {
                    return ('<span data-toggle="tooltip"  title="" class="badge bg-red" data-original-title="Inactive"><i class="fas fa-minus-circle"></i></span>');
                } else {
                    return ('<span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="Active"><i class="fas fa-check-circle"></i></span>');
                }
            }
        ),
    array(
            'db' => 'cat_id', 
            'dt' => 5,
            'formatter' => function( $d, $row ){ 
                return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="editcat(this.id)"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger" id='.$d.' onclick="deletecat(this.id)"><i class="fas fa-trash"></i></i></button>');
            }
        )
);
// Include SQL query processing class
require('../../res/ssp.class.php');
require('../../res/get-conn.php');
// Output data as json format
echo json_encode(
     SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    //SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=''.$FinalRole.'')
);

?>
