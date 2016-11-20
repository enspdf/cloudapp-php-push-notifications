<?php

/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 29/09/16
 * Time: 8:16 PM
 */


function push_notification($title, $message) {

    $conn = mysqli_connect("127.4.249.2", "adminYiR14Wv", "_LfDvZlMv1zA", "cloudapp");
    $sql = "SELECT Token FROM users";
    $result = mysqli_query($conn, $sql);
    $tokens = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tokens[] = $row["Token"];
        }
    }

    mysqli_close($conn);
    $message = array(
        "message" => $message,
        "title" => $title
    );


    send_notification($tokens, $message);


}

function send_notification($tokens, $message) {

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        'priority' => 'high',
        'registration_ids' => $tokens,
        'data' => $message
    );

    $headers = array(
        'Authorization:key = AIzaSyA2dOopcFXnSgMOdX3H1zXPeb24aE-8H1s ',
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }

    curl_close($ch);

    return $result;

}

?>