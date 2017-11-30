# FleaFlicker w/ Rankings

This project intends to combine a FleaFlicker league with some data from ranking sites (DynastyLeagueFootball / DynastyFFTools / etc.).

The plan is to be able to be able to compare your Fleaflicker team with other teams in your Fleaflicker league using the ranking data. This data could be used to evaluate trades, see where you could improve, etc.


## System Setup

1. <strong>Redirect All Requests To Index.php Using .htaccess</strong>
    * [Helpful guide for Apache](http://jrgns.net/redirect_request_to_index/index.html)
2. <strong>Use two RewriteRules to pass the requested path to index.php as the parameter "q", appending any query string, excluding anything in the /css /js /img directories</strong>

    <em>Apache example:</em>
    <pre>RewriteEngine on</pre>
    <pre>RewriteCond %{REQUEST_URI} ^/(css|js|img)/.*</pre>
    <pre>RewriteRule ^(.*)$ $1</pre>

    <pre>RewriteCond %{REQUEST_FILENAME} !-d</pre>
    <pre>RewriteCond %{REQUEST_FILENAME} !-f</pre>
    <pre>RewriteRule ^(.*)$ /index.php?q=$1 [L,QSA]</pre>
3. <strong>Ensure web server has PHP 5.6 enabled</strong>
4. <strong>Point the DocumentRoot to the /web directory.</strong>
