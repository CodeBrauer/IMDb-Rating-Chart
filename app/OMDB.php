<?php
namespace IMDBRC;

class OMDB
{
    const API_BASE_URL = 'http://www.omdbapi.com';

    public static function send_request($params)
    {
        $params['apikey'] = getenv('OMDB_API_KEY');
        $url = self::API_BASE_URL . '/?' . http_build_query($params);
        return Helper::curl_get_contents($url);
    }

    public static function get_summary($search) {
        $params = [
            't'      => urlencode($search),
            'type'   => 'series',
            'r'      => 'json',
        ];
        return self::send_request($params);
    }

    public static function get_episodes_by_season($search, $season = 1) {
        $params = [
            't'      => urlencode($search),
            'Season' => $season,
            'type'   => 'episode',
            'r'      => 'json',
        ];
        return self::send_request($params);
    }
}