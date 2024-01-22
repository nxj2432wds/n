<?php
error_reporting(0);
$user = $_GET['user'];
if (empty($user)) die('{"username":"","status":"Add username To check","Dev":"givt"}');


$login = curl_init();
$headers = array(
    'user-agent: Instagram 113.0.0.39.122 Android (24/5.0; 515dpi; 1440x2416; huawei/google; Nexus 6P; angler; angler; en_US)',
);
$data = array(
    "username" => $user
);
curl_setopt($login,CURLOPT_URL,"https://i.instagram.com/api/v1/users/check_username/");
curl_setopt($login , CURLOPT_FOLLOWLOCATION , true);
curl_setopt($login , CURLOPT_POST , 1);
curl_setopt($login,CURLOPT_HTTPHEADER,$headers);
curl_setopt($login,CURLOPT_POSTFIELDS,$data);
curl_setopt($login , CURLOPT_RETURNTRANSFER , true);
$respone = curl_exec($login);
if (strpos($respone,'username_is_taken')){
    $response_server = array(
        "username" => htmlspecialchars($user),
        "status" => "Taken",
        "Dev" => "givt"
    );
    echo json_encode($response_server);
} elseif (strpos($respone,'available":true')){
    $response_server = array(
        "username" => htmlspecialchars($user),
        "status" => "Available",
        "Dev" => "givt"
    );
    echo json_encode($response_server);
} else {
    $response_server = array(
        "username" => htmlspecialchars($user),
        "status" => "I Think is Blocked ..",
        "Dev" => "givt"
    );
    echo json_encode($response_server);
}
?>
