<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('/src/PHPMailer.php');
require_once('/src/SMTP.php');
require_once('/src/Exception.php');

class UserServices{

    private $name;
    private $fieldOfActivity;
    private $location;
    private $userRole;
    private $email;
    private $password;

    public function signIn($name, $fieldOfActivity, $location, $userRole, $password, $email){
        global $pdo;

        $this->name = $name;
        $this->fieldOfActivity = $fieldOfActivity;
        $this->location = $location;

        $this->userRole = $userRole;
        $this->email = $email;
        $this->password = $password;

        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO empresas(nome, id_ramo_atuacao, localizacao) VALUES(?,?,?)");
        $companySignedUp = $stmt->execute([$this->name, $this->fieldOfActivity, $this->location]);

        if($companySignedUp){
            $stmt = $pdo->prepare("INSERT INTO usuarios(id_tipo_usuario, senha, email) VALUES(?,?,?)");
            $userSignedUp = $stmt->execute([$this->userRole, $hash, $this->email]);
        }
        if($userSignedUp){
            
            //altere o exemplo@gmail.com pelo email que envia mensagem e a passe pela sua senha original do gamil;

            $mail = new PHPMailer(true);

            try {

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'exemplo@gmail.com';
                $mail->Password = '1234'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;


                $mail->setFrom('exemplo@gmail.com');
                $mail->addAddress($this->email);

                $mail->isHTML(true);
                $mail->Subject = 'Credenciais de Acesso - Stagely';
                $mail->Body = '
                    <p>Olá <strong>' . htmlspecialchars($this->name) . '</strong>,</p>
                    <p>Seu cadastro foi realizado com sucesso.</p>
                    <p>Aqui estão suas credenciais de acesso:</p>
                    <p><strong>Email:</strong> ' . htmlspecialchars($this->email) . '<br>
                    <strong>Senha:</strong> ' . htmlspecialchars($this->password) . '</p>
                    <p><em>Não compartilhe estas informações com ninguém.</em></p>
                ';

                if($mail->send()){
                    return ['success'=>true, 'message'=>'Usuário cadastrado e email enviado com sucesso!'];
                }
            }catch (Exception $e){
                return ['success'=>false, 'message'=>"Usuário cadastrado, mas email não enviado {$mail->ErrorInfo}."];
            }
        }
        return ['success'=>false, 'message'=>'Erro ao cadastrar usuário, tente novamente!'];
    }
}