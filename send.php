<?php

/** Google URL with which notifications will be pushed */
$url = "https://fcm.googleapis.com/fcm/send";
/** 
 * Firebase Console -> Select Projects From Top Naviagation 
 *      -> Left Side bar -> Project Overview -> Project Settings
 *      -> General -> Scroll Down and you will be able to see KEYS
 */
/** SERVER KEY -> Settings -> Cloud Messaging -> Project Credentials -> Server Key */
$cloud_messaging_server_key  = "key=SERVER KEY";

/** We will need to set the following header to make request work */
$request_headers = array(
    "Authorization:" . $cloud_messaging_server_key,
    "Content-Type: application/json"
);

/** Data that will be shown when push notifications get triggered */
$postRequest = [
    "notification" => [
        "title" =>  "New Article",
        "body" =>  "Firebase Cloud Messaging for Web using JavaScript",
        "icon" =>  "https://c.disquscdn.com/uploads/users/34896/2802/avatar92.jpg",
        "click_action" =>  "http://localhost:8888/test"
    ],
    /** Customer Token, As of now I got from console. You might need to pull from database */
    "to" =>  "CUSTOMER TOKEN WHICH GETS GENERATE FROM message.getToken()"
];

/** CURL POST code */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postRequest));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

$season_data = curl_exec($ch);

if (curl_errno($ch)) {
    print "Error: " . curl_error($ch);
    exit();
}
// Show me the result
curl_close($ch);
$json = json_decode($season_data, true);

echo '<pre>';
print_r($json);
