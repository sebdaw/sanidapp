<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

abstract class Mailer{
    const TIMEOUT = 20; // 20 segundos, por defecto eran 5 min
    const DEBUG_MODES = [
        'off'=>SMTP::DEBUG_OFF,
        'client'=>SMTP::DEBUG_CLIENT,
        'server'=>SMTP::DEBUG_SERVER,
        'connection'=>SMTP::DEBUG_CONNECTION,
        'all'=>SMTP::DEBUG_LOWLEVEL];
    const MESSAGE_TYPES = [
        'html'=>true,
        'txt'=>false
        ];
    const DEBUG_OUTPUTS = [
        'error_log' => 'error_log',
        'html' => 'html',
        'echo' => 'echo'
        ];
    const SMTP_SECURE_ENCRYPTIONS = [
        'none' => '',
        'ssl' => 'ssl',
        'tls' => 'tls'
        ];
    const SMTP_CONTEXT_OPTIONS = [
        'ssl' => [
            'verify_peer' => false, // Requerimiento de verificación de uso de certificado SSL
            'verify_peer_name' => false, // Requerimiento de verificación de nombre remoto
            'allow_self_signed' => true // Permiso de autofirmar certificados
        ]
        ];
    
    const CHARSET = 'UTF-8';
    const SMTP_AUTH = true; //TODO: cambiar a true
    const SMTP_KEEP_ALIVE = true;
    const HOST = EMAIL_HOST;
    const PORT = EMAIL_PORT;
    
    protected int $debugMode = self::DEBUG_MODES[EMAIL_DEBUG_MODE];
    protected bool $messageType = self::MESSAGE_TYPES[EMAIL_MESSAGE_TYPES];
    protected string $debugOutput = self::DEBUG_OUTPUTS[EMAIL_DEBUG_OUTPUTS];
    protected string $smtpSecure = self::SMTP_SECURE_ENCRYPTIONS[EMAIL_SMTP_SECURE];
    protected string $subject = '';
    protected string $smtpUsername = EMAIL_USER_SMTP; 
    protected string $smtpPassword = EMAIL_PASSWORD_SMTP; 
    protected array $to = [];
    protected array $cco = [];
    protected array $reply = [['address'=>EMAIL_REPLY,'name'=>'Sanidapp']]; 
    protected array $from = ['address'=>EMAIL_USER_SMTP,'title'=>'Sanidapp']; //TODO: añadir remitente por defecto
    protected array $attachments = [];

    protected ?PHPMailer $phpmailer = null;



    public function __construct(){
        $this->phpmailer = new PHPMailer();
        $this->initConfiguration();
    }

    public function setSubject(string $subject) {
        $this->subject = $subject;
    }

    final public function setSmtpSecureEncryption(string $encryption) {
        if (in_array(mb_strtolower($encryption),array_keys(self::SMTP_SECURE_ENCRYPTIONS))){
            $this->smtpSecure = mb_strtolower($encryption);
            $this->phpmailer->SMTPSecure = $this->smtpSecure;
        }
    }

    final public function setDebugOutput(string $output) {
        if (in_array(mb_strtolower($output),array_values(self::DEBUG_OUTPUTS))){
            $this->debugOutput = mb_strtolower($output);
            $this->phpmailer->Debugoutput = $this->debugOutput;
        }
    }

    final public function setMessageType(string $type) {
        if (in_array(mb_strtolower($type),array_values(self::MESSAGE_TYPES))){
            $this->messageType = mb_strtolower($type);
            $this->phpmailer->isHTML($this->messageType);
        }
    }

    final public function setSmtpCredentials(string $address, string $password) {
        if (trim($address)!=''){
            $this->smtpUsername = mb_strtolower(trim($address));
            $this->smtpPassword = $password;
            $this->phpmailer->Username = $this->smtpUsername;
            $this->phpmailer->Password = $this->smtpPassword;
        }
    }

    final public function setReadReceipt(bool $enabled, string $address='') {
        $this->phpmailer->ConfirmReadingTo = $enabled? mb_strtolower($address) : '';
    }

    final protected function initConfiguration(){
        $this->phpmailer->isSMTP();
        $this->phpmailer->SMTPOptions = static::SMTP_CONTEXT_OPTIONS;
        $this->phpmailer->SMTPAuth = static::SMTP_AUTH;
        $this->phpmailer->SMTPKeepAlive = static::SMTP_KEEP_ALIVE;
        $this->phpmailer->CharSet = static::CHARSET;
        $this->phpmailer->Host = static::HOST;
        $this->phpmailer->Port = static::PORT;
        $this->phpmailer->Timeout = static::TIMEOUT;
        $this->setSmtpSecureEncryption($this->smtpSecure);
        $this->setDebugOutput($this->debugOutput);
        $this->setMessageType($this->messageType);
        $this->setSmtpCredentials($this->smtpUsername,$this->smtpPassword);
    }

    final public function setFrom(string $address, string $title=''){
        $this->from['address'] = mb_strtolower($address);
        $this->from['title'] = $title;
    }

    final public function addTo(string $address, string $name='') {
        $this->to[] = [
            'address' => mb_strtolower($address),
            'name' => $name
        ];
    }

    final public function addCCO(string $address, string $name='') {
        $this->cco[] = [
            'address' => mb_strtolower($address),
            'name' => $name
        ];
    }

    final public function addReplyTo(string $address, string $name='') {
        $this->reply[] = [
            'address' => mb_strtolower($address),
            'name' => $name
        ];
    }

    final public function addAttachment(string $path, string $name='') {
        if (trim($path)!='')
            $this->attachments[] = [
                'path' => trim($path),
                'name' => $name
            ];
    }

    protected function head() : string{
        return '';
    }

    abstract protected function body() : string;

    final public function send() : bool {
        if ($this->from=='' || empty($this->to))
            return false;

        $sent = true;
        try {
            $head = $this->head();
            $body = $this->body();
            $html = "<html><head>{$head}</head><body>{$body}</body></html>";

            if ($this->messageType==self::MESSAGE_TYPES['html'])
                $this->phpmailer->msgHTML($html);

            foreach($this->to as $destination)
                $this->phpmailer->addAddress($destination['address'],$destination['name']);
            foreach($this->reply as $destination)
                $this->phpmailer->addReplyTo($destination['address'],$destination['name']);
            foreach($this->cco as $destination)
                $this->phpmailer->addBCC($destination['address'],$destination['name']);
            foreach($this->attachments as $attachment)
                $this->phpmailer->addAttachment(path:$attachment['path'],name:$attachment['name']);

            $this->phpmailer->setFrom($this->from['address'],$this->from['title']);
            $this->phpmailer->Subject = $this->subject;
            $sent = $this->phpmailer->send();
            $this->phpmailer->clearAllRecipients();
            $this->phpmailer->clearAttachments();
            $this->phpmailer->smtpClose();
        }catch(Exception | Error $e){
            $sent = false;
        }
        return $sent;
    }
}

?>