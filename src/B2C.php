<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 4/29/19
 * Time: 6:49 PM
 */

namespace Manuelgeek\MpesaB2C;


class B2C
{
    /**
     * @param $authUrl
     * @return mixed
     */
    public $authUrl;
    /**
     * @param $b2cUrl
     * @return mixed
     */
    protected $b2cUrl;
    /**
     * @param $publicKey
     * @return mixed
     */
    public $publicKey;
    /**
     * @param $ConsumerSecret
     * @return mixed
     */
    protected $ConsumerSecret;

    /**
     * @param $ConsumerKey
     * @return mixed
     */
    protected $ConsumerKey;


    /**
     * @param $InitiatorName
     * @return mixed
     */
    public $InitiatorName;

    /**
     * @param $InitiatorPassword
     * @return mixed
     */
    public $InitiatorPassword;

    /**
     * @param $default_header
     * @return mixed
     */
    public $default_header = [
        'Content-Type: application/json'
    ];

    /**
     * @param $access_token
     * @return mixed
     */
    public $access_token;
    ////securityCred
    public  $SecurityCredentials;
    private $PartyA;
    public $QueueTimeOutURL;
    public $ResultURL;

    /**
     * C2B constructor.
     */
    public function __construct ()
    {
        // $this->setAccessToken();
        $this->setInitiatorName($this->getInitiatorName());
        $this->setInitiatorPassword($this->getInitiatorPassword());
        $this->setConsumerKey($this->getConsumerKey());
        $this->setConsumerSecret($this->getConsumerSecret());
        $this->setAuthUrl($this->getAuthUrl());
        $this->setB2cUrl($this->getB2cUrl());
        $this->setPartyA($this->getPartyA());
        $this->setQueueTimeOutURL($this->getQueueTimeOutURL());
        $this->setResultURL($this->getResultURL());


    }

    /**
     * @return mixed
     */
    public function getResultURL ()
    {
        return \config('mpesa_b2c.ResultURL');
    }

    /**
     * @param mixed $ResultURL
     */
    public function setResultURL ($ResultURL)
    {
        return $this->ResultURL = $ResultURL;
    }

    /**
     * @return mixed
     */
    public function getQueueTimeOutURL ()
    {
        return \config('mpesa_b2c.QueueTimeOutURL');
    }

    /**
     * @param mixed $QueueTimeOutURL
     */
    public function setQueueTimeOutURL ($QueueTimeOutURL)
    {
        $this->QueueTimeOutURL = $QueueTimeOutURL;
    }

    /**
     * @return mixed
     */
    public function getPartyA ()
    {
        return \Config::get('mpesa_b2c.B2cShortCode');
    }

    /**
     * @param mixed $PartyA
     * @return B2C
     */
    public function setPartyA ($PartyA)
    {
        $this->PartyA = $PartyA;
        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultHeader ()
    {
        $this->setAccessToken();

        $header = $this->default_header;
        $header[] = 'Authorization: Bearer ' . $this->access_token;
        return $header;
    }
    /**
     * @param $data
     * @return mixed
     */
    public function sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks)
    {
//Business To Customer

        $SecurityCredential=$this->setSecurityCredentials ();
//        dd($SecurityCredential);
        $QueueTimeOutURL = $this->QueueTimeOutURL;
        $data = [];
        $Occasion='';
        $data['InitiatorName'] =$this->InitiatorName;
        $data['CommandID'] =$CommandID;
        $data['SecurityCredential']=$SecurityCredential;
        $data['QueueTimeOutURL'] = $QueueTimeOutURL;
        $data['ResultURL'] = $this->ResultURL;
        $data['Amount'] = $Amount;
        $data['PartyA'] = $this->PartyA;//Organization /MSISDN sending the transaction
        $data['PartyB'] = $PartyB;//MSISDN sending the transaction number MSISD without the plus sign
        $data['Remarks'] = $Remarks;
        $data['Occasion'] = $Occasion;

        $url = $this->b2cUrl;
        $header = $this->getDefaultHeader();

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($curl);


        return $response;


    }


    /**
     * @param mixed $access_token
     * @return
     */
    public function setAccessToken ()
    {
        $url = $this->authUrl;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode("$this->ConsumerKey:$this->ConsumerSecret");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'Authorization: Basic ' . $credentials )); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response = json_decode(curl_exec($curl),true);
        //return $curl_response;

        return $this->access_token = $curl_response['access_token'];




    }

    /**
     * @param mixed $InitiatorName
     */
    public function setInitiatorName ($InitiatorName)
    {
        $this->InitiatorName = $InitiatorName;
    }

    /**
     * @return mixed
     */
    public function getInitiatorName ()
    {
        return Config("mpesa_b2c.InitiatorName");
    }


    /**
     * @param mixed $InitiatorPassword
     */
    public function setInitiatorPassword ($InitiatorPassword)
    {
        $this->InitiatorPassword = $InitiatorPassword;
    }

    /**
     * @return mixed
     */
    public function getInitiatorPassword ()
    {
        return Config("mpesa_b2c.InitiatorPassword");
    }

    /**
     * @return mixed
     */
    public function getConsumerKey ()
    {
        return Config("mpesa_b2c.B2cConsumerKey");
    }

    /**
     * @param mixed $ConsumerKey
     */
    public function setConsumerKey ($ConsumerKey)
    {
        $this->ConsumerKey = $ConsumerKey;
    }

    /**
     * @return mixed
     */
    public function getConsumerSecret ()
    {
        return Config("mpesa_b2c.B2cConsumerSecret");
    }

    /**
     * @param mixed $ConsumerSecret
     */
    public function setConsumerSecret ($ConsumerSecret)
    {
        $this->ConsumerSecret = $ConsumerSecret;
    }

    /**
     * @return mixed
     */
    public function getAuthUrl ()
    {

        return Config('mpesa_b2c.is_live') == false ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials' : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
//        return $this->authUrl;
    }

    /**
     * @param mixed $authUrl
     */
    public function setAuthUrl ($authUrl)
    {
        $this->authUrl = $authUrl;
    }

    /**
     * @return mixed
     */
    public function getB2cUrl ()
    {
        return Config('mpesa_b2c.is_live') == true ? 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest' : 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
        // return $this->b2cUrl;
    }

    /**
     * @param mixed $b2cUrl
     */
    public function setB2cUrl ($b2cUrl)
    {
        $this->b2cUrl = $b2cUrl;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function setSecurityCredentials ()
    {
        // $publicKey = "PATH_TO_CERTICATE";
        $publicKey =  __DIR__ . '/Cert/cert.cer';
        if(\is_file($publicKey)){
            $pubKey = file_get_contents($publicKey);
        }else{
            throw new \Exception("Please provide a valid public key file");
        }
        //$plaintext = "Safaricom132!";
        $plaintext =$this->InitiatorPassword;

        openssl_public_encrypt($plaintext, $encrypted, $pubKey, OPENSSL_PKCS1_PADDING);

        return $this->SecurityCredentials=base64_encode($encrypted);
    }
}

