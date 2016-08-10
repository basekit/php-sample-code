<?php
/*
 * Creates a user
 * POST /users
 */
$user = 'yourusername';
$password = 'yourpassword';
$content = array(
    'brandRef' => 1,
    'firstName' => 'Test',
    'lastName' => 'User',
    'languageCode' => 'en',
    'email' => 'test.user@example.com',
    'username' => 'test.user@example.com',
    'password' => 'password',
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://rest.domain/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, sprintf("%s:%s", $user, $password));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
));
$result = curl_exec($ch);
if (false === $result) {
    // handle curl error
    $error = curl_error($ch);
    var_dump($error);
    curl_close($ch);
    return;
}
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($statusCode === 201) {
    $user = json_decode($result, true);
    var_dump($user);
} else {
    $response = json_decode($result, true);
    var_dump($response);
}
