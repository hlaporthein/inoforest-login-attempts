<?php

if ( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }



function _ino_login_limit() {
    if ( is_admin() ) {
        return;
    }
    new \App\LoginAttempts\Ino_Limit_Login_Attempts();
}
add_action('init', '_ino_login_limit');