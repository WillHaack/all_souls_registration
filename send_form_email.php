<?php
$firstname = $_POST['element_1_1'];
$lastname = $_POST['element_1_2'];
$uscf = $_POST['element_2'];
$streetaddress = $_POST['element_3_1'];
$streetaddress2 = $_POST['element_3_2'];
$city = $_POST['element_3_3'];
$state = $_POST['element_3_4'];
$zip = $_POST['element_3_5'];
$country = $_POST['element_3_6'];
$phonenumber = $_POST['element_4_1'] . $_POST['element_4_2'] . $_POST['element_4_3'];
$tournament = $_POST['element_10'];
$section = $_POST['element_8'];
$gradelevel = $_POST['element_9'];
$birthdate = $_POST['element_5_1'] . "/" . $_POST['element_5_2'] . "/" . $_POST['element_5_3'];
$school = $_POST['element_6'];
$email = $_POST['element_7'];
$email_to = "wmh1993@gmail.com";
$email_subject = $firstname . " " . $lastname . "'s registration for " . $tournament;
if(true) { //todo get rid of this
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    $error_message = "";
    if(!isset($firstname) || !isset($lastname) || !strcmp($firstname, "") || !strcmp($lastname, "")){
    $error_message .= "Please enter both a first and last name for the participant.<br />";
    }
    if(!isset($phonenumber) || !strcmp($phonenumber, "")){
    $error_message .= "Please enter a valid phone number.<br />";
    }  
    if (!isset($tournament) || !strcmp($tournament, "")){
    $error_message .= "Please select which tournament you are registering for.<br />";
    }
    if (!isset($section) || !strcmp($section, "")){
    $error_message .= "Please select which section you are registering for.<br />";
}
if (!isset($gradelevel) || !strcmp($gradelevel, "")){
   $error_message .= "Please select which grade level the participant is currently in. <br />";
}
if (strcmp($gradelevel, "Adult") == 0 && (strcmp($section, "Open"))){
   $error_message .= "Adults must play in the Open section.<br />";
}

if (!isset($birthdate)){
   $error_message .= "Please enter the participant's birthdate.<br />";
}

if (!isset($school)){
   $error_message .= "Please enter the participant's school.<br />";
}

if (!isset($email)){
   $error_message .= "Please enter an email address.<br />";
}
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "First Name: ".clean_string($firstname)."\n";
    $email_message .= "Last Name: ".clean_string($lastname)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telephone: ".clean_string($phonenumber)."\n";
    $email_message .= "USCF #: ".clean_string($uscf)."\n";
    $email_message .= "Tournament Date: ".clean_string($tournament)."\n";
    $email_message .= "Section: ".clean_string($section)."\n";
    $email_message .= "Grade Level: " .clean_string($gradelevel)."\n";
    $email_message .= "School: " .clean_string($school)."\n";
    $email_message .= "Birthdate: " .clean_string($birthdate)."\n";
    $email_message .= "Address 1: " .clean_string($streetaddress)."\n";
    $email_message .= "Address 2: " .clean_string($streetaddress2)."\n";
    $email_message .= "State: " .clean_string($state)."\n";
    $email_message .= "Country: ".clean_string($country)."\n";
    $email_message .= "Zip: " .clean_string($zip)."\n";
     
     
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
}
?>