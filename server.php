<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'login');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = trim(mysqli_real_escape_string($db, $_POST['username']));
  $email = trim(mysqli_real_escape_string($db, $_POST['email']));
  $password_1 = trim(mysqli_real_escape_string($db, $_POST['password_1']));
  $password_2 = trim(mysqli_real_escape_string($db, $_POST['password_2']));

  // form validation: ensure that the form is correctly filled
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure a user does not already exist with the same username or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register the user if there are no errors in the form
  if (count($errors) == 0) {
    // Encrypt the password using password_hash()
    $password = password_hash($password_1, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = "INSERT INTO users (username, email, password) 
              VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    
    // Create session and redirect
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: home.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = trim(mysqli_real_escape_string($db, $_POST['username']));
  $password = trim(mysqli_real_escape_string($db, $_POST['password']));

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    // Check the database to see if the user exists
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db, $query);

    if (!$result) {
      die("Query failed: " . mysqli_error($db));
    }

    if (mysqli_num_rows($result) == 1) {
      $user = mysqli_fetch_assoc($result);
      
      // Verify the password using password_verify()
      if (password_verify($password, $user['password'])) {
        // Password matches, create session and redirect
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: home.php');
      } else {
        array_push($errors, "Wrong username/password combination");
      }
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

// LOGOUT USER
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: login.php');
}
?>
