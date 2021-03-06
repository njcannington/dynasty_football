<?php
namespace App\Lib\Scraper;

use DomDocument;
use DOMXPath;

class Scraper extends DomDocument
{
    protected $html; //html extracted from scraper
    protected $url; //url useed to extract html
    protected $cookie; // cookie needed to access url

    public function __construct($url)
    {
        $this->url = $url;
        try {
            $this->html = $this->getHTML();
        } catch (\Exception $e) {
            return;
        }
    }

    protected function getHTML()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
        $html = curl_exec($ch);
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:
                    break;
                default:
                    throw new \Exception("Unexpected HTTP code: {$http_code}");
            }
        }
        curl_close($ch);

        return $html;
    }

    public function getHrefs($xpath)
    {
        $hrefs = [];
        foreach ($this->getElements($xpath) as $element) {
            $hrefs[] = $element->getAttribute('href');
        }
        return $hrefs;
    }

    public function getTextContent($xpath)
    {
        foreach ($this->getElements($xpath) as $element) {
            $text_contents[] = $element->textContent;
        }
        return $text_contents;
    }


    protected function getElements($xpath)
    {
        $dom_x_path = self::newDomXPath($this->html);
        if (!$dom_x_path->query($xpath)) {
                throw new \Exception("Unexpected error with XPATH -".$xpath);
        } else {
            return self::newDomXPath($this->html)->query($xpath);
        }
    }


    protected static function newDomXPath($html)
    {
        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        @$dom->loadHTML($html);

        return new DOMXPath($dom);
    }
}
