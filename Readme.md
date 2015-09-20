## Housekeeping

![Housekeeping] (http://sjrd.co/wp-content/uploads/2015/09/rondehoeken.png)

![Housekeeping] (https://camo.githubusercontent.com/13cd6b6c5d66caae7dd9ac2efc336842beb6f9a1/687474703a2f2f696d672e736869656c64732e696f2f7472617669732f54696d4f6c697665722f544f57656256696577436f6e74726f6c6c65722e7376673f7374796c653d666c6174)
![Housekeeping] (https://camo.githubusercontent.com/558fbed32469ad670d137f7396d776d0963899c6/68747470733a2f2f696d672e736869656c64732e696f2f636f636f61706f64732f6c2f544f57656256696577436f6e74726f6c6c65722e7376673f7374796c653d666c6174)
![Housekeeping] (https://camo.githubusercontent.com/60b0f4df412722ff78c36cb4d88af164a20ac16d/68747470733a2f2f696d672e736869656c64732e696f2f636f636f61706f64732f702f544f57656256696577436f6e74726f6c6c65722e7376673f7374796c653d666c6174)

Housekeeping is an open-source library meant to provide your PHP project with basic functionalities. This way your project can be at its safest right from the start.

## Installation

Update your composer.json file to include this package as a dependency

    "sjrdco/housekeeping": "dev-master"

## Usage

You can encrypt **and** clean incoming data by calling the `cleanAndEncrypt` function.

    $encrypted_input = Housekeeping\Security::cleanAndEncrypt($input);

## License

Housekeeping is licensed under the MIT License, please see the LICENSE file. I don't personally require attribution, but if you ever see me just buy me a coffee!