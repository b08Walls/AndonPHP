<?php
// API access key from Google API's Console
// define ('API_ACCESS_KEY', 'AAAA1uMX-x0:APA91bGRJKFOgmVtGrfAPGfKqI4NcJrD5KHTy_f7rGP4YcXyxhPNYqMvrbc_ZB9GXcdMVn34d7rFyjjXB0K5KNrEy2wc1lvLOY3FoOXe8T-8ZYS2yq0hAXV8anm8-gK3xkygfUcPtw0C');

define ('API_ACCESS_KEY', 'AAAApK6FQe8:APA91bGpLj1iEhMVdfhaTO7fT8rZZaUFpMll8Dj4azT2j5gph6N6Sw4ak48FqVeveNjntanYs5we9a50lX1rxrr5Z3GwXH_89qY_8nUQCN0UUadC7D18P6Qsu0hOF9vfmjPV7KFAyuRX');

//
//define( 'API_ACCESS_KEY', 'AAAA1uMX-x0:APA91bGRJKFOgmVtGrfAPGfKqI4NcJrD5KHTy_f7rGP4YcXyxhPNYqMvrbc_ZB9GXcdMVn34d7rFyjjXB0K5KNrEy2wc1lvLOY3FoOXe8T-8ZYS2yq0hAXV8anm8-gK3xkygfUcPtw0C');
//
//$registrationIds = array( $_GET['id'] );
$registrationIds = array('fAq5anAmyAg:APA91bF0qtEQZp09lGqLLSZA_rHvZ0wZn');
$to = 'fAq5anAmyAg:APA91bF0qtEQZp09lGqLLSZA_rHvZ0wZnEbcp3J0VdaZ0TwJTvU7wU3oFY-_gnEwZ8T0S72NG_9A6hvJWfb3kbXImTRL2a7nz_JBvjVNKm7AiSKL6rmurSitdR6SIA_YsKiq7fd98DSU';
//fAq5anAmyAg:APA91bF0qtEQZp09lGqLLSZA_rHvZ0wZnEbcp3J0VdaZ0TwJTvU7wU3oFY-_gnEwZ8T0S72NG_9A6hvJWfb3kbXImTRL2a7nz_JBvjVNKm7AiSKL6rmurSitdR6SIA_YsKiq7fd98DSU
//fAq5anAmyAg:APA91bF0qtEQZp09lGqLLSZA_rHvZ0wZnEbcp3J0VdaZ0TwJTvU7wU3oFY-_gnEwZ8T0S72NG_9A6hvJWfb3kbXImTRL2a7nz_JBvjVNKm7AiSKL6rmurSitdR6SIA_YsKiq7fd98DSU
//1:381695812334:android:b119f1d8f1e8592a
// prep the bundle

$onLine = 0;

$servername = "localhost";
    $username = "android";
    $password = "53285328";
    $dbname = "andon";





$msg = array
(
    'body'  => 'here is a message. message',
    'title'     => 'This is a title. title',
    'vibrate'   => 1,
    'sound'     => 'mySound',
    'icon'      => 'mySound'
);


if(isset($_REQUEST["ESTACION"]) && isset($_REQUEST["LINEA"])&& isset($_REQUEST["ID_REGISTRO"]))
{
    $pLinea = $_REQUEST['LINEA'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $qry = "SELECT TOKEN FROM TEAM_LEADERS WHERE LINEA = $pLinea and LOGED = 1";
    $result = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($result);
    $tabla = $result->fetch_row();
    //echo $tabla[0];
    //$to = 'fAq5anAmyAg:APA91bF0qtEQZp09lGqLLSZA_rHvZ0wZnEbcp3J0VdaZ0TwJTvU7wU3oFY-_gnEwZ8T0S72NG_9A6hvJWfb3kbXImTRL2a7nz_JBvjVNKm7AiSKL6rmurSitdR6SIA_YsKiq7fd98DSU';
    $to = $tabla[0];


    
    $data = array(
    'ESTACION' => $_REQUEST['ESTACION'],
    'LINEA' => $_REQUEST['LINEA'],
    'ID_REGISTRO' => $_REQUEST['ID_REGISTRO']
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

}




?>