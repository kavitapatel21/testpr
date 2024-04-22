<?php
global $wpdb;
$order_id = intval($_GET['orderid']);
$sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";
$order = $wpdb->get_row($sql);

if (empty($order)) {
    echo 'Order not found';
    exit;
}

$user = get_user_by('ID', $order->tech);
$technician = $user->user_login;

$order_date = date('m/d/Y h:ia', strtotime($order->date_open));
$close_date = $order->date_close != '' ? date('m/d/Y h:ia', strtotime($order->date_close)) : '-';

$sql = "SELECT * FROM  ips_wh_order_items WHERE order_id = $order_id";
$items = $wpdb->get_results($sql);

?>
<style><?php include 'css/print.css'; ?></style>
<page>
    <div class="header">
        <div class="header-left">
            <img src="https://www.2sonsplumbing.com/wp-content/uploads/2019/03/Joes-2sons.png" />
        </div>
        <div class="header-right">
            Warehouse Request
        </div>
    </div>

    <div class="order-container">
        <table class="order-table">
            <tr>
                <td class="label">Order ID:</td>
                <td><?php echo $order_id; ?></td>
                <td class="label">Technician:</td>
                <td><?php echo $technician; ?></td>
            </tr>
            <tr>
                <td class="label">Order Open Date:</td>
                <td><?php echo $order_date; ?></td>
                <td class="label">Order Close Date:</td>
                <td><?php echo $close_date; ?></td>
            </tr>
            <tr>
                <td class="label">Technician Notes:</td>
                <td colspan="3"><?php echo nl2br( $order->notes_tech ); ?></td>
            </tr>
            <tr>
                <td class="label">Admin Notes:</td>
                <td colspan="3"><?php echo nl2br($order->notes_admin); ?></td>
            </tr>
        </table>
    </div>

    <div class="order-container">
        <table class="order-items">
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td class="item"><?php echo $item->description . '<br />' .
                        'Part# ' . $item->part_number; ?></td>
                    <td class="quantity"><?php echo $item->qty_ok . ' / ' . $item->qty; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>


</page>
<script>
    window.print();
</script>





<?php
/*

$r = '<div class="itemResponseModal">';
$r .= '<div class=""><span class="label">Order Open:</span> ' . $order_date . '</div>';
$r .= '<div class=""><span class="label">Order Closed:</span> ' . $close_date . '</div>';
$r .= '<div class=""><span class="label">Order Notes:</span><br /><div>' . nl2br($order->notes_tech) . '</div></div>';
$r .= '<div class=""><span class="label">Admin Notes:</span><br /><div>' . nl2br($order->notes_admin) . '</div></div>';
$r .= '<div class=""><span class="label">Items:</span></div>';





if (!empty($items)) {
    foreach ($items as $item) {
        $r .= '<div class="item">';
        $r .= '<div>' . $item->category . '<br />' .
            $item->description . '<br />' .
            'Part# ' . $item->part_number . '</div>';
        $r .= '<div class="quantities">' .
            '<div class="qty-requested">Qty Requested: ' . $item->qty . '</div>' .
            '<div class="qty-fulfilled">Qty Fulfilled: ' . $item->qty_ok . '</div>' .
            '</div>';
        $r .= '</div>';
    }
}

$r .= '</div>';
*/