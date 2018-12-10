<?php
namespace IMDBRC;

class Helper
{
    public static function curl_get_contents($url)
    {
        if (!function_exists('curl_init')) { return file_get_contents($url); }
        $ch = curl_init();
        $options = array(
            CURLOPT_CONNECTTIMEOUT => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER         => false,
            CURLOPT_URL            => $url,
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}