
![](https://raw.githubusercontent.com/edwinmugendi/sapamapay/master/img/sapamaerp.jpg)

[![Build Status](https://img.shields.io/travis/dingo/api/master.svg?style=flat-square)](https://travis-ci.org/dingo/api)
[![License](https://img.shields.io/packagist/l/dingo/api.svg?style=flat-square)](LICENSE)

## SapamaPay API
This library is an API wrapper to the following [Safaricom MPESA API's](https://developer.safaricom.co.ke/)

- [Lipa Na M-Pesa Online Payment API](https://developer.safaricom.co.ke/lipa-na-m-pesa-online/apis/post/stkpush/v1/processrequest)
- [Lipa Na M-Pesa Query Request API](https://developer.safaricom.co.ke/lipa-na-m-pesa-online/apis/post/stkpushquery/v1/query)
- [Account Balance Request](https://developer.safaricom.co.ke/account-balance/apis/post/query)
- [B2B Payment Request](https://developer.safaricom.co.ke/b2b/apis/post/paymentrequest)
- [B2C Payment Request](https://developer.safaricom.co.ke/b2c/apis/post/paymentrequest)
- [Transaction Status Request](https://developer.safaricom.co.ke/transaction-status/apis/post/query)
- [C2B Simulate Transaction](https://developer.safaricom.co.ke/c2b/apis/post/simulate)
- [C2B Register URL](https://developer.safaricom.co.ke/c2b/apis/post/registerurl)
- [Reversal](https://developer.safaricom.co.ke/reversal/apis/post/request)
- [Generate Token](https://developer.safaricom.co.ke/oauth/apis)

## Installation

### Requirements

PHP >=4.0.2

Add `edwinmugendi/sapamapay` to `composer.json`.
```
"edwinmugendi/sapamapay": "dev-master"
```

Run `composer update` to pull down the latest version.

Or run
```
composer require edwinmugendi/sapamapay
```
Without composer. Download the source code and `require_once` the `autoload.php`

```
require_once __DIR__ . '/../vendor/autoload.php';
```
## Testing
Update the `$api` variable to the API you want to run. 

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Edwinmugendi\Sapamapay\MpesaApi;

$mpesa_api = new MpesaApi();
$configs = array(
    'AccessToken' => 'ACCESSTOKEN',
    'Environment' => 'sandbox',
    'Content-Type' => 'application/json',
    'Verbose' => 'true',
);

$api = 'generate_token';

if ($api == 'stk_push') {
    $parameters = array(
        'BusinessShortCode' => '603013',
        'Password' => 'TkNZpjhQ',
        'Timestamp' => '20171010101010',
        'TransactionType' => 'TransactionType',
        'Amount' => '10',
        'PartyA' => '254708374149',
        'PartyB' => '603013',
        'PhoneNumber' => '254708374149',
        'CallBackURL' => 'https://url',
        'AccountReference' => '1232',
        'TransactionDesc' => 'TESTING',
    );
} else if ($api == 'stk_query') {
    $parameters = array(
        'BusinessShortCode' => '603013',
        'Password' => 'TkNZpjhQ',
        'Timestamp' => '20171010101010',
        'CheckoutRequestID' => 'ws_co_123456789',
    );
} else if ($api == 'account_balance') {
    $parameters = array(
        'CommandID' => 'AccountBalance',
        'PartyA' => '603013',
        'IdentifierType' => '4',
        'Remarks' => 'Remarks',
        'Initiator' => 'apiop41',
        'SecurityCredential' => 'TkNZpjhQ',
        'QueueTimeOutURL' => 'https://url',
        'ResultURL' => 'https://url',
    );
} else if ($api == 'b2b_payment_request') {
    $parameters = array(
        'CommandID' => 'BusinessPayBill',
        'Amount' => '10',
        'PartyA' => '603013',
        'SenderIdentifierType' => '4',
        'PartyB' => '600000',
        'RecieverIdentifierType' => '4',
        'Remarks' => 'Remarks',
        'Initiator' => 'apiop41',
        'SecurityCredential' => 'TkNZpjhQ',
        'QueueTimeOutURL' => 'https://url',
        'ResultURL' => 'https://url',
        'AccountReference' => '12',
    );
} else if ($api == 'b2c_payment_request') {
    $parameters = array(
        'InitiatorName' => 'apiop41',
        'SecurityCredential' => 'TkNZpjhQ',
        'CommandID' => 'SalaryPayment',
        'Amount' => '10',
        'PartyA' => '603013',
        'PartyB' => '254708374149',
        'Remarks' => 'Remarks',
        'QueueTimeOutURL' => 'https://url',
        'ResultURL' => 'https://url',
        'Occasion' => '12',
    );
} else if ($api == 'reversal') {
    $parameters = array(
        'CommandID' => 'TransactionReversal',
        'ReceiverParty' => '254708374149',
        'RecieverIdentifierType' => '1',
        'Remarks' => 'remarks',
        'Initiator' => 'apiop41',
        'SecurityCredential' => 'TkNZpjhQ',
        'QueueTimeOutURL' => 'https://url',
        'ResultURL' => 'https://url',
        'TransactionID' => '11211',
        'Occasion' => '12',
        'Amount' => '10',
    );
} else if ($api == 'transaction_status_request') {
    $parameters = array(
        'CommandID' => 'TransactionStatusQuery',
        'PartyA' => '254708374149',
        'IdentifierType' => '603013',
        'Remarks' => 'remarks',
        'Initiator' => 'apiop41',
        'SecurityCredential' => 'TkNZpjhQ',
        'QueueTimeOutURL' => 'https://url',
        'ResultURL' => 'https://url',
        'TransactionID' => '11211',
        'Occasion' => '12',
    );
} else if ($api == 'c2b_register_url') {
    $parameters = array(
        'ValidationURL' => 'https://url',
        'ConfirmationURL' => 'https://url',
        'ResponseType' => 'Completed',
        'ShortCode' => '603013',
    );
} else if ($api == 'c2b_simulate') {

    $parameters = array(
        'CommandID' => 'CustomerPayBillOnline',
        'Amount' => '100',
        'Msisdn' => '254708374149',
        'BillRefNumber' => 'TESTING',
        'ShortCode' => '603013',
    );
} else if ($api == 'generate_token') {
    $parameters = array(
        'ConsumerKey' => 'CONSUMER_KEY',
        'ConsumerSecret' => 'CONSUMER_SECRET',
    );
}//E# if statement

$response = $mpesa_api->call($api, $configs, $parameters);
echo 'JSON response: <p>';
echo json_encode($response);
echo '<p>Response var_dump:<p>';
var_dump($response);

```
## Authentication
First call the `generate_token` to get the access token
After getting the access token, set it in the `AccessToken` index in the `$configs` to make other calls.

## Configurations
The `$configs` parameters has the following indices

- `AccessToken` - The access token. Get the access to ken by running calling the `generate_token' API 
- `Environment` - Can be `sandbox` (when testing your app) or `live` (when your app is in production) 
- `Content-Type` - Should always be `application/json`
- `Verbose` - (Optional) for easy debugging, set this index to run your code in verbose mode ie echo and var dump parameters
- `Url` - (Optional), this overrides the endpoint. By default we use https://sandbox.safaricom.co.ke/ and https://api.safaricom.co.ke/ for sandbox and live respecitvely. Don't forget the forward slush as the end(/)

```php
$configs = array(
    'AccessToken' => 'ACCESSTOKEN',
    'Environment' => 'sandbox',
    'Content-Type' => 'application/json',
    'Verbose' => 'true', //THIS
);
```

## Response
The response has the following indices

- `Environment` - live or sandbox
- `Name` - The name of the API called
- `HttpVerb` - get or post
- `HttpStatusCode` - HTTP status code
- `HttpStatusMessage` - HTTP status message
- `Message` - Custom Message
- `Response` - Response array
- `Endpoint` - URL called
- `Parameters` - Parameters passed to the URL
- `ExpectedResponse` - Expected Reponse Parameters as documents in the API


Sample Json
```json
{"Environment":"sandbox","Name":"Generate Token","HttpVerb":"get","HttpStatusCode":"200","HttpStatusMessage":"Success","Message":"Success","Response":{"access_token":"YdiXeOksM3G9WVgl7jR1pCtT2Ckt","expires_in":"3599"},"Endpoint":"https:\/\/sandbox.safaricom.co.ke\/oauth\/v1\/generate","Parameters":{"ConsumerKey":"Li2dKUeKhlX6Gw0Fpkbq6LEBndlpOuxZ","ConsumerSecret":"hX3Yyd0BGMBiYaln"},"ExpectedResponse":{"Expiry":{"name":"Token expiry time in seconds.","type":"Integer","sample_value":"3599"},"Access_Token":{"name":"Access token to access other APIs","type":"Alpha-Numeric","sample_value":"O22vJy6rnN2nRAnOPqZ8dkyGxmXG"}}}
```

Sample PHP Var dump

```php
array (size=10)
  'Environment' => string 'sandbox' (length=7)
  'Name' => string 'Generate Token' (length=14)
  'HttpVerb' => string 'get' (length=3)
  'HttpStatusCode' => string '200' (length=3)
  'HttpStatusMessage' => string 'Success' (length=7)
  'Message' => string 'Success' (length=7)
  'Response' => 
    array (size=2)
      'access_token' => string 'YdiXeOksM3G9WVgl7jR1pCtT2Ckt' (length=28)
      'expires_in' => string '3599' (length=4)
  'Endpoint' => string 'https://sandbox.safaricom.co.ke/oauth/v1/generate' (length=49)
  'Parameters' => 
    array (size=2)
      'ConsumerKey' => string 'Li2dKUeKhlX6Gw0Fpkbq6LEBndlpOuxZ' (length=32)
      'ConsumerSecret' => string 'hX3Yyd0BGMBiYaln' (length=16)
  'ExpectedResponse' => 
    array (size=2)
      'Expiry' => 
        array (size=3)
          'name' => string 'Token expiry time in seconds.' (length=29)
          'type' => string 'Integer' (length=7)
          'sample_value' => string '3599' (length=4)
      'Access_Token' => 
        array (size=3)
          'name' => string 'Access token to access other APIs' (length=33)
          'type' => string 'Alpha-Numeric' (length=13)
          'sample_value' => string 'O22vJy6rnN2nRAnOPqZ8dkyGxmXG' (length=28)
```

## C2B Validation and Confirmation
The URL that you registered you need to write code to capture the json data that is posted to that URL.

The URL need be ssl or https. You can use [LetsEncrypt] https://letsencrypt.org/ to setup https 

MPESA will send 2 requests:
1. Validation - This step is optional. It's used to validate that the transaction is valid. Eg, if you can validate that the account number that the customer entered exists. 

MPESA will post the json below. You can get it going to [this link](https://developer.safaricom.co.ke/docs?json#c2b-api) and then click on the "Json Response" tab on the right.
```json
// Validation Response
{
  "TransactionType":"",
  "TransID":"LGR219G3EY",
  "TransTime":"20170727104247",
  "TransAmount":"10.00",
  "BusinessShortCode":"600134",
  "BillRefNumber":"xyz",
  "InvoiceNumber":"",
  "OrgAccountBalance":"",
  "ThirdPartyTransID":"",
  "MSISDN":"254708374149",
  "FirstName":"John",
  "MiddleName":"Doe",
  "LastName":""
}
```

Below is a sample PHP code for the validation step that just returns what's required. Sorry if you are not using PHP, but you can re-write it in your own language

You need to return "ResultCode"=>0 meaning your accept the transaction and "ResultCode"=>1, if you don't accept the transaction and the transaction will fail
```php
 /**
     * S# postMpesaDarajaC2BValidate() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Mpesa Daraja C2B Validate
     * 
     */
    public function postMpesaDarajaC2BValidate() {
        return $array = array(
            'ResultCode' => '0',
            'ResultDesc' => 'Service processing successful',
        );
    }

//E# postMpesaDarajaC2BValidate() function

```
2. Confirmation - If you return "ResultCode" == 0 in the above step, MPESA will complete the transaction send you a json of the transaction object to the URL you registered. 

MPESA will post the json below. You can get it going to [this link](https://developer.safaricom.co.ke/docs?json#c2b-api) and then click on the "Json Response" tab on the right.
```json
//Confirmation Respose
{
  "TransactionType":"",
  "TransID":"LGR219G3EY",
  "TransTime":"20170727104247",
  "TransAmount":"10.00",
  "BusinessShortCode":"600134",
  "BillRefNumber":"xyz",
  "InvoiceNumber":"",
  "OrgAccountBalance":"49197.00",
  "ThirdPartyTransID":"1234567890",
  "MSISDN":"254708374149",
  "FirstName":"John",
  "MiddleName":"",
  "LastName":""
}
```

Below is a sample PHP code for the confirmation step that saves the data to the database. Sorry if you are not using PHP, but you can re-write it in your own language

The code is written in Laravel 4 but has the raw php equivalent code to get the json and save response in the database. (NB: The RAW php has not been tested but should work :) )

```php
 /**
     * S# postMpesaDarajaC2BConfirm() function
     * 
     * @author Edwin Mugendi <edwinmugendi@gmail.com>
     * 
     * Mpesa Daraja C2B confirm
     * 
     */
    public function postMpesaDarajaC2BConfirm() {
        //Laravel 4.2
        $input = \Input::get();

        //RAW PHP - Untested :(
        //$json_payload = file_get_contents('php://input');
        //$input = json_decode($json_payload,TRUE);

        $name = '';
        if ($input['FirstName']) {
            $name = $input['FirstName'];
        }//E# if statement

        if ($input['MiddleName']) {
            $name .= ' ' . $input['MiddleName'];
        }//E# if statement

        if ($input['LastName']) {
            $name .= ' ' . $input['LastName'];
        }//E# if statement
        //Initiate transaction array
        $transaction_array = array(
            'trans_type' => $input['TransactionType'],
            'trans_id' => $input['TransID'],
            'trans_time' => Carbon::createFromFormat('YmdHis', $input['TransTime']),
            'trans_amount' => $input['TransAmount'],
            'short_code' => $input['BusinessShortCode'],
            'org_account_balance' => $input['OrgAccountBalance'],
            'phone' => $input['MSISDN'],
            'bill_ref_number' => $input['BillRefNumber'],
            'invoice_number' => $input['InvoiceNumber'],
            'first_name' => $input['FirstName'],
            'middle_name' => $input['MiddleName'],
            'last_name' => $input['LastName'],
            'name' => $name,
        );

        //Laravel 4.2
        $transaction_model = Transaction::create($transaction_array);

        /* RAW PHP - Untested :(
          $link = mysql_connect($db_host, $db_name, $db_pass);

          mysql_select_db($db_name, $link);

          if (!$link) {
          die('Could not connect: ' . mysql_error());
          }
          $transaction_array = array();

          $sql = "INSERT INTO TRANSACTION (trans_type, trans_id,
          trans_amount,trans_time,trans_date,phone,first_name, middle_name,last_name, bill_ref_number,short_code)
          VALUES (" . $transaction_array['trans_type'] . ", " . $transaction_array['trans_id'] . ", " . $transaction_array['trans_amount'] . ", " . $transaction_array['trans_time'] . ", " . $transaction_array['trans_date'] . ", " . $transaction_array['trans_phone'] . ", " . $transaction_array['trans_first_name'] . ", " . $transaction_array['trans_middle_name'] . ", " . $transaction_array['trans_last_name'] . ", " . $transaction_array['trans_bill_ref_number'] . ", " . $transaction_array['trans_short_code'] . "')";

          if (!mysql_query($sql, $link)) {
          die('Error: ' . mysql_error());
          }

          // Close connection
          mysql_close($link);
         */
        return 'Completed';
    }

//E# postMpesaDarajaC2BConfirm() function
```

## Help
This blog post shares our companies experience in [integrating to MPESA API] http://sapamaerp.com/blog/guide-integrating-new-mpesa-api
 
For MPESA API as a Service and access all the functions/API's above as a service, please check out [SapamaCash.com](http://sapamacash.com/docs)

For API integration assistance, bugs or assistance, kindly reach me on <a href="mailto:edwinmugendi@gmail.com">edwinmugendi@gmail.com</a> or +254722906835
