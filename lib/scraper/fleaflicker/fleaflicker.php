<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Scraper;

abstract class Fleaflicker extends Scraper
{
    const BASE_URL = "https://www.fleaflicker.com/";
    const LEAGUE_TYPE = "nfl";
    const HEADER_LOCATION = ["table" => 0, "thead" => 0, "tr" => 1];
    const HEADER_ELEMENT = "th";
    const COOKIE = ""; //Fleaflicker doesn't require cookie

    protected function setTableDetails()
    {
        $row = -1;
        $column = 0;
        $headers = static::HEADER_LOCATION;
        $table = $this->dom->getElementsByTagName("table")->item($headers["table"]);
        foreach ($table->getElementsByTagName('td') as $detail) {
            //ensures $rows match table row
            if (!$detail->previousSibling) {
                $row++;
            }
            $this->table_details[$row][] = trim($detail->textContent);
        }
    }

    protected function cleanupHTML($html)
    {
        return str_replace(static::REMOVE_CHARS, "", $html);
    }

    //Occasionally tables will have filler rows that don't contain data.
    // This will remove any row that has less/more columns than the header.
    protected function removeIncompleteRows()
    {
        $row = $this->table_details;
        $row_count = count($row);
        for ($i = 0; $i < $row_count; $i++) {
            if (count($row[$i]) !== count($this->table_headers)) {
                    unset($row[$i]);
            }
        }
        $this->table_details = array_values($row);
    }
}
