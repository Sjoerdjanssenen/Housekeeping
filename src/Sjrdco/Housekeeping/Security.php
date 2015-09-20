<?php
namespace Sjrdco\Housekeeping;

class Security
{
	/**
     * Cleans and encrypts a given string 
     *
     * @param string $input
     * => The input that needs to be cleaned.
     *
     * @return string $output
     */
	public function cleanAndEncrypt($input) {
		$output = self::cleanUp($input);
		$output = self::encrypt($output);
		
		return $output;
	}

	/**
     * Cleans a given string 
     *
     * @param string $input
     * => The input that needs to be cleaned.
     *
     * @return string $output
     */
	public function cleanUp($input) {
		$input = trim($input);
		$output = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');;
		
		return $output;
	}
	
	/**
     * Encrypts a given string 
     *
     * @param string $input
     * => The input that needs to be encrypted.
     *
     * @return string $output
     */
	public function encrypt($input, $encryption_key) {
		$iv_size = 16; // 128 bits
		$iv = openssl_random_pseudo_bytes($iv_size, $strong);

		$name = 'Jack';
		$enc_name = openssl_encrypt(
		    pkcs7_pad($name, 16), // padded data
		    'AES-256-CBC',        // cipher and mode
		    $encryption_key,      // secret key
		    0,                    // options (not used)
		    $iv                   // initialisation vector
		);
	}
	
	/**
     * Decrypts a given string 
     *
     * @param string $input
     * => The input that needs to be decrypted.
     *
     * @return string $output
     */
	public function decrypt($input, $encryption_key) {
		$enc_name = $input['Name'];

		$iv = $input['IV'];

		$name = pkcs7_unpad(openssl_decrypt(
		    $enc_name,
		    'AES-256-CBC',
		    $encryption_key,
		    0,
		    $iv
		));
	}

	protected function pkcs7_pad($data, $size)
	{
	    $length = $size - strlen($data) % $size;
	    return $data . str_repeat(chr($length), $length);
	}

	protected function pkcs7_unpad($data)
	{
	    return substr($data, 0, -ord($data[strlen($data) - 1]));
	}

	/**
     * Hashes a given string 
     *
     * @param string $input
     * => The input that needs to be hashed.
     * @param string $salt
     * => The salt used for the hash.
     *
     * @return string $output
     */
	public function hash($input, $salt) {
		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        	return crypt($input, $salt);
    	}
	}

	/**
     * Checks a given string against the hash
     *
     * @param string $input
     * => The input that needs to be checked against the hash.
     * @param string $hash
     * => The stored hash of the string.
     *
     * @return string $output
     */
	public function checkAgainstHash($input, $hash) {
		return crypt($input, $hash) == $hash;
	}
	
	/**
     * Returns the salt for a given user
     *
     * @return string $output
     */
	public function generateSalt() {
		$salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
		
		return $salt;
	}

	/**
     * Generates a key for encryption
     *
     * @return string $output
     */
	public function generateKey() {
		$key_size = 32; // 256 bits
		return openssl_random_pseudo_bytes($key_size, $strong);
	}
}