<?php
class Cipher {
    private string $key;
    private string $nonce;

    public function __construct(string $key=CYPHER_KEY, string $nonce=CYPHER_NONCE){
        $this->key = $key;
        $this->nonce = $nonce;
    }

    public function encrypt(string $text) : ?string {
        try {
            $raw_nonce = sodium_base642bin($this->nonce,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            $raw_key = sodium_base642bin($this->key,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            $bytes = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(message:$text,additional_data:'',nonce:$raw_nonce,key:$raw_key);
            $ciphertext = sodium_bin2base64($bytes,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
        }catch (Exception | Error $e){
            $ciphertext = null;
        }
        return $ciphertext;
    }

    public function decrypt(string $ciphertext) : ?string {
        try {
            $raw_nonce = sodium_base642bin($this->nonce,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            $raw_key = sodium_base642bin($this->key,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            $bytes = sodium_base642bin($ciphertext,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            $text = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(ciphertext:$bytes,additional_data:'',nonce:$raw_nonce,key:$raw_key);
        }catch(Exception | Error $e){
            $text = null;
        }
        return $text;
    }

    public static function keygen() : string {
        $bytes = sodium_crypto_aead_xchacha20poly1305_ietf_keygen();
        return sodium_bin2base64($bytes,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
    }

    public static function nonce() : string {
        $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
        return sodium_bin2base64($nonce,SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
    }
}
?>