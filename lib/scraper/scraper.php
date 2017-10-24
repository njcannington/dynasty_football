<?php
namespace Lib\Scraper;

use DomDocument;
use DOMXPath;

abstract class Scraper extends DomDocument
{
    protected $html_dom;
    protected $url;

    protected function newDom($html)
    {
        $dom = new DomDocument();
        libxml_use_internal_errors(true); //
        @$dom->loadHTML($html);

        return $dom;
    }

    protected function fetchHTML($url, $cookie = '')
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
    }

    protected function extractHREFs($xpath)
    {
        $dom = new DOMXPath($this->html_dom);
        foreach ($dom->query($xpath) as $data) {
            $hrefs[] = $data->getAttribute('href');
        }
        return $hrefs;
    }

    protected function extractTextContent($xpath)
    {
        $dom = new DOMXPath($this->html_dom);
        foreach ($dom->query($xpath) as $data) {
            $text_content[] = $data->textContent;
        }
        return $text_content;
    }
}
