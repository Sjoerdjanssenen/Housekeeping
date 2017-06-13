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
     * Encodes a given string 
     *
     * @param string $input
     * => The input that needs to be encoded.
     *
     * @return string $output
     */
	public function encode($input) {
		return base64_encode($input);
	}
	
	/**
     * Decodes a given string 
     *
     * @param string $input
     * => The input that needs to be decoded.
     *
     * @return string $output
     */
	public function decode($input) {
		return base64_decode($input);
	}
	
	/**
     * Encrypts a given string 
     *
     * @param string $input
     * => The input that needs to be encrypted.
     * @param string $base64
     * => Is the text BINARYVAR/BINDARY/VARCHAR?, leave empty if not sure
     *
     * @return object $_enc
     */

	public static function encrypt($text, $base64 = false)
	{
		$_enc 			= new StdClass();
		$_enc->key 		= self::GenerateKey();
		$_enc->iv 		= self::GenerateIV($base64);
		$_enc->encrypt 	= openssl_encrypt
		( 
			self::Pkcs7Pad($text, 16), 	// pad data 
			'AES-256-CBC', 				// cipher and mode 
			$_enc->key,					// secret key 
			0, 							// options (not used) 
			$_enc->iv 					// initialisation vector 
		);
        
        return $_enc;
	}

	/**
     * Decrypts a given string 
     *
     * @param string $text
     * => The input that needs to be decrypted.
     * @param string $key
     * => The key that was used to encrypt the string.
     * @param string $iv
     * => The initialization vector that was used to encrypt the string.
     *
     * @return string $output
     */
	public static function deCrypt($text, $key, $iv, $base64 = false)
	{
		/* 
		 * user base64_decode or hex2bin depending on column type BINARYVAR/BINDARY/VARCHAR
		 */

		if($key)
        {
            return self::Pkcs7Unpad( openssl_decrypt
			(
				$base64 ? base64_decode($text) : $text,
				'AES-256-CBC',
				$key,
				0,
				$base64 ? base64_decode($iv) : $iv
			));

            return null;
        }
	}

	/**
	 * Generates a key for encryption. Returns a binary blob generated from a reliable pseudo random number generator (OpenSSL)
	 *
	 * @return string $output
	 */
	public static function GenerateKey()
	{
		$key_size = 32; // 256 bits
		return openssl_random_pseudo_bytes($key_size, $strong);
	}

	/*
	 * Returns an Initialization Vector (extra randomness for the encryption)
	 * The i.v. should be regenerated and restored after modifying a model
	 */
	private static function GenerateIV($base64 = false)
	{
		$iv_size = 16; // 128 bits
		$iv = openssl_random_pseudo_bytes($iv_size, $strong) ;
		
		/* 
		 * return a (non) base64 encoded iv.
		 * set $base64 to true when de iv database column is BINARY or VARBINARY
		 */
		return $base64 ? base64_encode($iv) : $iv;
	}

	/* 
	 * Pad data to blocksize
	 * More info: 
	 * http://www.di-mgt.com.au/cryptopad.html#whatispadding
	 * https://www.w3schools.com/php/func_string_str_pad.asp
	 */
	private static function Pkcs7Pad($data, $size) 
	{ 
		$length = $size - strlen($data) % $size; 
		return $data . str_repeat(chr($length), $length); 
	}

	private static function Pkcs7Unpad($data)
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
}