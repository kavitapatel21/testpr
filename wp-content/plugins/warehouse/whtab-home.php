<?php

global $wpdb;



?>

<section id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <div class="entry-content">



            <?php if (current_user_can('administrator') || current_user_can('wh-admin')) { ?>



                <div class="row">

                    <div class="col-xs-6"><h4 class="mt-3">Open Order</h4></div>

                    <div class="col-xs-6 text-right" style="padding-top: 15px"></div>

                </div>

                <div class="table-container mt-2">

                    <table id="openorder-table" class="table table-sm table-warehouse">

                        <thead><tr>

                            <th>Order ID</th>

                            <th>Order Date</th>

                            <th>Tech</th>

                            <th>Tech Notes</th>

                            <th>Admin Notes</th>

                            <th></th>

                        </tr></thead>

                        <tbody>

                        <?php

                        $sql = "SELECT * FROM ips_wh_orders WHERE status = 'open' ORDER BY date_open ASC";

                        $orders = $wpdb->get_results($sql);

                        if (!empty($orders)) {

                            foreach ($orders as $order) {

                                $user = get_user_by('ID', $order->tech);

                                if ($user) $user_login = $user->data->user_login;

                                else $user_login = $order->tech;

                                $admin_notes = str_replace('\\', '', $order->notes_admin);

                                echo '<tr>';

                                echo '<td>' . $order->ID . '</td>';

                                echo '<td data-order="' . $order->ID . '" data-toggle="modal" data-target="#orderModal" class="linked"><a>' . date('m/d/Y h:ia', strtotime($order->date_open)) . '</a></td>';

                                echo '<td data-order="' . $order->ID . '" data-toggle="modal" data-target="#orderModal" class="linked"><a>' . $user_login . '</a></td>';

                                echo '<td>' . nl2br($order->notes_tech) . '</td>';

                                echo '<td>' . nl2br($admin_notes) . '</td>';

                                echo '<td class="text-right">';

                                //echo '<a data-order="' . $order->ID . '" class="btn btn-sm btn-danger btn-test-email-admin">Test Email Admin</a> ';

                                //echo '<a data-order="' . $order->ID . '" class="btn btn-sm btn-danger btn-test-email-tech">Test Email Tech</a> ';

                                echo '<a href="/warehouse/?whtab=adminorder&orderid=' . $order->ID . '" class="btn btn-sm btn-success">Admin</a> ';

                                echo '<a href="/warehouse/?whtab=adminprint&orderid=' . $order->ID . '" class="btn btn-sm btn-info" target="_blank">Print</a> ';

                                echo '<a data-order="' . $order->ID . '" class="btn btn-sm btn-danger btn-row-delete" target="_blank">Delete</a>';

                                echo '</td>';

                                echo '</tr>';





                            }

                        }

                        ?>

                        </tbody>

                    </table>

                </div>



                <div class="row">

                    <div class="col-xs-6"><h4 class="mt-3">Closed Order <span style="font-size: 0.5em; font-weight: normal;">Last 30days</span></h4></div>

                    <div class="col-xs-6 text-right" style="padding-top: 15px"></div>

                </div>

                <div class="table-container mt-2">

                    <table id="closeorder-table" class="table table-sm table-warehouse">

                        <thead><tr>

                            <th>Order ID</th>

                            <th>Order Date</th>

                            <th>Tech</th>

                            <th>Tech Notes</th>

                            <th>Admin Notes</th>

                            <th></th>

                        </tr></thead>

                        <tbody>

                        <?php

                        $date30 = date('Y-m-d 00:00:00', strtotime('-30 days'));

                        $sql = "SELECT * FROM ips_wh_orders " .

                            "WHERE status = 'closed' " .

                            "AND date_close > '$date30' " .

                            "ORDER BY date_open ASC";

                        $orders = $wpdb->get_results($sql);

                        if (!empty($orders)) {

                            foreach ($orders as $order) {

                                $user = get_user_by('ID', $order->tech);

                                if ($user) $user_login = $user->data->user_login;

                                else $user_login = $order->tech;

                                $admin_notes = str_replace('\\', '', $order->notes_admin);



                                echo '<tr>';

                                echo '<td>' . $order->ID . '</td>';

                                echo '<td data-order="' . $order->ID . '" data-toggle="modal" data-target="#orderModal" class="linked"><a>' . date('m/d/Y h:ia', strtotime($order->date_open)) . '</a></td>';

                                echo '<td data-order="' . $order->ID . '" data-toggle="modal" data-target="#orderModal" class="linked"><a>' . $user_login . '</a></td>';

                                echo '<td>' . nl2br($order->notes_tech) . '</td>';

                                echo '<td>' . nl2br($admin_notes) . '</td>';



                                echo '<td class="text-right">';

                                echo '<a href="/warehouse/?whtab=adminorder&orderid=' . $order->ID . '" class="btn btn-sm btn-success">Admin</a> ';

                                echo '<a href="/warehouse/?whtab=adminprint&orderid=' . $order->ID . '" class="btn btn-sm btn-info" target="_blank">Print</a> ';

                                echo '<a data-order="' . $order->ID . '" class="btn btn-sm btn-danger btn-row-delete" target="_blank">Delete</a>';

                                echo '</td>';

                                echo '</tr>';

                            }

                        }

                        ?>

                        </tbody>

                    </table>

                </div>



                <script>

                    jQuery(document).ready(function ($) {

                        var openordertab = $('#openorder-table').dataTable({

                            pageLength: 10,

                            columnDefs: [{orderable: false, targets: [3, 4]}],

                            order: [[0, 'asc']],

                            initComplete: function () {

                                $('<div id="openorder-column-filter"></div>').appendTo('#openorder-table_filter');

                                this.api().columns([2]).every(function () {

                                    var column = this;

                                    var select = $('<select><option value="">Filter Tech</option></select>')

                                        .appendTo($('#openorder-column-filter'))

                                        .on('change', function () {

                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                            column.search(val ? '^' + val + '$' : '', true, false).draw();

                                        });



                                    column.data().unique().sort().each(function (d, j) {

                                        select.append('<option value="' + d + '">' + d + '</option>')

                                    });

                                });

                            }

                        });

                        var closeordertab =  $('#closeorder-table').dataTable({

                            pageLength: 10,

                            columnDefs: [{orderable: false, targets: [3, 4]}],

                            order: [[0, 'asc']],

                            initComplete: function () {

                                $('<div id="closeorder-column-filter"></div>').appendTo('#closeorder-table_filter');

                                this.api().columns([2]).every(function () {

                                    var column = this;

                                    var select = $('<select><option value="">Filter Tech</option></select>')

                                        .appendTo($('#closeorder-column-filter'))

                                        .on('change', function () {

                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                            column.search(val ? '^' + val + '$' : '', true, false).draw();

                                        });



                                    column.data().unique().sort().each(function (d, j) {

                                        select.append('<option value="' + d + '">' + d + '</option>')

                                    });

                                });

                            }

                        });



                        $('#openorder-table').on('click', 'a.btn-row-delete', function (){

                            var order_id = $(this).data('order');

                            var currentrow = openordertab.api().row($(this).parents('tr'));

                            if (confirm('Are you sure you want to delete Order#' + order_id + '?')) {

                                $.post('/wp-admin/admin-ajax.php', {

                                    action: 'order_delete',

                                    nonce: '<?php echo wp_create_nonce('order_delete'); ?>',

                                    order_id: order_id

                                }, function (response) {

                                    if (response.status == 'ok') currentrow.remove().draw();

                                }, 'json' );

                            }

                        });



                        $('#closeorder-table').on('click', 'a.btn-row-delete', function (){

                            var order_id = $(this).data('order');

                            var currentrow = closeordertab.api().row($(this).parents('tr'));

                            if (confirm('Are you sure you want to delete Order#' + order_id + '?')) {

                                $.post('/wp-admin/admin-ajax.php', {

                                    action: 'order_delete',

                                    nonce: '<?php echo wp_create_nonce('order_delete'); ?>',

                                    order_id: order_id

                                }, function (response) {

                                    if (response.status == 'ok') currentrow.remove().draw();

                                }, 'json' );

                            }

                        });



                        <?php /*

                        $('#openorder-table').on('click', 'a.btn-test-email-admin', function(){

                            var order_id = $(this).data('order');

                            $.post('/wp-admin/admin-ajax.php', {

                                action: 'test_email_admin',

                                nonce: '<?php echo wp_create_nonce('test_email_admin'); ?>',

                                order_id: order_id

                            }, function (response) {

                                console.log(response);

                            }, 'json' );

                        });



                        $('#openorder-table').on('click', 'a.btn-test-email-tech', function(){

                            var order_id = $(this).data('order');

                            $.post('/wp-admin/admin-ajax.php', {

                                action: 'test_email_tech',

                                nonce: '<?php echo wp_create_nonce('test_email_admin'); ?>',

                                order_id: order_id

                            }, function (response) {

                                console.log(response);

                            }, 'json' );

                        });

                        */ ?>



                    });

                </script>



            <?php } else if (current_user_can('wh-tech')) { ?>



                <div class="row">

                    <div class="col-xs-6"><h4 class="mt-3">Open Order</h4></div>

                    <div class="col-xs-6 text-right" style="padding-top: 15px"><a href="/warehouse/?whtab=order" class="btn btn-sm btn-success">New Order</a></div>

                </div>

                <div class="order-lists">

                    <?php

                    $sql = "SELECT * FROM ips_wh_orders WHERE status = 'open' AND tech = " . get_current_user_id() . " ORDER BY date_open ASC";

                    $orders = $wpdb->get_results($sql);

                    if (!empty($orders)) {

                        foreach ($orders as $order) {

                            ?>

                            <div class="order-item" data-order="<?php echo $order->ID; ?>" data-toggle="modal" data-target="#orderModal">

                                <span class="label">Order ID:</span> <?php echo $order->ID; ?><br />

                                <span class="label">Order Date:</span> <?php echo date('m/d/Y h:ia', strtotime($order->date_open)); ?><br />

                                <span class="label">Order Notes:</span><br />

                                <div><?php echo nl2br($order->notes_tech); ?></div>

                                <span class="label">Admin Notes:</span><br />

                                <div><?php echo nl2br($order->notes_admin); ?></div>

                            </div>

                            <?php

                        }

                    } else {

                        echo '~ empty ~';

                    }

                    ?>

                </div>



                <h4 class="mt-5">Closed Order <span style="font-size: 0.5em; font-weight: normal;">Last 30days</span></h4>

                <div class="order-lists">

                    <?php

                    $date30 = date('Y-m-d 00:00:00', strtotime('-30 days'));

                    $sql =

                        "SELECT * FROM ips_wh_orders " .

                        "WHERE status = 'closed' " .

                        "AND tech = " . get_current_user_id() . " " .

                        "AND date_close > '$date30' " .

                        "ORDER BY date_open ASC";

                    $orders = $wpdb->get_results($sql);

                    if (!empty($orders)) {

                        foreach ($orders as $order) {

                            $order_date = date('m/d/Y h:ia', strtotime($order->date_open));

                            $close_date = $order->date_close != '' ? date('m/d/Y h:ia', strtotime($order->date_close)) : '-';

                            ?>

                            <div class="order-item" data-order="<?php echo $order->ID; ?>" data-toggle="modal" data-target="#orderModal">

                                <span class="label">Order ID:</span> <?php echo $order->ID; ?><br />

                                <span class="label">Order Date:</span> <?php echo date('m/d/Y h:ia', strtotime($order->date_open)); ?><br />

                                <span class="label">Order Notes:</span><br />

                                <div><?php echo nl2br($order->notes_tech); ?></div>

                                <span class="label">Admin Notes:</span><br />

                                <div><?php echo nl2br($order->notes_admin); ?></div>

                            </div>

                            <?php

                        }

                    } else {

                        echo '~ empty ~';

                    }

                    ?>

                </div>



            <?php } ?>



        </div>

    </main>

</section>



<!-- Order Modal -->

<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title mt-0" id="orderModalLabel">Order</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div id="orderModalBody" class="modal-body"></div>

        </div>

    </div>

</div>



<script>

    jQuery(document).ready(function ($) {



        $('#orderModal').on('show.bs.modal', function (e) {

            var btn = $(e.relatedTarget), order_id = btn.data('order');

            $('#orderModalLabel').empty().append('Order');

            $('#orderModalBody').empty().append('Loading order....');



            $.post('/wp-admin/admin-ajax.php', {

                action: 'get_order_modal',

                nonce: '<?php echo wp_create_nonce('get_order_modal'); ?>',

                order_id: order_id

            }, function (response) {

                if (response.status !== 'ok') { alert(response.message); return; }

                $('#orderModalLabel').empty().append(response.title);

                $('#orderModalBody').empty().append(response.content);

            }, 'json' );

        });



    });

</script>