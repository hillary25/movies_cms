<?php

function login($username, $password){
    // Debug

    // sprintf allows you to use % and switch out for varible on the browser screen
    $message = sprintf('You are trying to login with username %s and password %s', $username, $password);

    return $message;
}