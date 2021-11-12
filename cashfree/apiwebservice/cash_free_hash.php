<?php
//HASH FILE

$order_id=$_POST['oid'];
$order_amount=$_POST['order_amount'];

$ch = curl_init();

$data = json_encode(array(
"orderId"  => $order_id,
"order_amount" => $order_amount,
"orderCurrency"=>"INR"
));

curl_setopt($ch, CURLOPT_URL, 'https://api.cashfree.com/api/v2/cftoken/order');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"{\n  \"orderId\": \"$order_id\",\n  \"orderAmount\":$order_amount,\n  \"orderCurrency\":\"INR\"\n}");

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-Client-Id: xxxxxx';//Replace With Your Client Id
$headers[] = 'X-Client-Secret: xxxxxx';//Replace With Your Client Secret
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

$new=json_decode($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);



$responseData2 = json_decode($result, TRUE);

$o_c=$responseData2['cftoken'];
$message=$responseData2['message'];


echo json_encode(array("status"=>1,"cftoken"=>$o_c,"message"=>$message,"result"=>$new));
?>
