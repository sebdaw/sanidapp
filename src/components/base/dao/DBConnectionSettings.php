<?php
class DBConnectionSettings {
    private string $dbms;
    private string $host;
    private int $port;
    private ?string $dbname = null;
    private string $charset;
    private string $username;
    private ?string $password = null;

    public function __construct(string $_dbms=DBMS,
                                string $_host=HOST,
                                int $_port=PORT,
                                ?string $_dbname=DBNAME,
                                string $_charset=DBCHARSET,
                                string $_username=DBUSER,
                                ?string $_password=DBPASS){
        $this->setDbms($_dbms);
        $this->setHost($_host);
        $this->setPort($_port);
        $this->setDbname($_dbname);
        $this->setCharset($_charset);
        $this->setUsername($_username);
        $this->setPassword($_password);
    }

    public function getDbms() : string {
        return $this->dbms;
    }

    public function setDbms(string $dbms) : void {
        $this->dbms = $dbms;
    }

    public function getHost() : string {
        return $this->host;
    }

    public function setHost(string $host) : void {
        $this->host = $host;
    }

    public function getPort() : int {
        return $this->port;
    }

    public function setPort(int $port) : void {
        $this->port = $port;
    }

    public function getDbname() : ?string {
        return $this->dbname;
    }

    public function setDbname(?string $dbname) : void {
        $this->dbname = $dbname;
    }

    public function getCharset() : string {
        return $this->charset;
    }

    public function setCharset(string $charset) : void {
        $this->charset = $charset;
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function setUsername(string $username) : void {
        $this->username = $username;
    }

    public function getPassword() : ?string {
        return $this->password;
    }

    public function setPassword(?string $password) : void {
        $this->password = $password;
    }

    public function getDsn() : ?string {
        $dsn = null;
        switch (mb_strtolower($this->dbms)){
        case 'mysql':
            $dsn = $this->dbms . ":host=" . $this->host . ";port=" . $this->port . ";charset=" . $this->charset;
            $dsn .= ($this->dbname!=null)? ";dbname=" . $this->dbname : null;
            break;        
        }
        return $dsn;
    }
}
?>