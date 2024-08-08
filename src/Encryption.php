<?php

namespace Smark\Smark;

class Encryption
{
    public static function encrypter($data, $key) {
        $cipher = "aes-256-cbc"; // Encryption method
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher)); // Generate a random initialization vector (IV)

        // Encrypt the data
        $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);

        // Combine the IV and encrypted data for storage
        $encrypted = base64_encode($iv . $encrypted);

        return $encrypted;
    }

    public static function decrypter($data, $key) {
        $cipher = "aes-256-cbc"; // Encryption method

        // Base64 decode the encrypted data
        $data = base64_decode($data);

        // Extract the IV and encrypted data
        $iv_length = openssl_cipher_iv_length($cipher);
        $iv = substr($data, 0, $iv_length);
        $encrypted = substr($data, $iv_length);

        // Decrypt the data
        $decrypted = openssl_decrypt($encrypted, $cipher, $key, 0, $iv);

        return $decrypted;
    }

}
