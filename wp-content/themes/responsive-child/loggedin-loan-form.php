<?php
add_shortcode('loggedin_loan_form', function () {
    ob_start(); // Start output buffering to capture the form content.
    ?>
    <form action="" method="POST">
        <?php wp_nonce_field('loggedin_loan_form_action', 'loggedin_loan_form_nonce'); ?>
        <label for="amount">Enter Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <input style="margin-top: 10px; background-color: green; border-radius: 10px;" name="submit" type="submit">
    </form>
    <?php
    // Get the captured output and store it in a variable.
    $form_content = ob_get_clean();

    if (isset($_POST['submit'])) {
        // Check the nonce to ensure the request is legitimate.
        if (!isset($_POST['loggedin_loan_form_nonce']) || !wp_verify_nonce($_POST['loggedin_loan_form_nonce'], 'loggedin_loan_form_action')) {
            wp_die('Invalid request.');
        }

        // Sanitize the requested amount.
        $requested_amount = intval($_POST['amount']);
        $credit_loan_limit = 10000;

        if ($requested_amount > $credit_loan_limit) {
            // Display an error message.
            $error_message = 'You cannot borrow more than ' . $credit_loan_limit;
            return '<div class="error">' . $error_message . '</div>' . $form_content;
        } else {
            // Get user information
            $user_id = get_current_user_id();
            $user_data = get_userdata($user_id);
            $user_email = $user_data->user_email;
            $username = $user_data->user_login;

            // Insert loan details into the database
            global $wpdb;
            $date = date('Y-m-d');
            $due_date = date('Y-m-d', strtotime($date . '+7 days'));

            // Use $wpdb->prefix to get the dynamic database prefix.
            $table_name = $wpdb->prefix . 'loan_user';

            $wpdb->insert($table_name, [
                'user_id' => $user_id,
                'user_email' => $user_email,
                'requested_amount' => $requested_amount,
                'date_borrowed' => $date,
                'due_date' => $due_date,
                'credit_status' => 'Pending',
            ]);

            // Email sent to the user about their successful loan application
            $admin_email = 'mueezlherha@gmail.com';
            $headers = 'From: ' . $admin_email . "\r\n" . 'Reply-To: ' . $admin_email . "\r\n";
            wp_mail(
                $user_email,
                'Loan Success Email',
                "Dear $username, \n\nYour loan application is successful, and your account has been credited with $requested_amount.\n\nBest regards,\nThe Loan Team",
                $headers
            );

            // Display a success message.
            $success_message = 'Loan application successful, check your email or dashboard.';
            return '<div class="success">' . $success_message . '</div>';
        }
    }

    // If the form is not submitted, return the form content.
    return $form_content;
});
