## Housekeeping

![Housekeeping](http://sjrd.co/wp-content/uploads/2015/09/rondehoeken.png)

Housekeeping is an open-source library meant to provide your PHP project with basic functionalities. This way your project can be at its safest right from the start.

## Installation

Update your `composer.json` file to include this package as a dependency

    "sjrdco/housekeeping": "dev-master"

## Security usage

You can clean incoming data by calling the `cleanUp()` function.

    $cleaned_input = Housekeeping\Security::cleanUp($input);

You can encrypt it by first creating an encryption key and then using that to encrypt the data.
 
    $encryption_key = Housekeeping\Security::generateKey();
    $encrypted_input = Housekeeping\Security::encrypt($input, $encryption_key);

You can also decrypt it by calling the `decrypt()` method together with that same encryption key.

	$decrypted_input = Housekeeping\Security::decrypt($input, $encryption_key);

## Logging usage

You can log an action by calling the `logAction()` function. This function writes a log per entity. This means that it'll create a folder per day and this folder will contain logs for each entity.

    Housekeeping\Logging::logAction($message, $entity);

## License

Housekeeping is licensed under the MIT License, please see the LICENSE file. I don't personally require attribution, but if you ever see me just buy me a coffee!