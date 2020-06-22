<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'datatables_demo';
$table_view = '(SELECT datatables_demo.*, id AS cms_datatable_select, id AS cms_datatable_action FROM datatables_demo) AS datatables_demo';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
//$columns = array(
//    array(
//        'db' => 'id',
//        'dt' => 'DT_RowId',
//        'formatter' => function( $d, $row ) {
//            // Technically a DOM id cannot start with an integer, so we prefix
//            // a string. This can also be useful if you have multiple tables
//            // to ensure that the id is unique with a different prefix
//            return 'row_'.$d;
//        }
//    ),
//    array( 'db' => 'first_name', 'dt' => 1 ),
//    array( 'db' => 'last_name',  'dt' => 2 ),
//    array( 'db' => 'position',   'dt' => 3 ),
//    array( 'db' => 'office',     'dt' => 4 ),
//    array(
//        'db'        => 'start_date',
//        'dt'        => 5,
//        'formatter' => function( $d, $row ) {
//            return date( 'jS M y', strtotime($d));
//        }
//    ),
//    array(
//        'db'        => 'salary',
//        'dt'        => 6,
//        'formatter' => function( $d, $row ) {
//            return '$'.number_format($d);
//        }
//    ),
//    array(
//        'db'        => 'cms_grid_action',
//        'dt'        => 7,
//        'formatter' => function($d, $row) {
//            return "<a href=\"javascript:alert({$d})\">Edit</a>";
//        }
//    )
//);
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
    ),
    array( 'db' => 'seq', 'dt' => 'seq' ),
    array(
        'db'        => 'cms_datatable_select',
        'dt'        => 'cms_datatable_select',
        'formatter' => function($d, $row) {
            return <<<EOL
                <input type="checkbox" value="{$d}" onclick="cmsDataTableSelect(this)">
EOL;
        }
    ),
    array( 'db' => 'first_name', 'dt' => 'first_name' ),
    array( 'db' => 'last_name',  'dt' => 'last_name' ),
    array( 'db' => 'position',   'dt' => 'position' ),
    array( 'db' => 'office',     'dt' => 'office' ),
    array(
        'db'        => 'start_date',
        'dt'        => 'start_date',
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),
    array(
        'db'        => 'salary',
        'dt'        => 'salary',
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    ),
    array(
        'db'        => 'cms_datatable_action',
        'dt'        => 'cms_datatable_action',
        'formatter' => function($d, $row) {
            return <<<EOL
                <a href="javascript:alert({$d})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
EOL;

        }
    )
);


// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '1029384756',
    'db'   => 'dev_datatables',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, "", $table_view)
);


