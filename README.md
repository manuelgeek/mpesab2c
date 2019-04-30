# Laravel MpesaB2C

[![Latest Stable Version](https://poser.pugx.org/manuelgeek/mpesab2c/v/stable)](https://packagist.org/packages/manuelgeek/mpesab2c)
[![Total Downloads](https://poser.pugx.org/manuelgeek/mpesab2c/downloads)](https://packagist.org/packages/manuelgeek/mpesab2c)
[![Latest Unstable Version](https://poser.pugx.org/manuelgeek/mpesab2c/v/unstable)](https://packagist.org/packages/manuelgeek/mpesab2c)
[![License](https://poser.pugx.org/manuelgeek/mpesab2c/license)](https://packagist.org/packages/manuelgeek/mpesab2c)

Safaricom's Mpesa Daraja API B2C implementation

## Getting Started

Read on the Daraja B2C documentation to get to understand more on this implementation.

### Installing

```
composer require manuelgeek/mpesab2c
```

## Laravel 5 and above

This package supports the auto-discovery feature of Laravel 5.5 and above, So skip these Setup instructions if you're using Laravel 5.5 and above.

In `app/config/app.php` add the following :

1- The ServiceProvider to the providers array :

```
Manuelgeek\MpesaB2C\MpesaServiceProvider::class,
```
2- The class alias to the aliases array :

```
'B2C' => Manuelgeek\MpesaB2C\Facades\B2C::class,
```
3- Publish the config file

```
php artisan vendor:publish --provider="Manuelgeek\MpesaB2C\MpesaServiceProvider"
```

There will now be a new mpesa_b2c.php file in your config directory that is at the root of your project. All the configuration options are present in the file. Also remember to set the QueueTimeOutURL and ResultURL endpoints w. E.g.

```
"QueueTimeOutURL" => "http:example.com/mpesa/receive",

"ResultURL" => "http://example.com/mpesa/receive"
```
## Usage

### Mpesa B2C Laravel

```
    $Amount ='300';
    $CommandID = 'BusinessPayment';
    $PartyB = '254708374149';
    $Remarks = 'Payed well';

    //Using the Facade
    $response = \B2C::sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks);
    
    //or the function
    $response = sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks);
```

### Without Laravel

Example

```
<?php

    require_once "vendor/autoload.php";

    $Amount ='300';
    $CommandID = 'BusinessPayment';
    $PartyB = '254708374149';
    $Remarks = 'Payed well';
    
    $mpesa = new \Manuelgeek\MpesaB2C\B2C();
    
    $response = $mpesa->sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks);

?>
```

## Contributing

[https://github.com/manuelgeek/mpesab2c/pulls](https://github.com/manuelgeek/mpesab2c/pulls) 

## Authors

* **Magak Emmanuel** -  [Manuelgeek](https://github.com/manuelgeek)
<p>

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments
[<img width=200 src="https://appslab.co.ke/images/logo.png">](https://appslab.co.ke) 

