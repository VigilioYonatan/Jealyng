<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class EmailClass
{
    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarToken()
    {
        //crear el objeto de email
        $mail = new PHPMailer();
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = '1236890@senati.pe';
        $mail->Password = 'Dokixd123';
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Port = 587;

        $mail->setFrom('1236890@senati.pe', 'jealyng SAC');

        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject  = 'Confirmar cuenta en Jealyng S.A.C';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "
                        <html>
                            <p>Hola <strong>$this->nombre</strong> Has creado tu cuenta en Jealync C.O,
                             Solo debes confirmarla presionando al siguiente enlace.</p>
                             <p>Click aquí para confirmar <a href='http://localhost:3000/confirmar-cuenta?token=$this->token'>Confirmar</a></p>
                             <p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>
                        </html>
                    ";

        $mail->Body = $contenido;

        //enviamos al email
        $mail->send();
    }
    public function RecuperarPassword()
    {
        //crear el objeto de email
        $mail = new PHPMailer();
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = '1236890@senati.pe';
        $mail->Password = 'Dokixd123';
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Port = 587;

        $mail->setFrom('1236890@senati.pe', 'jealyng SAC');

        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject  = 'Recuperar contraseña en Jealyng S.A.C';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "
                        <html>
                            <p>Hola <strong>$this->nombre</strong> Para recuperar tu contraseña.
                             Solo debes confirmarla presionando al siguiente enlace.</p>
                             <p>Click aquí para recuperar Contraseña <a href='http://localhost:3000/recuperar-cuenta?token=$this->token'>Confirmar</a></p>
                             <p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>
                        </html>
                    ";

        $mail->Body = $contenido;

        //enviamos al email
        $mail->send();
    }
    public function enviarFacura()
    {
        //crear el objeto de email
        $mail = new PHPMailer();
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = '1236890@senati.pe';
        $mail->Password = 'Dokixd123';
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Port = 587;

        $mail->setFrom('1236890@senati.pe', 'jealyng SAC');

        $mail->addAddress($this->email, $this->nombre);
        $pdf = "build/pdf/$this->token";
        $mail->AddAttachment($pdf, "facturaDePago$this->nombre.pdf");
        $mail->Subject  = 'Factura de compras de Jealyng S.A.C';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = "
                    <html>
                        <p>Hola <strong>$this->nombre</strong> Gracias por las compras de nuestros productos</p>
                        
                    </html>
                    ";

        $mail->Body = $contenido;


        //enviamos al email
        $mail->send();
        // unlink($pdf);
    }
}