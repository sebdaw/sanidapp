<?php
class SignUpMail extends Mailer{
    private int $id;
    private string $username;

    public function __construct(int $id, string $username){
        parent::__construct();
        $this->id = $id;     
        $this->username = $username;   
    }

    public function body() : string {
        $dao = new UsersDAO();
        $cipher = new Cipher;
        $user = $dao->findById($this->id);
        $user = (fn($n):?User=>$n)($user);
        $token = $cipher->encrypt($user->getId());
        $url = URL_BASE . PATH_ACTIVATION . "?token={$token}";
        $html = <<<EOT
            <p></p>¡Enhorabuena {$this->username}! has sido registrado en Sanidapp. Para poder iniciar sesión en la plataforma es necesario que active su usuario pulsando en el siguiente enlace:</p>
            <a href="{$url}">Activación usuario</a>
        EOT;
        return $html;
    }
}
?>