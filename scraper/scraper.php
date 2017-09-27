<?php
namespace Scraper;

use DomDocument;

class Scraper
{
    //returns HTML from $url
    public static function fetchHTML($url, $cookie = null)
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

    //returns HTML within <table> tags. Use table number if more than one table.
    public static function fetchTable($html, $table_number = 1)
    {
        $html_array = explode("<table", $html);
        $table = $html_array[$table_number];
        $table_array = explode("</table", $table);

        return "<table{$table_array[0]}</table>";
    }

    public static function fetchTableHeaders($table)
    {
        $dom = self::newDom($table);
        foreach ($dom->getElementsbyTagName('th') as $header) {
            $headers[] = trim($header->textContent);
        }

        return $headers;
    }

    public static function fetchTableDetails($table)
    {
        $i = 0;
        $ii = 0;
        $headers = self::fetchTableHeaders($table);
        $dom = self::newDom($table);
        foreach ($dom->getElementsbyTagName('td') as $detail) {
            $details[$ii][] = trim($detail->textContent);
            $i = $i + 1;
            $ii = $i % count($headers) == 0 ? $ii + 1 : $ii;
        }

        return $details;
    }

    public static function newDom($html)
    {
        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);

        return $dom;
    }
}
