<?php

namespace App\LoginAttempts;

if ( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

use WP_Error;

class Ino_Limit_Login_Attempts
{
    var $failed_login_limit = 3;
    var $lockout_duration = 1800;
    var $transient_name = 'attempted_login';

    public function __construct()
    {
        add_filter('authenticate', array($this, 'check_attempted_login'), 30, 3);
        add_action('wp_login_failed', array($this, 'login_failed'), 10, 1);
    }

    /**
     * Lock login attempts of failed login limit is reached
     */
    public function check_attempted_login($user, $username, $password)
    {
        if (get_transient($this->transient_name)) {
            $datas = get_transient($this->transient_name);
            if ($datas['tried'] >= $this->failed_login_limit) {
                $until = get_option('_transient_timeout_' . $this->transient_name);
                $time = $this->when($until);
                //Display error message to the user when limit is reached
                return new WP_Error('too_many_tried', sprintf(__('<strong>Hello User</strong>: You have reached the authentication limit, after %1$s please try again.'), $time));
            }
        }
        return $user;
    }

    /**
     * Add transient
     */
    public function login_failed($username)
    {
        if (get_transient($this->transient_name)) {
            $datas = get_transient($this->transient_name);
            $datas['tried']++;
            if ($datas['tried'] <= $this->failed_login_limit)
                set_transient($this->transient_name, $datas, $this->lockout_duration);
        } else {
            $datas = array(
                'tried' => 1
            );
            set_transient($this->transient_name, $datas, $this->lockout_duration);
        }
    }

    /**
     * Return difference between 2 given dates
     * @param int $time Date as Unix timestamp
     * @return string           Return string
     */
    private function when($time)
    {
        if (!$time)
            return;
        $right_now = time();
        $diff = abs($right_now - $time);
        $second = 1;
        $minute = $second * 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        if ($diff < $minute)
            return floor($diff / $second) . ' second';
        if ($diff < $minute * 2)
            return " about 1 minute ago";
        if ($diff < $hour)
            return floor($diff / $minute) . ' minute';
        if ($diff < $hour * 2)
            return ' about 1 hour ago';
        return floor($diff / $hour) . ' hour';
    }
}