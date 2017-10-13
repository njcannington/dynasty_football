# FleaFlicker w/ Rankings

This project intends to combine a FleaFlicker league with some data from ranking sites (DynastyLeagueFootball / DynastyFFTools / etc.).

The plan is to be able to be able to compare your Fleaflicker team with other teams in your Fleaflicker league using the ranking data. This data could be used to evaluate trades, see where you could improve, etc.


## System Setup

1. <strong>Redirect All Requests To Index.php Using .htaccess</strong>
    * [Helpful guide for Apache](http://jrgns.net/redirect_request_to_index/index.html)
2. <strong>Use RewriteRule to pass the requested path to index.php as the parameter "q", appending any query string.</strong>

    <em>Apache example:</em>
    <pre>RewriteRule ^(.*)$ index.php?q=$1 [L,QSA]</pre>
3. <strong>Ensure web server has PHP 5.6 enabled</strong>
