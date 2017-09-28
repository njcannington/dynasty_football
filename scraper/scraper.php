<?php
namespace Scraper;

use DomDocument;

class Scraper
{
    protected $table_headers;
    protected $dom;

    public function __construct()
    {
        $this->dom = Scraper::newDom($this->url, static::COOKIE);
        $this->setTableHeaders();
    }

    protected function setTableHeaders()
    {
        $headers = static::HEADER_LOCATION;
        $keys = array_keys($headers);
        for ($i = 0; $i < count($headers); $i++) {
            $this->dom = $this->dom->getElementsByTagName($keys[$i])->item($headers[$keys[$i]]);
        }
        foreach ($this->dom->getElementsByTagName(static::HEADER_ELEMENT) as $header) {
            $this->table_headers[] = trim($header->textContent);
        }
    }

    public function getTableHeaders()
    {
        return $this->table_headers;
    }

    protected static function newDom($url, $cookie)
    {
        $html = self::fetchHTML($url, $cookie = null);
        $dom = new DomDocument();
        libxml_use_internal_errors(true); //
        $dom->loadHTML($html);

        return $dom;
    }

    //returns HTML from $url
    protected static function fetchHTML($url, $cookie = null)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
