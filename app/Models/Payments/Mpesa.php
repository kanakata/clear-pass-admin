<?php

namespace App\Models\Payments\Mpesa;

class Mpesa
{
    private $message;
    private function Access_token(): string
    {
        $credentials = base64_encode($_ENV['CONSUMER_KEY'] . ':' . $_ENV['CONSUMER_SECRET']);
        $url = $_ENV['AUTH_URL'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        return $result['access_token'];
    }
    public function Stk_push(string $phone, string $amount)
    {
        $token = self::Access_token();
        $timestamp = date('YmdHis');
        $password = base64_encode($_ENV['SHORTCODE'] . $_ENV['PASSKEY'] . $timestamp);

        $payload = [
            'ShortCode'         => $_ENV['SHORTCODE'],
            'CommandID'         => 'CustomerPayBillOnline',
            'Password'          => $password,
            'Timestamp'         => $timestamp,
            'Amount'            => $amount,
            'PartyA'            => $phone,
            'PartyB'            => 174379,
            'Msisdn'            => $phone,
            'CallBackURL'       => $_ENV['CALLBACK_URL'],
            'AccountReference'  => 'Test123',
            'TransactionDesc'   => 'Payment',
        ];

        $url = $_ENV['STKPUSH_URL'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        print_r($response);
        curl_close($ch);
        return json_decode($response, true);
    }
    private function Callback()
    {
        header("Content-Type: application/json");

        $stkCallbackResponse = file_get_contents('php://input');

        $data = json_decode($stkCallbackResponse);
        $resultCode = $data->Body->stkCallback->ResultCode;

        if ($resultCode == 0) {
            // Payment Successful
            $metadata = $data->Body->stkCallback->CallbackMetadata->Item;
            $mpesaReceiptNumber = $metadata[1]->Value;
            $amount = $metadata[0]->Value;
            $phoneNumber = $metadata[4]->Value;
        }
    }
}
