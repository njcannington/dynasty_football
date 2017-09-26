<?php
namespace DynastyLeagueFootball;

abstract class DynastyLeagueFootball
{
    const BASE_URL = "https://dynastyleaguefootball.com";
    protected $data;

    public function __construct()
    {
        $this->data = self::fetch(static::URL);
    }

    protected static function fetch($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIE, '');
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


    public function get($property)
    {
        return $this->$property;
    }
}
