<?php
class PasswordHasher {
    public static function hash(string $password) : ?string {
        try{
            return password_hash(password:$password,algo:CRYPT_BLOWFISH);
        }catch(Exception|Error $e){}
        return null; 
    }

    public static function verify(string $password, string $hash) : bool {
        return password_verify(password:$password,hash:$hash);
    }
}
?>