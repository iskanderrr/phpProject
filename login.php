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
            /* Horizontal alignment (optional) */
        }
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
            <form style="" action="login.php" method="post">
               
                <fieldset>
                    <legend style="color:#9A9A9A; padding-left: 7px;padding-right: 7px;margin-left: 14px;">Email
                    </legend>
                    <input style="border:none;input:focus {outline:none;};width: 480px; padding-left: 18px;" type='text'
                        placeholder="Your email here" name="login">
                </fieldset>
                <div style="height: 32px;"></div>
                <fieldset>
                    <legend style="color:#9A9A9A; padding-left: 7px;padding-right: 7px;margin-left: 14px;">Password
                    </legend>
                    <div class="password">
                        <input style="border:none;input:focus {outline:none;};width: 440px;padding-left: 18px;"
                            type='text' placeholder="Your password here" name="pwd">
                        <img src="eye-slash.png" class="pass-icon" alt="">
                    </div>

                </fieldset>
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
             
                <button style="margin-bottom:19px;width:480;height:58;background: rgb(16,112,255);
  background: linear-gradient(11deg, rgba(16,112,255,1) 1%, rgba(185,127,255,1) 34%, rgba(255,162,102,1) 63%, rgba(255,162,102,1) 73%, rgba(255,201,167,1) 100%);
  " class="button-gradient">
                    Sign in
                </button>
                <?php
                require_once "pdo.php";
                $login = "";
                $pwd = "";
                if (isset($_POST['login'])) {
                    $login = $_POST["login"];
                    $pwd = $_POST["pwd"];
                    try {
                        $req = "SELECT * FROM users WHERE email='$login'and password='$pwd'";
                        $res = $pdo->query($req);

                        if ($data = $res->fetchAll(PDO::FETCH_ASSOC)) {

                            $_SESSION["connecte"] = "1";
                            $_SESSION["user"] = $data[0]["user"];
                            header("location:login.php");
                            exit();
                        } else
                            echo "<p ><center style='color:#A83522;font-weight:600;'>Wrong password or e-mail</center></p>";
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