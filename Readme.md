[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)]()
[![Packagist](https://img.shields.io/packagist/dm/sjrdco/housekeeping.svg)](https://packagist.org/packages/sjrdco/housekeeping)

## Housekeeping

![Housekeeping](http://sjrd.co/wp-content/uploads/2015/09/rondehoeken.png)

Housekeeping is an open-source library meant to provide your PHP project with basic functionalities. This way your project can be at its safest right from the start.

## Installation

Update your `composer.json` file to include this package as a dependency

    "sjrdco/housekeeping": "dev-master"

## Security usage

You can clean incoming data by calling the `cleanUp()` function.

    $cleaned_input = Housekeeping\Security::cleanUp($input);

You can encrypt input by calling the `encrypt()` method. This method returns an object containing the encrypted data, an initialization vector and the encryption key:
 
    $enc = Housekeeping\Security::encrypt($input);

You can also decrypt a string by calling the `decrypt()` method when a key an iv are available.

	$decrypted_input = Housekeeping\Security::decrypt($enc->encrypt, $enc->key, $enc->iv);

## Logging usage

You can log an action by calling the `logAction()` function. This function writes a log per entity. This means that it'll create a folder per day and this folder will contain logs for each entity.

    Housekeeping\Logging::logAction($message, $entity);

## License

Housekeeping is licensed under the MIT License, please see the LICENSE file. I don't personally require attribution, but if you ever see me just buy me a coffee!
