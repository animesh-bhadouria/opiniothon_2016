<?php

/* Class EncriptionHelper which contains methods encryption and decryption
 * function encript :: Takes a string to encript, method of encription, password.
 * function decript :: Takes a string to encript, method of decription, password.
 * Default values : $method => aes128, $password =>'1234'
 *
 */

class EncriptionHelper
{
    
    public function encript($data, $method='aes128', $pass='1234')
    {
        return openssl_encrypt($cust , 'aes128' , '1234');

    }


    public function decript($data, $method='aes128', $pass='1234')
    {
        return openssl_decrypt($cust , 'aes128' , '1234');

    }
   