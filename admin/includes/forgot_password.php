<?
require_once "../functions.php";
$rowCount = table_Users ('check_with_two_param', 'Email', 'Mobile', NULL, NULL, NULL);


// meaning that the Email and Mobile provided are correct
if ($rowCount == 1) {
    //getting users password
    $rows_Users = table_Users ('select_users_with_one_column', 'Email', $_POST['Email'], NULL, NULL, NULL);
    foreach ($rows_Users as $row_Users) {
       # code...
    }
    
    //generating link
    $link = "check_reset_password.php?Email=".$row_Users->Email."&uchk=".$row_Users->Password;

    // sending email to the user
    $mail_header = "FROM: No Reply <noreply@mydomain.com>\r\n";
    $mail_header .= "Content-type: text/html\r\n";
    $subject = $row_Users->StoresName." Password Reset";
    $message = "Dear Sir/Madam, ";
    $message .= "<br>";
    $message .= "As you have requested to reset your password for your webstore: ";
    $message .= $row_Users->StoresName.", we are pleased to send you the link below to reset your password.";
    $message .= "<br>";
    $message .= "<a href=\"$link\">Click Here!</a>";
    $message .= " OR copy the url below.";
    $message .= "<br>";
    $message .= "<a href=\"$link\">".$link."</a>";
    $message .= "<br>";
    $message .= "<span style='color: red'>If you did not request to reset your password, please contact us asap!</span>";
    echo $message;
    // if (mail($_POST['Email'], $subject, $message, $mail_header)) {
    //     //if email has been sent successfully,
    //     echo "<span style='color: blue;'>An email has been sent to your mail! Please do not forget to check your junk mail box as well. :)</span>";
    // }
    // else {
    //     // For connection error!
    //     echo "<span style='color: red;'>There was a connection error! Please try again!</span>";
    // }	
}
else {
    // meaing the email and mobiles provided are not found in the database
    echo "<span style='color: red;'>We could not find your account with the information you have provided! <br> Please contact your software vendor!</span>";
}
$db = NULL;
?>