<?php



if (!current_user_can('administrator') && !current_user_can('wh-admin')) {

    echo iLocalWarehouse::message_error("You don't have access on this page.");

    return;

}



global $wpdb;



$order_id = intval($_GET['orderid']);

$sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";

$order = $wpdb->get_row($sql);



if (empty($order)) {

    echo iLocalWarehouse::message_error('Invalid Order');

    return;

}



saveAdminOrder($order_id, $order);



$sql = "SELECT * FROM ips_wh_order_items WHERE order_id = $order_id";

$items = $wpdb->get_results($sql);



?>

<section id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <header class="entry-header">

            <div class="row">

                <div class="col-sm-6">

                    <h2>Processing Order</h2>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="/warehouse/?whtab=adminprint&orderid=<?php echo $order_id; ?>" class="btn-admin-print btn btn-sm btn-info" style="display: inline-block; margin-top: 15px;" target="_blank">Print Warehouse Request</a>

                </div>

            </div>

        </header>

        <div class="entry-content">

            <?php if (isset($_GET['message']) && $_GET['message'] == 'success') echo iLocalWarehouse::message_success('Order updated.'); ?>

            <div class="form-container">

                <form id="admin-order-process" method="post" action="/warehouse/?whtab=adminorder&orderid=<?php echo $order_id; ?>">

                    <input type="hidden" name="admin-order-nonce" value="<?php echo wp_create_nonce('admin-order-nonce'); ?>" />

                    <?php

                    $user = get_user_by('ID', $order->tech);

                    iLocalWarehouse::formfieldText_2('Tech', 'order-tech', $user->user_login, '', 'readonly');

                    iLocalWarehouse::formfieldTextArea_2('Tech Notes', 'order-note', $order->notes_tech, '', 'rows=5 placeholder="Order Notes" readonly');

                    iLocalWarehouse::formfieldTextArea_2('Admin Notes', 'order-admin-note', $order->notes_admin, '', 'rows=5 placeholder="Order Notes" readonly');

                    ?>

                    <div class="row">

                        <div class="col-md-2"></div>

                        <div class="col-md-10">

                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#addAdminNotesModal" data-id="<?php echo $order_id; ?>"><i class="fas fa-plus-circle"></i> Add Admin Notes</a>

                        </div>

                    </div>

                    <div class="table-container mt-3">

                        <table class="table table-sm table-bordered table-warehouse">

                            <thead><tr>

                                <th>Category</th>

                                <th>Description</th>

                                <th>Part Number</th>

                                <th>Qty Requested</th>

                                <th>Qty Pulled</th>

                                <th class="text-center">Close</th>

                            </tr></thead>

                            <tbody id="new-order-table-body">

                            <?php

                            if (!empty($items)) {

                                foreach ($items as $item) {

                                    $close_checked = $item->status == 'closed' ? ' checked ' : '';

                                    echo '<tr>';

                                    echo '<td>' . $item->category . '</td>';

                                    echo '<td>' . $item->description . '</td>';

                                    echo '<td>' . $item->part_number . '</td>';

                                    echo '<td>' . $item->qty . '</td>';

                                    echo '<td><input type="number" data-id="' . $item->ID . '" data-qty="' . $item->qty . '" class="qty-fufilled" name="items[' . $item->ID . '][fulfilled]" min="0" step="1" value="' . intval($item->qty_ok) . '"></td>';

                                    echo '<td class="text-center">' .

                                        '<input type="checkbox" ' .

                                        'id="cb-closed-' . $item->ID . '" ' .

                                        'class="cb-item-closed" ' .

                                        'name="items[' . $item->ID . '][close]" ' .

                                        ' ' . $close_checked . ' ' .

                                        'value="1" />' .

                                        '</td>';

                                    echo '</tr>';

                                }

                            } else {

                                echo '<tr><td colspan="5"> - No Item - </td></tr>';

                            }

                            ?>

                            </tbody>

                        </table>

                    </div>



                    <div>

                        <hr />

                        <button type="submit" class="btn btn-success">Save Order</button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</section>



<!-- Add Admin Note Modal -->

<div class="modal fade" id="addAdminNotesModal" tabindex="-1" role="dialog" aria-labelledby="addAdminNotesModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title mt-0" id="addAdminNotesModalLabel">Add Admin Notes</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <textarea id="addAdminNoteText" class="form-control" rows="5"></textarea>

                <button id="addAdminNoteButton" type="submit" class="btn btn-sm btn-success mt-4">Save Note</button>

            </div>

        </div>

    </div>

</div>



<div class="shake shake-notification" style="display:none;">

    <a class="save-change-notification"><i class="far fa-save"></i> Save Your Work!<br />Click Here!</a>

</div>



<script>

    jQuery(document).ready(function ($) {

        $('#addAdminNotesModal').on('show.bs.modal', function (e) {

            $('#addAdminNoteText').val('');

        });



        $('#addAdminNoteButton').on('click', function (){

            $.post('/wp-admin/admin-ajax.php', {

                action: 'admin_notes_add',

                nonce: '<?php echo wp_create_nonce('admin_notes_add'); ?>',

                order_id: <?php echo $order_id; ?>,

                note: $('#addAdminNoteText').val()

            }, function (response) {

                if (response.status !== 'ok') { alert(response.message); return; }

                $('#order-admin-note').val(response.content);

                $('#addAdminNotesModal').modal('hide');

            }, 'json' );

        });



        $('.qty-fufilled').on('change', function (){

            var required = parseInt( $(this).data('qty') ),

                current = parseInt( $(this).val() ),

                item_id = $(this).data('id');



            if (required == current) document.getElementById('cb-closed-' + item_id).checked = true;

            else document.getElementById('cb-closed-' + item_id).checked = false;



            console.log(required + ' :: ' + current);

        });



        $('.fieldchanged, form input[type=text], form input[type=number], form input[type=checkbox], form input[type=radio], form select, form textarea').on('change', function () {

            $('.shake-notification').show();

            $('.btn-admin-print').hide();

        });



        $('.save-change-notification').on('click', function () {

            $('#admin-order-process').submit();

        });

    })

</script>



<?php

function saveAdminOrder($order_id, $order) {

    if (isset($_POST['admin-order-nonce']) && wp_verify_nonce($_POST['admin-order-nonce'], 'admin-order-nonce')) {

        $_POST = wp_unslash($_POST);

        global $wpdb;



        $number_items = $number_closed = 0;

        foreach ($_POST['items'] as $item_id => $item) {

            $number_items++;



            if ($item['close']) {

                $number_closed++;

                $status = 'closed';

            } else {

                $status = 'open';

            }



            $data = [

                'qty_ok' => intval( $item['fulfilled'] ),

                'status' => $status

            ];

            $wpdb->update('ips_wh_order_items', $data, ['ID' => $item_id]);

        }



        if ($number_items > 0) {

            if ($number_items == $number_closed) {

                if ($order->status == 'open') {

                    $wpdb->update(

                        'ips_wh_orders',

                        ['status' => 'closed', 'date_close' => current_time('Y-m-d H:i:s')],

                        ['ID' => $order_id]

                    );

                }



                iLocalWarehouse::email_tech_closed_order($order_id);



            } else {

                if ($order->status == 'close') {

                    $wpdb->update(

                        'ips_wh_orders',

                        ['status' => 'open', 'date_close' => NULL],

                        ['ID' => $order_id]

                    );

                }

            }

        }



        //wp_redirect('/warehouse/?whtab=adminorder&orderid=' . $order_id . '&message=success');

        wp_redirect('/warehouse/');

        exit();



    }

}