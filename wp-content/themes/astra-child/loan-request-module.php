<?php

add_shortcode(
    'loan_entry_form',
    function () {
?>
    <form action="" method="post">
        <label for="fname">First name</label><br>
        <input type="text" id="fname" name="fname" required><br>
        <label for="lname">Last name</label><br>
        <input type="text" id="lname" name="lname" required><br>
        <label for="name"> Amount</label><br>
        <input type="number" id="amount" name="amount" required><br>
        <label for="customer_bvn">BVN</label><br>
        <input type="number" id="customer_bvn" name="customer_bvn" required /><br>
        <label for="address">Address</label><br>
        <input type="text" id="address" name="address" required><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="customer_tel">Phone</label><br>
        <input type="number" id="customer_tel" name="customer_tel" required /><br><br>
        <input type="submit" name='submit'>
    </form>


<?php
       //   update_user_meta($user_id, '_credit_loan_limit', $credit_loan_limit);
       $requested_amount = $_POST['requested_amount'];
       $credit_loan_limit = 5000;

       if ($requested_amount > $credit_loan_limit) {
           echo '<script>alert("You cannot borrow more than' .
               $credit_loan_limit .
               '")</script>';
       } else {
           if (isset($_POST['submit'])) {
               $username = $_POST['firstname'];
               $bvn = $_POST['bvn'];
               $address = $_POST['address'];
               $phone = $_POST['phone'];
               $password = wp_generate_password();
               $email = $_POST['email'];
               $user_id = wp_create_user($username, $password, $email);
               echo "<script> alert ('Loan application successful, check your email to login')</script>";
               $user = get_user_by('id', $user_id);
               //    $user_name = $user->user_login;
               //    $user_email = $user->user_email;
               //    $amount = $user->user_login;
               //    $description = $user->amount;
               $admin_email = 'mueezlherha@gmail.com';
               //    $credit_score = get_user_meta($user_id, '_creditscore', true);
               //    $credit_loan_limit = get_user_meta($user_id, '_credit_loan_limit', true);
               // if ($requested_amount > $credit_loan_limit) {
               //     echo '<script>alert("You cannot borrow more than' .
               //         $credit_loan_limit .
               //         '")</script>';
               // } else {
               //    sql query to save the amount entered to the DB.
               // woo_wallet()->wallet->credit($user_id, $amount, $description);
               global $wpdb;
               //     $user_id = get_current_user_id();
               //     $user_data = get_userdata($user_id);
               $date = date('Y-m-d');
               $due_date = date('Y-m-d', strtotime($date . '+7 days'));

               $wpdb->insert('loan_user', [
                   'user_id' => $user_id,
                   'requested_amount' => $requested_amount,
                   'date_borrowed' => $date,
                   'due_date' => $due_date,
                   'credit_status' => 'Pending',
               ]);
               update_user_meta($user_id, 'customer_bvn', $bvn);
               update_user_meta($user_id, 'address', $address);
               update_user_meta($user_id, 'customer_tel', $phone);
               // email sent to the user about his successful loan application
               $headers =
                   'From: ' . $admin_email . "\r\n" . 'Reply-To: ' . $admin_email . "\r\n";
               wp_mail(
                   $email,
                   'Loan Success Email',
                   "Dear $username. Your loan application is successful and your account has been
                    credited with $requested_amount and your password is $password",
                   $headers
               );
           }
       }

    }
);