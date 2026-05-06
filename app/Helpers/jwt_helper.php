<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function create_jwt($data)
{
    return JWT::encode($data, getenv('JWT_SECRET'), 'HS256');
}

function verify_jwt($token)
{
    return JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
}