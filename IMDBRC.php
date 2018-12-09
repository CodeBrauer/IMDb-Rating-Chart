<?php
class IMDBRC
{
    const API_KEY      = 'b6775c8';
    const API_BASE_URL = 'http://www.omdbapi.com';

    public static function get_chart_array($search)
    {
        $season      = 1;
        $last_season = 1000;
        $data        = [];

        while ($season <= $last_season) {
            $row = self::get_episodes_by_season($search, $season);
            $last_season = (int)$row['totalSeasons'];
            foreach ($row['Episodes'] as $episode) {
                if ($episode['imdbRating'] == 0) {
                    /* episodes which aren't aired yet */
                    continue;
                }
                $data[] = [(int)$season, (int)$episode['Episode'], (float)$episode['imdbRating'], $episode['Title']];
            }
            $season++;
        }

        return $data;
    }

    public static function get_summary($search) {
        $params = [
            't'      => urlencode($search),
            'type'   => 'series',
            'r'      => 'json',
            'apikey' => self::API_KEY,
        ];
        return self::send_request($params);
    }

    public static function get_episodes_by_season($search, $season = 1) {
        $params = [
            't'      => urlencode($search),
            'Season' => $season,
            'type'   => 'episode',
            'r'      => 'json',
            'apikey' => self::API_KEY,
        ];
        return self::send_request($params);
    }

    public static function send_request($params)
    {
        $url = self::API_BASE_URL . '/?' . http_build_query($params);
        return self::curl_get_contents($url);
    }

    public static function curl_get_contents($url) {
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