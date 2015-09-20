## Housekeeping

![Housekeeping](http://sjrd.co/wp-content/uploads/2015/09/rondehoeken.png)

Housekeeping is an open-source library meant to provide your PHP project with basic functionalities. This way your project can be at its safest right from the start.

## Installation

Update your composer.json file to include this package as a dependency

    "sjrdco/housekeeping": "dev-master"

## Usage

You can encrypt **and** clean incoming data by calling the `cleanAndEncrypt` function.

    $encrypted_input = Housekeeping\Security::cleanAndEncrypt($input);

## License

Housekeeping is licensed under the MIT License, please see the LICENSE file. I don't personally require attribution, but if you ever see me just buy me a coffee!