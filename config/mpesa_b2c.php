<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 4/29/19
 * Time: 6:40 PM
 */
return [
    /** @is_live true/false */
    "is_live"=>false,

    /** InitiatorName */
    "InitiatorName"=>"testapi",

    /** InitiatorPassword */
    "InitiatorPassword"=>"Safaricom187!",

    /** B2cShortCode */
    'B2cShortCode'=>"600187",

    /** B2cConsumerKey */
    'B2cConsumerKey'=>'EspZfFZEdvTPlhGG4VePjf238I7RXUAq',

    /** B2cConsumerSecret */
    'B2cConsumerSecret'=>'YNA0NAcAuIfkFfRx',

    /***
    This is the callback URL used to send an error callback when the transaction was not able to be processed by M-Pesa within a stipulated time period. ***/
    "QueueTimeOutURL" => "http://a266e9d6.ngrok.io/mpesa/receive",

    /*** This is the callback URL where the results of the transaction will be sent */
    "ResultURL"=>"http://a266e9d6.ngrok.io/mpesa/receive"

];
