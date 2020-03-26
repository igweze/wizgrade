<?php
/**
 * Verify SimplePay transaction
 */

$private_key = 'test_pr_demo';  // put here your private key

// Retrieve data returned in payment gateway callback
$token = $_POST["sp_token"];
$amount = $_POST["sp_amount"];
$amount_currency = $_POST["sp_currency"];
$sp_status = $_POST["sp_status"];
$transaction_id = $_POST["transaction_id"]; // we don't really need this here, is just an example

$data = array(
    'token' => $token,
    'amount' => $amount,
    'amount_currency' => $amount_currency
);
$data_string = json_encode($data);

// Call to charge/verify a payment
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://checkout.simplepay.ng/v2/payments/card/charge/');
curl_setopt($ch, CURLOPT_USERPWD, $private_key . ':');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string)
));

$curl_response = curl_exec($ch);
$curl_response = preg_split("/\r\n\r\n/", $curl_response);
$response_content = $curl_response[1];
$json_response = json_decode(chop($response_content), TRUE);
print_r($json_response);
$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($response_code == '200') {
    // even is http status code is 200 we still need to check transaction had issues or not
    if ($json_response['response_code'] == '20000') {
        // card was successfully charged
        header('Location: success.html');
    } else {
        // failed to charge the card
        header('Location: failed.html');
    }
} else if ($sp_status == 'true') {
    // even though it failed the call to card charge, card payment was already processed
    header('Location: success.html');
} else {
    // failed to charge the card
    header('Location: failed.html');
}
?>
