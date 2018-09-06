<?php

//Set the api_key, api_secret and endpoint as configs in the system that can be setup during configuration
$api_key = 'key';
$api_secret = 'secret';
$endpoint = 'http://localhost/sapamacash/public/api/checkout';

//Data to send a query string
$data = array(
    'flow' => 'redirect',
    'environment' => 'sandbox',
    'simulate' => 'success',
    'first_name' => 'Edwin',
    'last_name' => 'Mugendi',
    'email' => 'edwin@sapamatech.com',
    'phone' => '254722906835',
    'address' => 'Address',
    'city' => 'City',
    'province' => 'Province',
    'postal_code' => '00200',
    'amount' => '200',
    'currency' => 'KES',
    'reference_number' => 'REFERENCE NUMBER',
    'callback_url' => 'http://sapamacash.com',
    'picture_url' => 'http://sapamacash.com',
    'item_id' => '1',
    'format' => 'json',
    'api_key' => $api_key,
    'api_secret' => $api_secret,
);
//Sort by keys in ascending order
ksort($data);
var_dump($data);

//Implode the string
$string_to_hash = implode($data, '.');

echo 'String to hash: ' . $string_to_hash . '<p>';

//Generate hash
$hash = hash('sha256', $string_to_hash, false);

echo 'Generated hash: ' . $hash . '<p>';

//IMPORTANT: REMEMBER TO ADD THE GENERATED HASH TO TO THE DATA
$data['hash'] = $hash;

//IMPORTANT: REMEMBER TO REMOVE THE API SECRET FROM THE DATA HASHED
unset($data['api_secret']);
var_dump($data);

$fields_string = '';
foreach ($data as $key => $value) {
    $fields_string .= $key . '=' . $value . '&';
}//E# foreach statement

rtrim($fields_string, '&');

echo 'Query string: ' . $fields_string . '<p>';

echo 'Full url: ' . $endpoint . '?' . $fields_string . '<p>';

// Get cURL resource
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, count($data));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);


echo 'Result in JSON<p>' . $result . '<p>';
    
$decoded_data = json_decode($result, true);
echo 'Decoded array<p>';

var_dump($decoded_data);

if ($decoded_data['httpStatusCode'] == 200) {
    
} else {
    echo "<p>HTTP Status Code: " . $decoded_data['httpStatusCode'] . '<p>';
    echo "System Code: " . $decoded_data['systemCode'] . '<p>';
    echo "Message: " . $decoded_data['systemCode'] . '<p>';
}
