<?php
require_once "conn.php";
$rowCount = 3;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="Shortcut icon" href="../logo_small.png"/>
    <title>Reset Password</title>
</head>
<body>
    <!-- wrapper -->
    <div class="wrapper">
        <header></header>
        <!-- main-content -->
        <div class="main-content">
            <section id="page-title">
                <h1>Reset Password</h1>
            </section>
            <section id="Dob-check">
                <!-- dob-check-form -->
                <div class="form">
                    <form action="#" method="post">
                        <div>
                            Please enter your Date of Birth:
                        </div>
                        <div>
                            <input type="hidden" id="Email" value="<? echo $_REQUEST['Email']; ?>">
                        </div>
                        <div>
                            <input type="date" id="DOB" name="DOB" value="<? if(isset($_REQUEST['DOB'])) { echo $_REQUEST['DOB'];}?>">
                        </div>
                        <div style="text-align: center;">
                            <button type="button" id="btn-submit" class="medium button">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end of dob-check-form -->
            </section>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                //check if the given DOB is correct
                $db = new Database();
                $stm = "SELECT * FROM Users WHERE 
                    Password = :Password AND
                    Email = :Email AND
                    DOB = :DOB
                ;";
                $db->query($stm);
                $db->bind(':Password', $_REQUEST['uchk']);
                $db->bind(':Email', $_REQUEST['Email']);
                $db->bind(':DOB', $_REQUEST['DOB']);
                $rowCount = $db->rowCount();
                $db = NULL;
            } ?>

            <?php if ($rowCount == 1): ?> 
            <!-- this form will only show when the form is submitted properly!-->
            <section id="pswd-reset-form">
                <div class="form">
                    <div>
                        <input type="password" id="password" placeholder="Enter New Password">
                    </div>
                    <div>
                        <input type="password" id="repassword" placeholder="Confirm Your Password" onblur="checkPasswords();">
                    </div>
                    <div>
                        <button type="button" id="button-submit" class="medium button" onclick="updatePassword();" disabled>Update</button>
                    </div>
                </div>
            </section>
            <?php elseif ($rowCount == 0): ?>
            <section>
                <div style="color: red;">We could not find your account! Please ensure that your date of birth is correct!</div>
            </section>
            <?php else:?>
            <section>
                <div;">Please enter your date of birth!</div>
            </section>        
            <?php endif;?>
            <section id="response"></section>
        </div>
        <!-- end of main-content -->
        <footer></footer>
    </div>
    <!-- end of wrapper -->
</body>
<script src="../scripts/jquery.js"></script>
<script src="../scripts/scripts.js"></script>
<script>
$(document).ready(function () {
    
    // function to include footer
    $.get("includes/footer.php", function (data) {
        $("footer").prepend(data);
    }); 

    $("#btn-submit").on("click", function () {
        var DOB = $("#DOB");
        if (DOB.val() == "") {
            var errorMsg = "<span style='color: red;'>Please input your date of birth!</span>";
            $("#response").html(errorMsg);
        }
        else {
            $(this).prop('type', 'submit');
        }
    });
});
</script>
</html>