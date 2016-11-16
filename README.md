# ntlm-soap-client

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
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
$config = new matejsvajger/NTLMSoap/Common/NTLMConfig([
    'domain'   => 'domain',
    'username' => 'username',
    'password' => 'password'
]);

$client = new matejsvajger/NTLMSoap/Client($url, $config);

$response = $client->ReadMultiple(['filter'=>[], 'setSize'=>1]);

foreach ($response->ReadMultiple_Result->CRMContactlist as $entity) {
    print_r($entity);
}
```
__NOTE:__ NTLM Authentication string looks like `<domain>/<username>:<password>`. _All three config items are required._

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
[ico-downloads]: https://img.shields.io/packagist/dt/matejsvajger/ntlm-soap-client.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/matejsvajger/ntlm-soap-client
[link-downloads]: https://packagist.org/packages/matejsvajger/ntlm-soap-client
[link-author]: https://github.com/matejsvajger
[link-contributors]: ../../contributors
