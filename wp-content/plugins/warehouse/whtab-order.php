<?php
global $wpdb;

$user = wp_get_current_user();
?>

<section id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <header class="entry-header">

            <div class="row">

                <div class="col-sm-6">

                    <h4 class="mt-3">New Order</h4>

                </div>

            </div>

        </header>

        <div class="entry-content">

            <form method="post" id="form_ajax">

                <input type="hidden" name="new-order-nonce" value="<?php echo wp_create_nonce('new-order-nonce'); ?>" />

                <?php iLocalWarehouse::formfieldTextArea_2('Notes', 'order-note', '', '', 'rows=5 placeholder="Order Notes"'); ?>

                <div class="mb-3"><a class="btn btn-sm btn-success" data-toggle="modal" data-target="#addItemModal">Add Item</a></div>

                <div id="item-picked-container"></div>

                <hr />

                <button type="submit" class="btn btn-success order-btn">Submit Order</button>

            </form>

        </div>

    </main>

</section>



<!-- Items Modal -->

<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title mt-0" id="addItemModalLabel">Select Item</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row tab-nav-div">

                    <div class="col-sm-12">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-fill">
                          <li class='nav-item s1'>
                            <a class='nav-link active' data-toggle='tab' href='#s1'>Plumbing</a>
                          </li>
                          <li class='nav-item s2'>
                            <a class='nav-link ' data-toggle='tab' href='#s2'>HVAC</a>
                          </li>
                        </ul>

                    </div>

                </div>


                <!-- Tab panes -->
                <div class="tab-content">

                <div class='tab-pane container fade in show active' id='s1'>

                    <?php

                    $sql_plumbing = "SELECT * FROM  ips_wh_items where service_type='plumbing'";

                    $plumbing_items = $wpdb->get_results($sql_plumbing);

                    if ( $wpdb->last_error ) {
                      echo 'wpdb error: ' . $wpdb->last_error;
                    }


                    $dataItems = [];

                    ?>

                    <table id="table-pricebook-items" class="table table-sm table-warehouse">

                        <thead><tr><th>Category1</th><th>Description</th><th class="priority-5">Service Type</th></tr></thead>

                        <tbody><?php

                        if (!empty($plumbing_items)) {

                            foreach ($plumbing_items as $item) {

                                echo '<tr class="itemrow">';

                                echo '<td>' . $item->category . '</td>';

                                echo '<td><a class="itemlist-picked" data-item="' . $item->ID . '">' . $item->description . '<br />';

                                echo 'Part#: ' . $item->part_number . '</a></td>';

                                echo '<td class="priority-5">' . strtoupper($item->service_type) . '</td>';

                                echo '</tr>';



                                $dataItems['item' . $item->ID] = [

                                    'ID' => $item->ID,

                                    'cat' => $item->category,

                                    'desc' => $item->description,

                                    'part' => $item->part_number,

                                    'service_type' => $item->service_type

                                ];

                            }

                        }

                        ?>

                        </tbody>

                    </table>


                </div>

                <div class='tab-pane container fade' id='s2'>

                    <?php

                    $sql_hvac = "SELECT * FROM  ips_wh_items where service_type='hvac'";

                    $hvac_items = $wpdb->get_results($sql_hvac);

                    if ( $wpdb->last_error ) {
                      echo 'wpdb error: ' . $wpdb->last_error;
                    }


                    $dataItems2 = [];

                    ?>


                    <table id="table-pricebook-items2" class="table table-sm table-warehouse">

                        <thead><tr><th>Category2</th><th>Description</th><th class="priority-5">Service Type</th></tr></thead>

                        <tbody><?php

                        if (!empty($hvac_items)) {

                            foreach ($hvac_items as $item) {

                                echo '<tr class="itemrow">';

                                echo '<td>' . $item->category . '</td>';

                                echo '<td><a class="itemlist-picked" data-item="' . $item->ID . '">' . $item->description . '<br />';

                                echo 'Part#: ' . $item->part_number . '</a></td>';

                                echo '<td class="priority-5">' . strtoupper($item->service_type) . '</td>';

                                echo '</tr>';



                                $dataItems2['item' . $item->ID] = [

                                    'ID' => $item->ID,

                                    'cat' => $item->category,

                                    'desc' => $item->description,

                                    'part' => $item->part_number,

                                    'service_type' => $item->service_type

                                ];

                            }

                        }

                        ?>

                        </tbody>

                    </table>

                </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    jQuery(document).ready(function ($) {

        $('#table-pricebook-items').dataTable({

            pageLength: 10,

            columnDefs: [ { orderable: false, targets: 0 } ],

            order: [[0, 'asc'], [1, 'asc']],

            language: {

                'paginate': {

                    'previous': '<i class="fas fa-angle-left"></i>',

                    'next': '<i class="fas fa-angle-right"></i>'

                },

                search: "_INPUT_",

                searchPlaceholder: "Search..."

            },

            initComplete: function () {

                //$('<div id="item-column-filter"></div>').appendTo('.dataTables_filter');
                $('#table-pricebook-items_filter').append('<div id="item-column-filter" class="filter"></div>');

                this.api().columns([0]).every( function () {

                    var column = this;

                    var select = $('<select><option value="">Filter Category</option></select>')

                        .appendTo( $('.filter') )

                        .on( 'change', function () {

                            var val = $.fn.dataTable.util.escapeRegex( $(this).val() );

                            column.search( val ? '^'+val+'$' : '', true, false ).draw();

                        } );



                    column.data().unique().sort().each( function ( d, j ) {

                        select.append( '<option value="'+d+'">'+d+'</option>' )

                    } );

                } );



            }

        });


        $('#table-pricebook-items2').dataTable({


            pageLength: 10,

            columnDefs: [ { orderable: false, targets: 0 } ],

            order: [[0, 'asc'], [1, 'asc']],

            language: {

                'paginate': {

                    'previous': '<i class="fas fa-angle-left"></i>',

                    'next': '<i class="fas fa-angle-right"></i>'

                },

                search: "_INPUT_",

                searchPlaceholder: "Search..."

            },

            initComplete: function () {

                //$('<div id="item-column-filter"></div>').appendTo('.dataTables_filter');
                $('#table-pricebook-items2_filter').append('<div id="item-column-filter" class="filter2"></div>');

                this.api().columns([0]).every( function () {

                    var column = this;

                    var select = $('<select><option value="">Filter Category</option></select>')

                        .appendTo( $('.filter2') )

                        .on( 'change', function () {

                            var val = $.fn.dataTable.util.escapeRegex( $(this).val() );

                            column.search( val ? '^'+val+'$' : '', true, false ).draw();

                        } );



                    column.data().unique().sort().each( function ( d, j ) {

                        select.append( '<option value="'+d+'">'+d+'</option>' )

                    } );

                } );



            }

        });
/////////////////////////////////////////////////////////////

        $.fn.DataTable.ext.pager.numbers_length = 3;



        var items_json_plumbing = <?php echo json_encode($dataItems); ?>;

        var items_json_hvac = <?php echo json_encode($dataItems2); ?>;



        $('#table-pricebook-items').on('click', 'a.itemlist-picked', function (){

            var item_ID = $(this).data('item');

            var qty = 1;

            if ($('.picked' + item_ID).length > 0) {

                qty = parseInt( $('.qtypicked' + item_ID).val() ) + 1;

                $('.qtypicked' + item_ID).val(qty);

                return;

            }



            $('<div class="picked-row picked' + item_ID + '">'

                + '<p>' + items_json_plumbing['item' + item_ID]['cat'] + '</p>'

                + '<p>' + items_json_plumbing['item' + item_ID]['desc'] + '</p>'

                + '<p>Part#:' + items_json_plumbing['item' + item_ID]['part'] + '</p>'

                + '<p>Service Type:' + items_json_plumbing['item' + item_ID]['service_type'].toUpperCase() + '</p>'

                + '<div class="bottoms">'

                + '<div class="bottom-qty">Qty: <input class="qtypicked' + item_ID + '" type="number" start="1" step="1" value="1" name="picked[' + item_ID + '][qty]" /><input type="hidden" value="' + item_ID + '" name="picked[' + item_ID + '][ID]" /></div>'

                + '<div class="bottom-delete"><a class="btn btn-sm btn-danger btn-delete-picked-row">Delete</a></div>'

                + '</div>').appendTo( $('#item-picked-container') );



            $(this).parents('.itemrow').addClass('selected');

        });



        $('#table-pricebook-items2').on('click', 'a.itemlist-picked', function (){

            var item_ID = $(this).data('item');

            var qty = 1;

            if ($('.picked' + item_ID).length > 0) {

                qty = parseInt( $('.qtypicked' + item_ID).val() ) + 1;

                $('.qtypicked' + item_ID).val(qty);

                return;

            }



            $('<div class="picked-row picked' + item_ID + '">'

                + '<p>' + items_json_hvac['item' + item_ID]['cat'] + '</p>'

                + '<p>' + items_json_hvac['item' + item_ID]['desc'] + '</p>'

                + '<p>Part#:' + items_json_hvac['item' + item_ID]['part'] + '</p>'

                + '<p>Service Type:' + items_json_hvac['item' + item_ID]['service_type'].toUpperCase() + '</p>'

                + '<div class="bottoms">'

                + '<div class="bottom-qty">Qty: <input class="qtypicked' + item_ID + '" type="number" start="1" step="1" value="1" name="picked[' + item_ID + '][qty]" /><input type="hidden" value="' + item_ID + '" name="picked[' + item_ID + '][ID]" /></div>'

                + '<div class="bottom-delete"><a class="btn btn-sm btn-danger btn-delete-picked-row">Delete</a></div>'

                + '</div>').appendTo( $('#item-picked-container') );



            $(this).parents('.itemrow').addClass('selected');

        });


////////////////////////////////////////////////////////////////////////////



        $('#item-picked-container').on('click', 'a.btn-delete-picked-row', function (){

            $(this).parents('.picked-row').remove();

        });

        $('#form_ajax').on('submit', function(e){

            e.preventDefault();
            $(".order-btn").attr( "disabled", "disabled" );
            var that = $(this);
            var new_sev = $("input[name=new-order-nonce]").val();
            var order_note = $("#order-note").val();
            var picked = {};

            if($('#item-picked-container .picked-row').length) {
                $('#item-picked-container .picked-row').each(function(i, obj) {
                    var item_picked = {};
                    var qty = $(this).find('input:nth-child(1)').val();
                    var pick_elem = $(this).find('input:nth-child(2)').val();
                    item_picked['qty'] = qty;
                    item_picked['ID'] = pick_elem;
                    picked[pick_elem] = item_picked;                    

                });
            }

            $.post('/wp-admin/admin-ajax.php', {

                action: 'save_NewOrder',
                type:"POST",
                dataType:'json',
                new_sev: new_sev, 
                order_note: order_note,
                picked: picked 

            }, function (response) {

                if(response.status == "success") {
                    window.scrollTo({top: 0, behavior: 'smooth'});
                    $('#form_ajax').before('<div class="alert alert-success" role="alert">'+response.message+'</div>');
                    window.location.href = '/warehouse/';

                } else {

                    $('#form_ajax').before('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
                    $(".order-btn").removeAttr("disabled");
                    window.scrollTo({top: 0, behavior: 'smooth'});
                    setTimeout(function(){
                      $(".alert").remove();
                    }, 5000);
                }

            }, 'json' );

        });

    });
</script>