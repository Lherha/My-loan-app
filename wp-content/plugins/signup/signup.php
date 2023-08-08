<?php

/**
 * Plugin Name:       Sign up loan user
 * Plugin URI:        http://localhost/myloanapp/
 * Description:       Registration form for my_loan_app
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ajao Mueez Bolaji
 */


function enqueue_signup_loan_app_files(){
 
   wp_enqueue_script('loan_app_signup_js', plugin_dir_url(__FILE__) . './assets/loanAppSignup.js', array(), false);
  
   wp_localize_script('loan_app_signup_js', 'objectName', array(
    'isUserLoggedIn' =>  is_user_logged_in()
	));

  wp_enqueue_style('loan_app_signup_css', plugin_dir_url(__FILE__) . './assets/loanAppSignup.css', array());
  
}
add_action( 'init', 'enqueue_signup_loan_app_files' );

function signup(){

  ?>

    <section class="container">
      <form id="signupForm">
        <div class="row my-3">
          <div class="col-sm-6">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" placeholder="John" />
          </div>
          <div class="col-sm-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" placeholder="Doe" />
          </div>
        </div>
  
        <div class="row my-3">
          <div class="col-sm-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" mailto:placeholder="john@email.com" />
          </div>
          <div class="col-sm-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="     " />
          </div>
        </div>
        
        <div class="row my-3">
          <div class="col-sm-6">
            <button type="submit" class="btn btn-success">Sign up</button>
          </div>
        </div>
      </form>
    </section>

  <?php
}
add_shortcode('signup', 'signup');


