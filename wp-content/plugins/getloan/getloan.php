<?php
add_shortcode('loan_entry_form', function () {
    if (isset($_POST['submit'])) {
        $nonce = $_POST['loan_entry_nonce'];
        if (!wp_verify_nonce($nonce, 'loan_entry_form')) {
            die('Security check failed.');
        }

        $requested_amount = (int) $_POST['amount'];
        $credit_loan_limit = 5000;

        if ($requested_amount > $credit_loan_limit) {
            echo '<script>alert("You cannot borrow more than ' . $credit_loan_limit . '")</script>';
        } else {
            $username = sanitize_text_field($_POST['fname']);
            $customer_bvn = sanitize_text_field($_POST['customer_bvn']);
            $address = sanitize_text_field($_POST['address']);
            $customer_tel = sanitize_text_field($_POST['customer_tel']);
            $email = sanitize_email($_POST['email']);
            $password = wp_generate_password();

            $user_id = wp_create_user($username, $password, $email);

            if (is_wp_error($user_id)) {
                echo "<script> alert ('There was an error creating the user.')</script>";
            } else {
                echo "<script> alert ('Loan application successful, check your email for your login details')</script>";
                $user = get_user_by('id', $user_id);
                $admin_email = 'mueezlherha@gmail.com';

                global $wpdb;
                $date = date('Y-m-d');
                $due_date = date('Y-m-d', strtotime($date . '+7 days'));

                $wpdb->insert('loan_user', [
                    'user_id' => $user_id,
                    'requested_amount' => $requested_amount,
                    'user_email' => $email,
                    'date_borrowed' => $date,
                    'due_date' => $due_date,
                    'credit_status' => 'Pending',
                ]);

                update_user_meta($user_id, 'customer_bvn', $customer_bvn);
                update_user_meta($user_id, 'address', $address);
                update_user_meta($user_id, 'customer_tel', $customer_tel);

                $headers =
                    'From: ' . $admin_email . "\r\n" . 'Reply-To: ' . $admin_email . "\r\n";
                wp_mail(
                    $email,
                    'Loan Success Email',
                    "Dear $username. Your loan application is successful and your account has been credited with $requested_amount and your password is $password",
                    $headers
                );

                // Redirect to the desired page after successful form submission
                echo '<script>window.location.replace("http://localhost/myloanapp/?page_id=16");</script>';
            }
        }
    }
    ?>
    <section class="container">
        <form action="" method="POST">
            <?php wp_nonce_field('loan_entry_form', 'loan_entry_nonce'); ?>
            <div class="row my-3">
                <div class="col-sm-6">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="" required />
                </div>
                <div class="col-sm-6">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" name="lname" class="form-control" id="lname" placeholder="" required />
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6">
                    <label for="customer_bvn" class="form-label">BVN</label>
                    <input type="text" name="customer_bvn" class="form-control" id="customer_bvn" placeholder="" required />
                </div>
                <div class="col-sm-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="" required />
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6">
                    <label for="customer_tel" class="form-label">Phone</label>
                    <input type="text" name="customer_tel" class="form-control" id="customer_tel" placeholder="" required />
                </div>
                <div class="col-sm-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="" required />
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6">
                    <label for="amount">Enter Amount:</label><br>
                    <input type="number" id="amount" name="amount" value="" required><br><br>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </section>
    <?php
});
?>
