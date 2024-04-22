<?php
global $wpdb;
saveAddItem();
//saveUpdateItem();

$sql_service = "SELECT DISTINCT(service_type) FROM  ips_wh_items";
$service_items = $wpdb->get_results($sql_service);

//echo "<pre>"; print_r($service_items); die;

if ($wpdb->last_error) {
    echo 'wpdb error: ' . $wpdb->last_error;
}

?>
<!-- Ensure jQuery is loaded before DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Load DataTables plugin from CDN -->
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <header class="entry-header">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Inventory</h2>
                </div>
                <div class="col-sm-6 header-buttons">
                    <button class="btn btn-sm btn-success"><a data-toggle="modal" data-target="#addItemModal">Add Item</a></button>
                    <button class="btn btn-sm btn-danger delete-item-button">Delete Item</button>
                </div>
            </div>
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
                        <li class='nav-item s1'>
                            <a class='nav-link ' data-toggle='tab' href='#s3'>ELECTRIC</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="entry-content">
            <!-- Tab panes -->
            <div class="tab-content">
                <div class='tab-pane container fade in show active' id='s1'>
                    <?php
                    $sql_plumbing = "SELECT * FROM  ips_wh_items where service_type='plumbing'";
                    $plumbing_items = $wpdb->get_results($sql_plumbing);

                    if ($wpdb->last_error) {
                        echo 'wpdb error: ' . $wpdb->last_error;
                    }

                    $dataItems = [];
                    ?>
                    <div class="table-container">
                        <table id="inventory-table" class="table table-sm table-warehouse">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Part Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($plumbing_items)) foreach ($plumbing_items as $item) {
                                    echo '<tr>';
                                    echo '<td><input type="checkbox" class="cb-item" value="' . $item->ID . '" /></td>';
                                    echo '<td>' . $item->category . '</td>';
                                    echo '<td><a data-toggle="modal" data-target="#updateItemModal" data-id="' . $item->ID . '" data-type="' . $item->service_type . '">' . $item->description . '</a></td>';
                                    echo '<td>' . $item->part_number . '</td>';
                                    echo '</tr>';

                                    $dataItems['item' . $item->ID] = [
                                        'ID' => $item->ID,
                                        'cat' => $item->category,
                                        'desc' => $item->description,
                                        'part' => $item->part_number,
                                        'service_type' => $item->service_type
                                    ];
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='tab-pane container fade' id='s2'>
                    <?php
                    $sql_hvac = "SELECT * FROM  ips_wh_items where service_type='hvac'";
                    $hvac_items = $wpdb->get_results($sql_hvac);

                    if ($wpdb->last_error) {
                        echo 'wpdb error: ' . $wpdb->last_error;
                    }

                    $dataItems2 = [];
                    ?>
                    <div class="table-container">
                        <table id="inventory-table2" class="table table-sm table-warehouse">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Part Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($hvac_items)) foreach ($hvac_items as $item) {
                                    echo '<tr>';
                                    echo '<td><input type="checkbox" class="cb-item" value="' . $item->ID . '" /></td>';
                                    echo '<td>' . $item->category . '</td>';
                                    echo '<td><a data-toggle="modal" data-target="#updateItemModal" data-id="' . $item->ID . '" data-type="' . $item->service_type . '">' . $item->description . '</a></td>';
                                    echo '<td>' . $item->part_number . '</td>';
                                    echo '</tr>';

                                    $dataItems2['item' . $item->ID] = [
                                        'ID' => $item->ID,
                                        'cat' => $item->category,
                                        'desc' => $item->description,
                                        'part' => $item->part_number,
                                        'service_type' => $item->service_type
                                    ];
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='tab-pane container fade' id='s3'>
                    <?php
                    $sql_hvac = "SELECT * FROM  ips_wh_items where service_type='electric'";
                    $hvac_items = $wpdb->get_results($sql_hvac);

                    if ($wpdb->last_error) {
                        echo 'wpdb error: ' . $wpdb->last_error;
                    }

                    $dataItems2 = [];
                    ?>
                    <div class="table-container">
                        <table id="inventory-table3" class="table table-sm table-warehouse">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Part Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($hvac_items)) foreach ($hvac_items as $item) {
                                    echo '<tr>';
                                    echo '<td><input type="checkbox" class="cb-item" value="' . $item->ID . '" /></td>';
                                    echo '<td>' . $item->category . '</td>';
                                    echo '<td><a data-toggle="modal" data-target="#updateItemModal" data-id="' . $item->ID . '" data-type="' . $item->service_type . '">' . $item->description . '</a></td>';
                                    echo '<td>' . $item->part_number . '</td>';
                                    echo '</tr>';

                                    $dataItems2['item' . $item->ID] = [
                                        'ID' => $item->ID,
                                        'cat' => $item->category,
                                        'desc' => $item->description,
                                        'part' => $item->part_number,
                                        'service_type' => $item->service_type
                                    ];
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="addItemModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/warehouse/?whtab=inventory">
                    <input type="hidden" name="item-add-nonce" value="<?php echo wp_create_nonce('item-add-nonce'); ?>" />
                    <?php
                    iLocalWarehouse::formfieldText('Category', 'item-add-category', '', '', 'required');
                    iLocalWarehouse::formfieldText('Description', 'item-add-description', '', '', 'required');
                    iLocalWarehouse::formfieldText('Part Number', 'item-add-partnumber', '', '', 'required');
                    iLocalWarehouse::formfieldDropdown('Service Type', 'item-add-servicetype', $service_items, '', 'required');
                    ?>
                    <hr />
                    <button type="submit" class="btn btn-sm btn-success">Save Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Item Modal -->
<div class="modal fade" id="updateItemModal" tabindex="-1" role="dialog" aria-labelledby="updateItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="updateItemModalLabel">Update Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="item-update-nonce" value="<?php echo wp_create_nonce('item-update-nonce'); ?>" />
                    <?php
                    iLocalWarehouse::formfieldText('Item ID', 'item-update-ID', '0', '', 'readonly', 'hidden');
                    iLocalWarehouse::formfieldText('Category', 'item-update-category', '', '', 'required');
                    iLocalWarehouse::formfieldText('Description', 'item-update-description', '', '', 'required');
                    iLocalWarehouse::formfieldText('Part Number', 'item-update-partnumber', '', '', 'required');
                    iLocalWarehouse::formfieldDropdown('Service Type', 'item-update-servicetype', $service_items, '', 'required');
                    ?>
                    <hr />
                    <!-- <button type="submit" class="btn btn-sm btn-success">Save Item</button> -->
                    <input type="button" id="update-data" class="btn btn-sm btn-success" value="Save Item" />
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#inventory-table').dataTable({
            pageLength: 25,
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc'],
                [3, 'asc']
            ],
            initComplete: function() {
                //$('<div id="item-column-filter"></div>').appendTo('.dataTables_filter');
                $('#inventory-table_filter').append('<div id="item-column-filter" class="filter"></div>');

                this.api().columns([1]).every(function() {
                    var column = this;
                    var select = $('<select><option value="">Filter Category</option></select>')
                        .appendTo($('.filter'))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        $('#inventory-table2').dataTable({
            pageLength: 25,
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc'],
                [3, 'asc']
            ],
            initComplete: function() {
                //$('<div id="item-column-filter2"></div>').appendTo('.dataTables_filter');
                $('#inventory-table2_filter').append('<div id="item-column-filter" class="filter2"></div>');
                this.api().columns([1]).every(function() {
                    var column = this;
                    var select = $('<select><option value="">Filter Category</option></select>')
                        .appendTo($('.filter2'))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        $('#inventory-table3').dataTable({
            pageLength: 25,
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc'],
                [3, 'asc']
            ],
            initComplete: function() {
                //$('<div id="item-column-filter2"></div>').appendTo('.dataTables_filter');
                $('#inventory-table3_filter').append('<div id="item-column-filter" class="filter3"></div>');
                this.api().columns([1]).every(function() {
                    var column = this;
                    var select = $('<select><option value="">Filter Category</option></select>')
                        .appendTo($('.filter3'))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        var items_json_plumbing = <?php echo json_encode($dataItems); ?>;
        var items_json_hvac = <?php echo json_encode($dataItems2); ?>;

        jQuery('#updateItemModal').on('show.bs.modal', function(e) {
            console.log(e.relatedTarget);
            var btn = jQuery(e.relatedTarget),
                item_id = btn.data('id'),
                item_type = btn.data('type');
            alert(item_type);
            alert(item_id);
            jQuery('input[name=item-update-ID]').val(item_id);
            if (item_type == 'plumbing') {
                jQuery('#item-update-category').val(items_json_plumbing['item' + item_id]['cat']);
                jQuery('#item-update-description').val(items_json_plumbing['item' + item_id]['desc']);
                jQuery('#item-update-partnumber').val(items_json_plumbing['item' + item_id]['part']);
                jQuery('#item-update-servicetype').val(items_json_plumbing['item' + item_id]['service_type']);
            } else {
                jQuery('#item-update-category').val(items_json_hvac['item' + item_id]['cat']);
                jQuery('#item-update-description').val(items_json_hvac['item' + item_id]['desc']);
                jQuery('#item-update-partnumber').val(items_json_hvac['item' + item_id]['part']);
                jQuery('#item-update-servicetype').val(items_json_hvac['item' + item_id]['service_type']);
            }
        });

        $('.delete-item-button').on('click', function() {
            var selected = [];
            $.each($('.cb-item:checked'), function() {
                selected.push($(this).val());
            });
            if (selected.length == 0) {
                alert('Please select the row first.');
                return;
            }
            if (confirm('Are you sure you want to delete selected items?')) {
                $.post('/wp-admin/admin-ajax.php', {
                    action: 'inventory_delete',
                    nonce: '<?php echo wp_create_nonce('inventory_delete'); ?>',
                    rows: selected
                }, function(response) {
                    if (response.status !== 'ok') {
                        alert(response.message);
                        return;
                    }
                    location.reload();
                    return;
                }, 'json');
            }
        });
    });



    // $('#updateItemModal form').submit(function(event) {
    /**AJAX call Start */
    jQuery('#update-data').on('click', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Serialize form data
        // var formData = jQuery(this).serialize();
        var formData = jQuery('#updateItemModal form').serialize();
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        // Check if the user's IP matches the desired IP address
        var userIP = '<?php echo $_SERVER['REMOTE_ADDR']; ?>';
        alert(userIP);
        var desiredIP = '3.6.104.62';
        alert(desiredIP);
        // Submit form data via AJAX to WordPress AJAX handler
        // if (userIP === desiredIP) {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl, // WordPress AJAX URL
            data: {
                action: 'save_update_item', // Action to call PHP function
                formData: formData // Form data to send
            },
            dataType: 'json',
            success: function(response) {
                // Check if the response indicates success
                if (response.success) {

                    // Item saved successfully
                    alert('Item saved successfully.');
                    // Hide the modal
                    //jQuery('#updateItemModal').modal('hide');
                    // Refresh the DataTable
                    jQuery('#inventory-table2').DataTable().ajax.reload();
                } else {
                    // Error occurred while saving the item
                    // alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                // Handle error response here
                console.error(error);
                // alert('An error occurred while saving the item.');
            }
        });
    // } else {
    //     // User's IP does not match the desired IP address
    //     // You can optionally display a message or take other actions here
    // }
    });
    /**AJAX call End */
</script>

<?php

function saveAddItem()
{

    if (isset($_POST['item-add-nonce']) && wp_verify_nonce($_POST['item-add-nonce'], 'item-add-nonce')) {
        $_POST = wp_unslash($_POST);
        global $wpdb;

        $wpdb->insert(
            'ips_wh_items',
            ['category' => $_POST['item-add-category'], 'description' => $_POST['item-add-description'], 'part_number' => $_POST['item-add-partnumber'], 'service_type' => $_POST['item-add-servicetype']]
        );

        wp_redirect('/warehouse/?whtab=inventory');
        exit;
    }
}

// function saveUpdateItem() {
//     if (isset($_POST['item-update-nonce']) && wp_verify_nonce($_POST['item-update-nonce'], 'item-update-nonce')) {
//         $_POST = wp_unslash($_POST);
//         global $wpdb;

//         $wpdb->update(
//             'ips_wh_items',
//             ['category' => $_POST['item-update-category'], 'description' => $_POST['item-update-description'], 'part_number' => $_POST['item-update-partnumber'], 'service_type' => $_POST['item-update-servicetype'] ],
//             ['ID' => intval($_POST['item-update-ID'])]
//         );

//         wp_redirect('/warehouse/?whtab=inventory');
//         exit;
//     }
// }
