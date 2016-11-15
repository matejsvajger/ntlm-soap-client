# ntlm-soap-client

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

PHP WDSL/Soap Client with NTLM Authentication for Microsoft Dynamics NAT Server.

## Install

Via Composer

``` bash
$ composer require matejsvajger/ntlm-soap-client
```

## Usage

``` php
$url = 'URL_TO_WEBSERVICE';
$options = [
    'domain'   => 'domain',
    'username' => 'username',
    'password' => 'password'
];

$client = new matejsvajger/NTLMSoap/Client($url, $options);

$response = $client->ReadMultiple(['filter'=>[], 'setSize'=>1]);

foreach ($response->ReadMultiple_Result->CRMContactlist as $entity) {
    print_r($entity);
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@matejsvajger.com instead of using the issue tracker.

## Credits

- [Matej Svajger][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/matejsvajger/ntlm-soap-client.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/matejsvajger/ntlm-soap-client/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/matejsvajger/ntlm-soap-client.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/matejsvajger/ntlm-soap-client.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/matejsvajger/ntlm-soap-client.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/matejsvajger/ntlm-soap-client
[link-travis]: https://travis-ci.org/matejsvajger/ntlm-soap-client
[link-scrutinizer]: https://scrutinizer-ci.com/g/matejsvajger/ntlm-soap-client/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/matejsvajger/ntlm-soap-client
[link-downloads]: https://packagist.org/packages/matejsvajger/ntlm-soap-client
[link-author]: https://github.com/matejsvajger
[link-contributors]: ../../contributors
