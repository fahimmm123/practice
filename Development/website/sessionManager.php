<?php

ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode', 1);

$lifetime = 1800;

session_set_cookie_params(
    ['lifetime' => $lifetime,
    'domain' => 'sencldigitech.co.uk/faziz',
    'path' => '/',
    'secure' => true,
    'samesite' => 'Strcit',
    'httponly' => true]

    
);

session_start();

if(!isset($_Session['createdAT']))
{
    $_SESSIOM['createdAT'] = time();
}
else {
    if(time() - $_SESSION['createdAT' > $lifetime])
    {
        session_regenerate_id(true);
        $_SESSION['createdAT'] = time();
    }
}

?>