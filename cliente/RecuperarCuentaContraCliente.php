<?php session_start() ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Kerkly</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">KERKLY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Restablecer Contraseña</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="recover_psw">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Correo: </label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Restablecer" name="recover">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
</html>

<?php 
use PHPMailer\PHPMailer\PHPMailer; 

    if(isset($_POST["recover"])){
        
        include 'conexionK.php';

        $email = $_POST["email"];

//el $Conexin viene desde la clase de connection
        $sql = mysqli_query($connect, "SELECT * FROM cliente WHERE Correo='$email'");
      
        $query = mysqli_num_rows($sql);

       
        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Correo no existente "?>");
            </script>
            <?php
        }else{
            // generate token by binaryhexa 
            
             session_start ();
             $_SESSION['email'] = $email;
            require 'vendor/autoload.php';
 
            $mail = new PHPMailer;
             $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=465;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='ssl';
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            // h-hotel account
            $mail->Username='kevinhdezvaz@gmail.com';
            $mail->Password  = 'nbfuibvjxoxekdli';   
            // send by h-hotel email
            $mail->setFrom('kevinhdezvaz@gmail.com', 'Restablecer contraseña KERKLY');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recupera tu contraseña KERKLY";
            $mail->Body="<b>Querido Usuario</b>
            <h3>Recibimos una solicitud para restablecer su contraseña.</h3>
            <p>Haga clic en el siguiente enlace para restablecer su contraseña</p>
            <br>
            http://localhost/login-system2/reset_psw.php
            <br><br><br><br>
            
            <b>KERKLY</b>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo "CORREO INVALIDO "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("notification.html");
                    </script>
                <?php
            }
        }
        
    }


?>
