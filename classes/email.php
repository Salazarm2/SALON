<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
     $this->email = $email;
     $this->nombre = $nombre;
     $this->token = $token;   
    }

    public function enviarEmail() {
        // crear objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'bbf287d73c53a6';
        $mail->Password = '9e0587560e7a3c';      
        $mail->setFrom('cuentas@salon.com');
        $mail->addAddress('cuentas@salon.com', 'salon.com');
        $mail->Subject ='Confirmar Tu Cuenta';

        // activamos el HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->email . "</strong> Has creado tu cuenta en Salon.com, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona Aqui: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitastes esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        // enviamos el email
        $mail->send();
    }

    public function enviarInstrucciones() {
        // crear objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'bbf287d73c53a6';
        $mail->Password = '9e0587560e7a3c';      
        $mail->setFrom('cuentas@salon.com');
        $mail->addAddress('cuentas@salon.com', 'salon.com');
        $mail->Subject ='Reestablecer Password';

        // activamos el HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona Aqui: <a href='http://localhost:3000/recuperar?token=". $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitastes esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        // enviamos el email
        $mail->send();
 
    }

}