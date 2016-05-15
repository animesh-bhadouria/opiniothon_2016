<?php

/* Class EncriptionHelper which contains methods encryption and decryption
 * function encript :: Takes a string to encript, method of encription, password.
 * function decript :: Takes a string to encript, method of decription, password.
 * Default values : $method => aes128, $password =>'1234'
 *
 */

class EncriptionHelper
{
    
    public function encript($data, $method='aes128', $pass='2211')
    {
        return openssl_encrypt($data , $method , $pass);

    }


    public function decript($data, $method='aes128', $pass='2211')
    {
        return openssl_decrypt($data , $method , $pass);

    }

}


/* Uncomment Below lines to test EncriptionHelper

$str = "opiniothon";
echo "String = $str \n";

$encriptedStr = EncriptionHelper::encript($str);
echo "On Encryption : ".$encriptedStr."\n";

$decriptedStr = EncriptionHelper::decript($encriptedStr);
echo "On Decryption : ".$decriptedStr."\n";

   