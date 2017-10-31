<?php
// API access key from Google API's Console
define ('API_ACCESS_KEY', 'AAAA1uMX-x0:APA91bGRJKFOgmVtGrfAPGfKqI4NcJrD5KHTy_f7rGP4YcXyxhPNYqMvrbc_ZB9GXcdMVn34d7rFyjjXB0K5KNrEy2wc1lvLOY3FoOXe8T-8ZYS2yq0hAXV8anm8-gK3xkygfUcPtw0C');
//
$registrationIds = array('fAq5anAmyAg:APA91bF0qtEQZp09lGqLLSZA_rHvZ0wZn');
//$to = 'dS9m6F8LSQE:APA91bEvPKgLqbn-yeNW3lIsjjkTONdViKi-tkjbxDPduiZmWminAi0ChRkZIqu86VUJoJNyMlTSvUOMnsE_cvCcJhoPw4jvi0zf11iWtWPmyiPFxlEsm0kLiykd9OcPUErAaH9sgKc3';
$to = 'fiwLg3nN0sQ:APA91bGAxy3jJCK1TseWwkl6iaAGdkZcAZihkIBVBzu2_JgSu2pu98n2F8YLE3iM1BFz2qsWUgUaeRbDa4CwSg22YsdghRn_eJO3Vf4OVBUrHy5XBs3d7x4PVPRdhr7uNcznwAmBDqNQ';

$onLine = 0;

$msg = array
(
    'body'  => 'here is a message. message',
    'title'     => 'This is a title. title',
    'vibrate'   => 1,
    'sound'     => 'mySound',
    'icon'      => 'mySound'
);

if(isset($_REQUEST["MENSAJE"]))
{
    $mensajeDemo = $_REQUEST['MENSAJE'];

    echo $mensajeDemo;

    $to = 'dS9m6F8LSQE:APA91bEvPKgLqbn-yeNW3lIsjjkTONdViKi-tkjbxDPduiZmWminAi0ChRkZIqu86VUJoJNyMlTSvUOMnsE_cvCcJhoPw4jvi0zf11iWtWPmyiPFxlEsm0kLiykd9OcPUErAaH9sgKc3';
    
    $data = array(
    'MENSAJE' => $_REQUEST['MENSAJE']
    );

    $fields = array
    (
        'to' => $to,
        'priority' => 'high',
        'data'=> $data
    );
     
    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
     
    //https://fcm.googleapis.com/fcm/send

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );

    echo "<br>";
    echo "Mensaje enviado";

}




?>