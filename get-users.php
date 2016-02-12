<?php
/*
 * Retrieves a list of users
 * GET /users
 */
$user = 'yourusername';
$password = 'yourpassword';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://rest.domain/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, sprintf("%s:%s", $user, $password));
$result = curl_exec($ch);
if (false === $result) {
    // handle curl error
    $error = curl_error($ch);
    curl_close($ch);
    return;
}
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($statusCode === 200) {
    $users = json_decode($result, true);
    var_dump($users);
} else {
    $response = json_decode($result, true);
    var_dump($response);
}
