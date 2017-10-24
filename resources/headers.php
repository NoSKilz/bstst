<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_lifetime', 0); 
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.hash_function', 'whirlpool');
ini_set('session.use_only_cookies', 1);
ini_set('session.hash_bits_per_character', 5);
//ini_set('session.cookie_secure', 1); // https
ini_set('session.entropy_length', 512);
ini_set('session.use_trans_sid', 0);
ini_set('expose_php', 0);
session_name('sid');

session_start();
global $nonce,$nonce_value;
if (function_exists('random_bytes')) 
{
    $nonce_value=random_bytes(32);
}
else if (function_exists('mcrypt_create_iv')) 
{
    $nonce_value=mcrypt_create_iv(32, MCRYPT_DEV_URANDOM);
} 
else if (function_exists('openssl_random_pseudo_bytes')) 
{
    $nonce_value=openssl_random_pseudo_bytes(32);
}
else
{
    $nonce_value=rand(1,99999);
}    
$nonce = base64_encode($nonce_value);
header("Content-Security-Policy: script-src 'strict-dynamic' 'nonce-$nonce' 'self'; object-src 'none'; report-uri https://csp.example.com;");
header('X-frame-Options: SAMEORIGIN');
header('Referrer-Policy: no-referrer');
header('X-frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
// header('strict-transport-security: max-age=31536000; includeSubDomains'); // https