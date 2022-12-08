<?php

// DB table to use
$table = 'users';
// Table's primary key
$primaryKey = 'id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.

$artFilter = "";
if($_GET['filter'] <> 'All') {
    $deptFilter = $_GET['filter'];
    $artFilter = "WHERE artall.dept_code = '$deptFilter'";
}

$columns = array(
    array('db' => 'u.last_name', 'dt' => 0,  'field' => 'last_name' ),
    array('db' => 'u.first_name', 'dt' => 1,  'field' => 'first_name' ),
    array('db' => 'COUNT(aul.user_id) as TotalArticles', 'dt' => 2, 'field' => 'TotalArticles'),
    array('db' => 'COUNT(art.id) as Pending', 'dt' => 3 , 'field' => 'Pending' ),
    array('db' => '(SELECT COUNT(article_id) FROM no_likes WHERE user_id = u.id) as Likes', 'dt' => 4 , 'field' => 'Likes'),
    array('db' => '(SELECT COUNT(article_id) FROM dislikes WHERE user_id = u.id) as Dislikes', 'dt' => 5 , 'field' => 'Dislikes'),
    array('db' => '(SELECT (SUM(rt.rate_val) / SUM(rt.rate_base) * 5) as Rate FROM ratings rt WHERE rt.user_id = u.id) as Ratings', 'dt' => 6 , 'field' => 'Ratings'),
    array(
        'db' => 'u.id', 
        'dt' => 7,
        'field' => 'id' ,
        'formatter' => function( $d, $row ){ 
            return ('<div class="btn-group"><button type="button" class="btn btn-secondary" id='.$d.' onclick="viewcount(this.id)">View</button>');
        }
    )
);

$joinQuery = "FROM users u LEFT JOIN author_list aul ON aul.user_id = u.id 
LEFT JOIN articles art ON art.id = aul.art_id AND art.status = 'N' 
LEFT JOIN articles artall ON artall.id = aul.art_id
$artFilter GROUP BY u.id";
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

