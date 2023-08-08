<?php
function bbloomer_add_premium_support_endpoint()
{
    add_rewrite_endpoint('premium-support', EP_ROOT | EP_PAGES);
}

add_action('init', 'bbloomer_add_premium_support_endpoint');

function bbloomer_premium_support_query_vars($vars)
{
    $vars[] = 'premium-support';
    return $vars;
}

add_filter('query_vars', 'bbloomer_premium_support_query_vars', 0);

function bbloomer_add_premium_support_link_my_account($items)
{
    $items['premium-support'] = 'My Loan Details';
    return $items;
}

add_filter(
    'woocommerce_account_menu_items',
    'bbloomer_add_premium_support_link_my_account'
);

function bbloomer_premium_support_content()
{
    $user_id = get_current_user_id();
    // $user_id = wp_create_user($username, $password, $email);

    //   $user_id = $order->get_current_user_id();
    //   $order = new WC_order($order_id);

    // echo '<h3>My Loan Data</h3>';
?>
    <table>
        <thead>
            <tr>
                <th scope="col">User Id</th>
                <th scope="col">Requested Amount</th>
                <th scope="col">Date borrowed</th>
                <th scope="col">Due Date</th>
                <th scope="col">Date refunded</th>
                <th scope="col">Credit Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
            global $wpdb;
            $sql = "Select * from `loan_user` WHERE user_id='$user_id'";
            $result = $wpdb->get_results($sql, OBJECT);
            if ($result) {
                foreach ($result as $row) {
                    $user_id = $row->user_id;
                    $requested_amount = $row->requested_amount;
                    $date_borrowed = $row->date_borrowed;
                    $due_date = $row->due_date;
                    $date_refunded = $row->date_refunded;
                    $credit_status = $row->credit_status;

                    echo '<tr>
        <td>' .
                        $user_id .
                        '</td>
        <td>' .
                        $requested_amount .
                        '</td>
        <td>' .
                        $date_borrowed .
                        '</td>
        <td>' .
                        $due_date .
                        '</td>
        <td>' .
                        $date_refunded .
                        '</td>
        <td>' .
                        $credit_status .
                        '</td>
        </tr>';
                }
            } ?>
        </tbody>
    </table>
<?php
}

add_action(
    'woocommerce_account_premium-support_endpoint',
    'bbloomer_premium_support_content'
);

add_action('woocommerce_thankyou', 'custom_woocommerce_auto_complete_order');
function custom_woocommerce_auto_complete_order($order_id)
{
    if (!$order_id) {
        return;
    }

    $order = wc_get_order($order_id);
    $order->update_status('completed');
}
