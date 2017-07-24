<?php

// define variables and set to empty values
$name_error = $email_error = $topic_error = $url_error = "";
$name = $email = $topic = $message = $url = $success = $foo = $foo2 = "";


//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $name_error = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["email"])) {
    $email_error = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format"; 
    }
  }

  if (empty($_POST["topic"])) {
    $topic_error = "Topic is required";
  } else {
    $topic = test_input($_POST["topic"]);
    // check if topic only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed"; 
    }
  }
  
  
    if (empty($_POST["url"])) {
    $url_error = "";
  } else {
    $url = test_input($_POST["url"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
      $url_error = "Invalid URL"; 
    }
  }

if (empty($_POST["message"])) {
    $message = "";
} else {
    $message = test_input($_POST["message"]);
}


    if ($name_error == '' and $email_error == '' and $topic_error == '' and $url_error == '' ){
        $message_body = '';
        unset($_POST['submit']);
       // var_dump($_POST); exit();
        foreach ($_POST as $key => $value){
            $message_body .=  "$key: $value\n";
        }
        
        if(isset($_POST['noForm1']) && $_POST['noForm1'] == ''){
        // then send the form to your email
          $EmailTo = "contact@sgcoding.media";//-> the message will be sent to this address if you have configure mail stuff well
        $Subject =  "$topic";
        $headers = "From: $email";
        if (mail($EmailTo, $Subject, $message, $headers)){
            $success = "Message sent, I will reply to you asap!";
            $name = $email = $topic = $message = $url = '';
        }else{
            echo "Failure";
        }
    }else{
        echo "Failure 2";
        }
     }
        }
        
        function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
 ?>