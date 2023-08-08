<?php
$user_id = get_current_user_id();
$sql = "Select * from `loan_user` where id=$user_id";
$con = new mysqli('localhost', 'root', '', 'mysite');
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!-- // fghjkklllkkkjjhh -->
<?php
add_shortcode('all-user-details', 'all_user_details');
function all_user_details()
{
    $user_id = get_current_user_id();
    echo '<h3 style="text-align:center"; >All Users Loan Data</h3>';
?>

<style>
    .loan-table {
        margin: 20px;
        padding: 10px;
        border-collapse: collapse;
    }

    .loan-table th,
    .loan-table td {
        padding: 8px 16px;
        border: 1px solid #ccc;
    }

    .loan-table th {
        background-color: #f0f0f0;
    }

    .loan-table button {
        margin-right: 5px;
    }
</style>

<div style="margin: 20px;">
    <table class="loan-table">
        <thead>
            <tr>
                <th scope="col">User Id</th>
                <th scope="col">Requested Amount</th>
                <th scope="col">Date borrowed</th>
                <th scope="col">Due Date</th>
                <th scope="col">Date refunded</th>
                <th scope="col">Credit Status</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>

        <tbody>
            <?php
            global $wpdb;
            $sql = "Select * from `loan_user`";
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
                <td>' . $user_id . '</td>
                <td>' . $requested_amount . '</td>
                <td>' . $date_borrowed . '</td>
                <td>' . $due_date . '</td>
                <td>' . $date_refunded . '</td>
                <td>' . $credit_status . '</td>
                <td>
                    <button id="approval" type="submit" class="btn btn-success" name="submit">Approve</button>
                    <button id="decline" type="submit" class="btn btn-danger" name="submit">Decline</button>
                </td>
            </tr>';
                }
            } ?>
        </tbody>
    </table>
</div>
<?php
}
?>
