<?php
namespace Fleaflicker;

class Fleaflicker
{
    protected $base_url;
    protected $league_type;

    public function __construct($league_type)
    {
        $this->league_type = $league_type;
        $this->base_url = "https://www.fleaflicker.com/{$this->league_type}";
    }

    //returns value of property
    public function get($property)
    {
        return $this->$property;
    }

    //converts table rows (<TR></TR>) into an array strings
    protected static function convertRowstoArray($html)
    {
        $array = explode("</tr>", $html);

        return $array;
    }

    //returns HTML as string
    protected static function getHTML($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        $html = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($status != 200) {
            echo "Double check your league id.";
            exit;
        } else {
            return $html;
        }
        
        return $html;
    }
}
