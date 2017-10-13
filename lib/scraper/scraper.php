<?php
namespace Lib\Scraper;

require_once("lib/scraper/scraper.php");

use DomDocument;

class Scraper
{
    protected $table_headers;
    protected $table_details;
    protected $filtered_data;
    protected $dom;

    public function __construct()
    {
        $html = $this->fetchHTML();
        if (method_exists($this, "cleanupHTML")) {
            $html = $this->cleanupHTML($html);
        }
        $this->dom = $this->newDom($html);
        $this->setTableHeaders();
        $this->setTableDetails();
        if (method_exists($this, "removeIncompleteRows")) {
            $this->removeIncompleteRows();
        }
        $this->filterTableData();
    }

    protected function setTableHeaders()
    {
        $headers = static::HEADER_LOCATION;
        $keys = array_keys($headers);
        $dom = $this->dom;
        for ($i = 0; $i < count($headers); $i++) {
            $dom = $dom->getElementsByTagName($keys[$i])->item($headers[$keys[$i]]);
        }
        foreach ($dom->getElementsByTagName(static::HEADER_ELEMENT) as $header) {
            $this->table_headers[] = trim($header->textContent);
        }
    }

    protected function filterTableData()
    {
        $headers = static::HEADERS;
        foreach ($headers as $header) {
            $header_keys[] = array_search($header, $this->table_headers);
        }
        $rows = $this->table_details;
        $row_count = count($rows);
        for ($i = 0; $i < $row_count; $i++) {
            for ($ii = 0; $ii < count($headers); $ii++) {
                $this->filtered_data[$i][$headers[$ii]] = $rows[$i][$header_keys[$ii]];
            }
        }
    }

    protected function newDom($html)
    {
        $dom = new DomDocument();
        libxml_use_internal_errors(true); //
        $dom->loadHTML($html);

        return $dom;
    }

    protected function fetchHTML()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
        }
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


    public function getFilteredData()
    {
        return $this->filtered_data;
    }
}
