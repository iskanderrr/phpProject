<?php session_start();
require_once "pdo.php";
require_once "mail.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .test {
            display: flex;
            align-items: center;
            /* Vertical alignment */
            justify-content: center;
            /*
            . Horizontal alignment (optional) */
        }

        .custom-file-upload {}
    </style>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="checkbox.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>






<body>
    <div class="left">
        <div class="content">
            <div style="width: 100%;text-align: center;height: 91px;">
                <div style="height: 55px;margin-bottom: 12px;">
                    <p class="text-3xl semi-bold test">Welcome Back!</p>
                </div>

                <div style="height: 24px;" class="test">

                    <p class="text-secondary-200 text-base">Lineo’s got you covered.</p>
                </div>
            </div>
            <div style="height: 32px;"></div>
            <form style="" action="register.php" method="post">

                <fieldset>
                    <legend>
                        Email
                    </legend>
                    <input style="width: 480px; padding-left: 18px;" type='email' placeholder="Your email here"
                        name="email">
                </fieldset>
                <div style="height: 32px;"></div>
                <!-- full name and password -->
                <div style="display:flex; width:483px; justify-content:space-between">
                    <fieldset style="width:200px">
                        <legend>
                            Full name
                        </legend>
                        <div class="password">
                            <input style="width: 211px;padding-left: 18px;" type='text' placeholder="Your full name"
                                name="name">
                            <img src="eye-slash.png" class="pass-icon" alt="">
                        </div>

                    </fieldset>
                    <fieldset style="width:200px">
                        <legend>
                            Password
                        </legend>
                        <div class="password">
                            <input style="width:211px;padding-left: 18px;" type='password'
                                placeholder="Your password here" name="pwd">
                            <img src="eye-slash.png" class="pass-icon" alt="">
                        </div>

                    </fieldset>
                </div>
                <div style="height: 32px;"></div>
                <!-- phone and pp -->
                <div style="display:flex; width:483px; justify-content:space-between">
                    <fieldset style="width:200px">
                        <legend>
                            Phone
                        </legend>
                        <div class="password">
                            <input style="width: 211px;padding-left: 18px;" type='text'
                                placeholder="Your Phone number here" name="phone">
                            <img src="eye-slash.png" class="pass-icon" alt="">
                        </div>

                    </fieldset>
                    <fieldset style="width:200px">
                        <legend>
                            Profile Picture
                        </legend>
                        <div class="password">
                            <label class="custom_upload" for="pp_upload" class="custom-file-upload">
                                <center style="color:white;font-weight:600; font-size:14px">Upload</center>

                            </label>
                            <input style="display:None" type='file' placeholder="Your password here" name="pp"
                                id="pp_upload">
                            <img src="eye-slash.png" class="pass-icon" alt="">
                        </div>

                    </fieldset>
                </div>
                <div style="height: 12px;"></div>
                <div class="cont" style="margin-bottom: 32px;margin-left: 5px;">
                    <div class="Remember">
                        <!--
                    <label class="checkbox-container">
                        <input class="custom-checkbox" checked="" type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                -->

                        <input style="margin-top: 2px;" checked="" class="check" type="checkbox">


                        <p>Remember me</p>
                    </div>
                    <div class="forgot">
                        <a href="">Forgot password?</a>
                    </div>

                </div>

                <button style="margin-bottom:19px;width:480;height:58;" class="button-gradient">
                    Sign in
                </button>
                <?php
                // Start the session
                
                $login = ""; // Not sure why this is here, seems unnecessary
                $pwd = ""; // Not sure why this is here, seems unnecessary
                
                if (isset($_POST['email'])) {

                    $email = $_POST["email"];
                    $pwd = $_POST["pwd"];
                    $phone = $_POST["phone"];
                    $name = $_POST["name"];
                    $pp = $_POST["pp"];

                    try {
                        $req = "SELECT * FROM users WHERE email='$email'"; // Use $email here instead of $login
                        $res = $pdo->query($req);

                        if ($data = $res->fetchAll(PDO::FETCH_ASSOC)) {
                            echo "<p ><center style='color:#A83522;font-weight:600;'>E-mail already used</center></p>";
                        } else {
                            // Use prepared statements to prevent SQL injection
                            $req = "INSERT INTO users (email, password, fullName, phoneNumber, role, pp) VALUES (:email, :pwd, :name, :phone, 'user', :pp)";
                            $stmt = $pdo->prepare($req);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':pwd', $pwd);
                            $stmt->bindParam(':name', $name);
                            $stmt->bindParam(':phone', $phone);
                            $stmt->bindParam(':pp', $pp);
                            $stmt->execute();
                            $to = "iskander.souissi912@gmail.com";
                            $subject = "Test Email";
                            $message = "This is a test email.";
                            $headers = "From: sender@example.com";

                            mailTo($email,$name,"hey");
                            echo "<meta http-equiv='refresh' content='3;url=/login.php' />";
                            echo "<p ><center style='color:#A83522;font-weight:600;'>signup successful, redirecting in 5 seconds...</center></p>";




                        }
                    } catch (PDOException $e) {
                        echo "ERREUR : " . $e->getMessage() . " LIGNE : " . $e->getLine();
                    }
                }
                ?>

            </form>
        </div>
        <p class="text-secondary-200" style="margin-top: 32px;">Don’t have an account? <a href="/"
                style="font-size: 16px;">Sign up</a></p>

    </div>
    <div class="right">
        <img src="frame 100.png" alt="Right Frame">
    </div>
</body>

</html>