<?php

/*

Plugin Name: 2Sons Warehouse

Plugin URI: https://www.crestinfosystems.com/

Description: 2SonsPlumbing Warehouse

Author: Crest Infosystems Pvt. Ltd

Version: 1.0.0

*/



define('WH_URL', 'http://localhost/testpr/warehouse/');



class iLocalWarehouse {



    static function start() {

        add_filter( 'page_template', ['iLocalWarehouse', 'warehousePageTemplate'] );



        add_action( 'wp_ajax_inventory_delete', ['iLocalWarehouse', 'inventory_delete'] );

        add_action( 'wp_ajax_admin_notes_add', ['iLocalWarehouse', 'admin_notes_add'] );

        add_action( 'wp_ajax_get_order_modal', ['iLocalWarehouse', 'get_order_modal'] );

        add_action( 'wp_ajax_order_delete', ['iLocalWarehouse', 'order_delete'] );



        add_action( 'wp_ajax_test_email_admin', ['iLocalWarehouse', 'test_email_admin'] );

        add_action( 'wp_ajax_test_email_tech', ['iLocalWarehouse', 'test_email_tech'] );

        add_action( 'wp_ajax_save_NewOrder', ['iLocalWarehouse', 'save_NewOrder'] );

    }



    static function email_admin_new_order($order_id) {

        global $wpdb;



        $sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";

        $order = $wpdb->get_row($sql);

        if (empty($order)) return;



        $admin_emails = [];

        $whAdmins = get_users( array( 'role__in' => array( 'wh-admin' ) ) );

        foreach ($whAdmins as $whAdmin) {

            if ($whAdmin->user_email == 'titus@ilocal.net') continue;

            $admin_emails[] = $whAdmin->user_email;

        }



        $order_user = get_user_by('ID', intval($order->tech));

        $order_user_login = $order_user->user_login;

        $order_user_email = $order_user->user_email;



        $email_subject = "New Open Order #" . $order_id . " from $order_user_login";

        $email_from = "2Sons Warehouse <warehouseapp@2sonsplumbing.com>";



        $headers = [ "Content-type: text/html", "From:$email_from", "Reply-To: $order_user_login <$order_user_email>" ];



        $order_date = date('m/d/Y h:ia', strtotime($order->date_open));

        $close_date = $order->date_close != '' ? date('m/d/Y h:ia', strtotime($order->date_close)) : '-';



        $r = '<style>.itemResponseModal span.label {

  display: inline-block;

  width: 120px;

  margin-right: 10px;

  font-weight: bold; }

.itemResponseModal .item {

  border: 1px solid #555;

  padding: 5px 10px;

  margin-bottom: 10px; }

.itemResponseModal .quantities {

  border-top: 1px solid #555;

  margin-top: 5px;

  padding-top: 5px; }

  .itemResponseModal .quantities .qty-requested, .itemResponseModal .quantities .qty-fulfilled {

    display: inline-block;

    width: 49%;

    text-align: center; }</style>';



        $r .= '<div class="itemResponseModal">';

        $r .= '<div class=""><span class="label">Tech:</span> ' . $order_user_login . '</div>';

        $r .= '<div class=""><span class="label">Order Notes:</span><br /><div>' . nl2br($order->notes_tech) . '</div></div>';

        $r .= '<div class=""><span class="label">Items:</span></div>';



        $sql = "SELECT * FROM  ips_wh_order_items WHERE order_id = $order_id";

        $items = $wpdb->get_results($sql);

        if (!empty($items)) {

            foreach ($items as $item) {

                $r .= '<div class="item">';

                $r .= '<div>' . $item->category . '<br />' .

                    $item->description . '<br />' .

                    'Part# ' . $item->part_number . '</div>';

                $r .= '<div class="quantities">' .

                    '<div class="qty-requested">Qty Requested: ' . $item->qty . '</div>' .

                    '</div>';

                $r .= '</div>';

            }

        }



        $r .= '</div>';



        wp_mail($admin_emails, $email_subject, $r, $headers);

    }



    static function email_tech_closed_order($order_id) {

        global $wpdb;



        $sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";

        $order = $wpdb->get_row($sql);

        if (empty($order)) return;



        $order_user = get_user_by('ID', intval($order->tech));

        $order_user_login = $order_user->user_login;

        $order_user_email = $order_user->user_email;



        $email_subject = "Order #" . $order_id . " Completed";

        $email_from = "2Sons Warehouse <warehouseapp@2sonsplumbing.com>";



        $headers = [ "Content-type: text/html", "From:$email_from" ];



        $order_date = date('m/d/Y h:ia', strtotime($order->date_open));

        $close_date = $order->date_close != '' ? date('m/d/Y h:ia', strtotime($order->date_close)) : '-';



        $r = '<style>.itemResponseModal span.label {

  display: inline-block;

  width: 120px;

  margin-right: 10px;

  font-weight: bold; }

.itemResponseModal .item {

  border: 1px solid #555;

  padding: 5px 10px;

  margin-bottom: 10px; }

.itemResponseModal .quantities {

  border-top: 1px solid #555;

  margin-top: 5px;

  padding-top: 5px; }

  .itemResponseModal .quantities .qty-requested, .itemResponseModal .quantities .qty-fulfilled {

    display: inline-block;

    width: 49%;

    text-align: center; }</style>';



        $r .= '<div class="itemResponseModal">';

        $r .= '<div class=""><span class="label">Tech:</span> ' . $order_user_login . '</div>';

        $r .= '<div class=""><span class="label">Order Open:</span> ' . $order_date . '</div>';

        $r .= '<div class=""><span class="label">Order Closed:</span> ' . $close_date . '</div>';

        $r .= '<div class=""><span class="label">Order Notes:</span><br /><div>' . nl2br($order->notes_tech) . '</div></div>';

        $r .= '<div class=""><span class="label">Admin Notes:</span><br /><div>' . nl2br($order->notes_admin) . '</div></div>';

        $r .= '<div class=""><span class="label">Items:</span></div>';



        $sql = "SELECT * FROM  ips_wh_order_items WHERE order_id = $order_id";

        $items = $wpdb->get_results($sql);

        if (!empty($items)) {

            foreach ($items as $item) {

                $r .= '<div class="item">';

                $r .= '<div>' . $item->category . '<br />' .

                    $item->description . '<br />' .

                    'Part# ' . $item->part_number . '</div>';

                $r .= '<div class="quantities">' .

                    '<div class="qty-requested">Qty Requested: ' . $item->qty . '</div>' .

                    '<div class="qty-fulfilled">Qty Pulled: ' . $item->qty_ok . '</div>' .

                    '</div>';

                $r .= '</div>';

            }

        }



        $r .= '</div>';



        wp_mail($order_user_email, $email_subject, $r, $headers);

    }



    static function get_order_modal() {

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'get_order_modal')) {

            $results = array( 'status' => 'failed', 'message' => 'Security check failed' );

            echo json_encode($results);

            exit;

        }



        global $wpdb;

        $order_id = intval($_POST['order_id']);

        $sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";

        $order = $wpdb->get_row($sql);



        if (empty($order)) {

            $results = array( 'status' => 'failed', 'message' => 'Order not found' );

            echo json_encode($results);

            exit;

        }



        $order_date = date('m/d/Y h:ia', strtotime($order->date_open));

        $close_date = $order->date_close != '' ? date('m/d/Y h:ia', strtotime($order->date_close)) : '-';



        $r = '<div class="itemResponseModal">';

        $r .= '<div class=""><span class="label">Order Open:</span> ' . $order_date . '</div>';

        $r .= '<div class=""><span class="label">Order Closed:</span> ' . $close_date . '</div>';

        $r .= '<div class=""><span class="label">Order Notes:</span><br /><div>' . nl2br($order->notes_tech) . '</div></div>';

        $r .= '<div class=""><span class="label">Admin Notes:</span><br /><div>' . nl2br($order->notes_admin) . '</div></div>';

        $r .= '<div class=""><span class="label">Items:</span></div>';

        $sql = "SELECT * FROM  ips_wh_order_items WHERE order_id = $order_id";

        $items = $wpdb->get_results($sql);

        if (!empty($items)) {

            foreach ($items as $item) {

                $r .= '<div class="item">';

                $r .= '<div>' . $item->category . '<br />' .

                    $item->description . '<br />' .

                    'Part# ' . $item->part_number . '</div>';

                $r .= '<div class="quantities">' .

                    '<div class="qty-requested">Qty Requested: ' . $item->qty . '</div>' .

                    '<div class="qty-fulfilled">Qty Pulled: ' . $item->qty_ok . '</div>' .

                    '</div>';

                $r .= '</div>';

            }

        }



        $r .= '</div>';



        $results = array(

            'status' => 'ok',

            'message' => '',

            'title' => 'Order #' . $order_id,

            'content' => $r

        );



        echo json_encode($results);

        exit;



    }



    static function warehousePageTemplate($page_template) {

        if ( is_page( 'warehouse' ) ) {

            $page_template = dirname( __FILE__ ) . '/page-warehouse.php';

        }

        return $page_template;

    }



    static function inventory_delete() {

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'inventory_delete')) {

            $results = array(

                'status' => 'failed',

                'message' => 'Security check failed'

            );



            echo json_encode($results);

            exit;

        }



        global $wpdb;

        $rows = $_POST['rows'];

        foreach ($rows as $row) {

            $row_id = intval($row);

            if ($row <= 0) continue;



            $sql = "SELECT * FROM ips_wh_items WHERE ID = $row_id";

            $item = $wpdb->get_row($sql);



            if (!empty($item)) {

                $wpdb->delete('ips_wh_items', array( 'ID' => $row_id ));

            }

        }



        $results = array(

            'status' => 'ok',

            'message' => ''

        );



        echo json_encode($results);

        exit;

    }



    static function order_delete() {

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'order_delete')) {

            $results = array(

                'status' => 'failed',

                'message' => 'Security check failed'

            );



            echo json_encode($results);

            exit;

        }



        global $wpdb;

        $order_id = intval($_POST['order_id']);



        $wpdb->delete('ips_wh_order_items', ['order_id' => $order_id]);

        $wpdb->delete('ips_wh_orders', ['ID' => $order_id]);



        $results = array(

            'status' => 'ok',

            'message' => ''

        );



        echo json_encode($results);

        exit;

    }



    static function admin_notes_add() {

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'admin_notes_add')) {

            $results = array(

                'status' => 'failed',

                'message' => 'Security check failed'

            );


            $new_results = str_replace('\\', '', $results);
            echo json_encode($new_results);

            exit;

        }



        global $wpdb;



        $previous = "n/a";



        $order_id = intval($_POST['order_id']);

        //$note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
        $note = $_POST['note'];


        $sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";

        $order = $wpdb->get_row($sql);



        if (!empty($order)) {

            $previous = $order->notes_admin;



            $user = wp_get_current_user();



            $new_notes = current_time('m/d/Y h:ia') . ' - ' . $user->user_login . "\n";

            $new_notes .= $note . "\n";

            $new_notes .= '-=-=-=-=-=-' . "\n\n";

            $new_notes .= $previous;



            $wpdb->update('ips_wh_orders', ['notes_admin' => $new_notes], ['ID' => $order_id]);



            $sql = "SELECT * FROM ips_wh_orders WHERE ID = $order_id";

            $order = $wpdb->get_row($sql);

            $previous = $order->notes_admin;

        }



        $results = array(

            'status' => 'ok',

            'message' => '',

            'content' => $previous

        );



        $new_results = str_replace('\\', '', $results);
        echo json_encode($new_results);

        exit;

    }



    static function formfieldText($label, $fieldname, $value = '', $class = '', $attributes = '', $row_class = '') {

        $id = sanitize_title($fieldname);

        ?>

        <div class="form-group row <?php echo $row_class; ?>">

            <label for="<?php echo $id; ?>" class="col-md-4 col-form-label"><?php echo $label; ?></label>

            <div class="col-md-8">

                <input type="text"

                       name="<?php echo $fieldname; ?>" id="<?php echo $id; ?>"

                       value="<?php echo $value; ?>"

                       class="form-control <?php echo $class; ?>" <?php echo $attributes; ?> /></div>

        </div>

        <?php

    }



    static function formfieldText_2($label, $fieldname, $value = '', $class = '', $attributes = '', $row_class = '') {

        $id = sanitize_title($fieldname);

        ?>

        <div class="form-group row <?php echo $row_class; ?>">

            <label for="<?php echo $id; ?>" class="col-md-2 col-form-label"><?php echo $label; ?></label>

            <div class="col-md-10">

                <input type="text"

                       name="<?php echo $fieldname; ?>" id="<?php echo $id; ?>"

                       value="<?php echo $value; ?>"

                       class="form-control <?php echo $class; ?>" <?php echo $attributes; ?> /></div>

        </div>

        <?php

    }



    static function formfieldTextArea_2($label, $fieldname, $value = '', $class = '', $attributes = '', $row_class = '') {

        $id = sanitize_title($fieldname);

        ?>

        <div class="form-group row <?php echo $row_class; ?>">

            <label for="<?php echo $id; ?>" class="col-md-2 col-form-label"><?php echo $label; ?></label>

            <div class="col-md-10">

                <textarea name="<?php echo $fieldname; ?>" id="<?php echo $id; ?>"

                          class="form-control <?php echo $class; ?>" <?php echo $attributes; ?>><?php echo $value; ?></textarea></div>

        </div>

        <?php

    }


    static function formfieldDropdown($label, $fieldname, $value = '', $class = '', $attributes = '', $row_class = '') {

        $id = sanitize_title($fieldname);

        ?>

        <div class="form-group row <?php echo $row_class; ?>">

            <label for="<?php echo $id; ?>" class="col-md-4 col-form-label"><?php echo $label; ?></label>

            <div class="col-md-8">
                <select name="<?php echo $fieldname; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $class; ?>" <?php echo $attributes; ?>>
                    <option value=""><?php echo "Select ". $label; ?></option>
                    <?php if (!empty($value)) foreach ($value as $item) { ?>
                        <option value="<?php echo $item->service_type; ?>"><?php echo strtoupper($item->service_type); ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>

        <?php

    }



    static function message_error($message) {

        return '<div class="alert alert-danger mt-4">' . $message . '</div>';

    }



    static function message_success($message) {

        return '<div class="alert alert-success mt-4">' . $message . '</div>';

    }

    static function save_NewOrder() {

        if (isset($_POST['new_sev']) && wp_verify_nonce($_POST['new_sev'], 'new-order-nonce') && isset($_POST['picked']) && !empty($_POST['picked'])) {

            global $wpdb;

            $user_ID = get_current_user_id();

            $order_data = [

                'tech' => $user_ID,

                'status' => 'open',

                'date_open' => current_time('Y/m/d H:i:s'),

                'notes_tech' => $_POST['order_note']

            ];

            $wpdb->insert('ips_wh_orders', $order_data);

            $order_id = $wpdb->insert_id;

            foreach ($_POST['picked'] as $pick) {

                $qty = intval($pick['qty']);

                if ($qty == 0) continue;



                $item_id = $pick['ID'];

                $sql = "SELECT * FROM ips_wh_items WHERE ID = $item_id";

                $item = $wpdb->get_row($sql);

                if (empty($item_id)) continue;



                $item_data = [

                    'order_id' => $order_id,

                    'item_id' => $pick['ID'],

                    'qty' => $qty,

                    'category' => $item->category,

                    'description' => $item->description,

                    'part_number' => $item->part_number

                ];



                $wpdb->insert( 'ips_wh_order_items', $item_data );

            }

            iLocalWarehouse::email_admin_new_order($order_id);

            $results = array(

                'status' => 'success',

                'message' => 'Order submitted successfully!'

            );

        } else {

            $results = array(

                'status' => 'failed',

                'message' => 'Add at least one item in Order.'

            );

        }

        $new_results = str_replace('\\', '', $results);
        echo json_encode($new_results);
        exit;

    }

}


// // Define PHP function to handle AJAX request
// add_action('wp_ajax_save_update_item', 'save_update_item');
// add_action('wp_ajax_nopriv_save_update_item', 'save_update_item'); // For non-logged-in users
// function save_update_item() {
//     try {
//         error_log('Received POST data:');
//         error_log(print_r($_POST, true));

//         // Check if formData is set
//         if (isset($_POST['formData'])) {
//             // Parse the form data
//             parse_str($_POST['formData'], $form_data); // Parse serialized form data

//             // Verify nonce
//             if (isset($form_data['item-update-nonce']) && wp_verify_nonce($form_data['item-update-nonce'], 'item-update-nonce')) {
//                 global $wpdb;

//                 // Update database with form data
//                 $result = $wpdb->update(
//                     'ips_wh_items',
//                     [
//                         'category' => $form_data['item-update-category'],
//                         'description' => $form_data['item-update-description'],
//                         'part_number' => $form_data['item-update-partnumber'],
//                         'service_type' => $form_data['item-update-servicetype']
//                     ],
//                     // ['ID' => intval($form_data['item-update-ID'])]
//                     ['ID' => intval(1172)]
//                 );
//                 // $res =  $wpdb->last_result;
//                 // Check result of database update
//                 if ($result !== false) {
//                     // Item saved successfully
                   
//                     wp_send_json_success();
//                 } else {
//                     // Error occurred while saving the item
//                     wp_send_json_error('An error occurred while saving the item.');
//                 }
//             } else {
//                 // Nonce verification failed
//                 wp_send_json_error('Nonce verification failed.');
//             }
//         } else {
//             // No form data received
//             wp_send_json_error('No form data received.');
//         }
//     } catch (Exception $e) {
//         // Catch any exceptions and log them
//         error_log('An exception occurred: ' . $e->getMessage());
//         wp_send_json_error('An error occurred while processing the request.');
//     }

//     // Always exit after sending the response
//     wp_die();
// }





// Define PHP function to handle AJAX request
add_action('wp_ajax_save_update_item', 'save_update_item');
add_action('wp_ajax_nopriv_save_update_item', 'save_update_item'); // For non-logged-in users
function save_update_item() {
    // Initialize response array
    $response = array();
    try {
        // Check if formData is set
        if (isset($_POST['formData'])) {
            // Parse the form data
            parse_str($_POST['formData'], $form_data); // Parse serialized form data

            // Verify nonce
            if (isset($form_data['item-update-nonce']) && wp_verify_nonce($form_data['item-update-nonce'], 'item-update-nonce')) {
                global $wpdb;

                // Update database with form data
                $result = $wpdb->update(
                    'ips_wh_items',
                    [
                        'category' => $form_data['item-update-category'],
                        'description' => $form_data['item-update-description'],
                        'part_number' => $form_data['item-update-partnumber'],
                        'service_type' => $form_data['item-update-servicetype']
                    ],
                    ['ID' => intval($form_data['item-update-ID'])]
                );

                // Check result of database update
                if ($result !== false) {
                    // Fetch the updated item from the database
                    // $updated_item = $wpdb->get_row(
                    //     $wpdb->prepare(
                    //         "SELECT * FROM ips_wh_items WHERE ID = %d",
                    //         intval($form_data['item-update-ID'])
                    //     )
                    // );

                    // // Item saved successfully
                    // $response['success'] = true;
                    // $response['data'] = $updated_item;
                    
                     $sql_hvac = "SELECT * FROM  ips_wh_items where service_type='hvac'";
                    $hvac_items = $wpdb->get_results($sql_hvac);

                    if ( $wpdb->last_error ) {
                      echo 'wpdb error: ' . $wpdb->last_error;
                    }

                    $dataItems2 = [];
                    
                    if (!empty($hvac_items)) foreach ($hvac_items as $item) {
                              

                                $dataItems2['item' . $item->ID] = [
                                    'ID' => $item->ID,
                                    'cat' => $item->category,
                                    'desc' => $item->description,
                                    'part' => $item->part_number,
                                    'service_type' => $item->service_type
                                ];
                            } 
                            $response['success'] = true;
                     $response['data'] =  json_encode($dataItems2);
                } else {
                    // Error occurred while saving the item
                    $response['success'] = false;
                    $response['error'] = 'An error occurred while saving the item.';
                }
            } else {
                // Nonce verification failed
                $response['success'] = false;
                $response['error'] = 'Nonce verification failed.';
            }
        } else {
            // No form data received
            $response['success'] = false;
            $response['error'] = 'No form data received.';
        }
    } catch (Exception $e) {
        // Catch any exceptions and log them
        $response['success'] = false;
        $response['error'] = 'An error occurred while processing the request: ' . $e->getMessage();
    }

    // Always exit after sending the response
    wp_send_json($response);
    wp_die();
}

iLocalWarehouse::start();





