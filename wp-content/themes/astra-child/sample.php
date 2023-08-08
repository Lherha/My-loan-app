<?php
global $wpdb;

$execute = $wpdb->query
("
UPDATE `loan_user` 
SET `credit_status` = 'approve' 
SET `credit_status` = 'decline' 
WHERE `loan_user`.`ID` = 19
");

var_dump($execute);


// Assuming you have the user ID and the status (approve or decline) available as variables
$user_id = 123; // Replace with your user ID
$credit_status = 'approve'; // Replace with 'approve' or 'decline' based on your condition

global $wpdb;
$table_name = $wpdb->prefix . 'loan_user';

// Prepare the data to be updated
$data = array(
    'status' => $credit_status,
);

// Prepare the data format for the WHERE clause
$where = array(
    'user_id' => $user_id,
);

// Run the update query based on the status condition
if ($credit_status === 'approve') {
    // Update user status to 'approved'
    $wpdb->update($table_name, $data, $where);
} elseif ($credit_status === 'decline') {
    // Update user status to 'declined'
    $wpdb->update($table_name, $data, $where);
} else {
    // Handle invalid status, if needed
    // For example, you may want to show an error message or do something else
}
