// var getUrl = window.location;
// var baseURL_signup =
//   getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1];

// if (baseURL_signup.startsWith('https')) {
//   baseURL_signup = getUrl.protocol + '//' + getUrl.host;
// }

// let baseURL_signup = 'http://localhost/wordpress/mysite/wp-json/api/v1/create-loan-user';

// console.log(baseURL_signup);

document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");
    signupForm.addEventListener("submit", function (event) {
      event.preventDefault();
      const firstName = document.getElementById("firstName").value;
      const lastName = document.getElementById("lastName").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
  
      // Validate form data
      if (!validateFormData(firstName, lastName, email, password)) {
        alert("Please fill in all fields correctly.");
        return;
      }
  
      // Submit the form data
      submitFormData(firstName, lastName, email, password);
    });
  });
  
  function validateFormData(firstName, lastName, email, password) {
    // You can implement custom validation rules here
    if (!firstName || !lastName || !email || !password) {
      return false;
    }
  
    return true;
  }
  
  function submitFormData(firstName, lastName, email, password) {
    const baseURL = "http://localhost/myloanapp/index.php";
  
    // Prepare the data object to send to the server
    const userData = {
      firstName: firstName,
      lastName: lastName,
      email: email,
      password: password,
    };
  console.log(userData);
    // Send the data to the server using fetch API
    fetch(baseURL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(userData),
    })
      .then((response) => response.json())
      .then((data) => {
        // Handle the server response if needed
        console.log(data);
        alert("User created successfully!");
        // You can redirect to another page or perform any other actions after successful user creation
      })
      .catch((error) => {
        // Handle errors, if any
        console.error("Error creating user:", error);
        alert("An error occurred while creating the user.");
      });
  }
  