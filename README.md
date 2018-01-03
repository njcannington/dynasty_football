# FleaFlicker w/ Rankings

This project intends to combine a FleaFlicker league with data from ranking sites (DynastyLeagueFootball / DynastyFFTools / etc.). Currently it only uses DynastyLeagueFootball (DLF) rankings. Setup requires a DLF and FleaFlicker account.

The plan is to be able to be able to compare your Fleaflicker team with other teams in your Fleaflicker league using the ranking data. This data could be used to evaluate trades, see where you could improve, etc.


## Setup
1. <strong>PHP 5.6 </strong>
    * needed modules: 
        * php5.6-mysql, php5.6-xml, php5.6-zip, php5.6-curl
2. <strong>Apache 2.4.\*</strong>
    * needed modules: 
        * mod_rewrite
    * set AllowOverride to All
    * point the DocumentRoot to the /web directory within project
3. <strong>MySQL 5.7.20</strong>
    * create database and add credentials to /config app.ini files (dev or prod -- see Configuration 1)
4. <strong>Composer</strong>
    * after installation run "composer update" within the project's root directory

## PHPUnit
<strong>Since we're using a custom autoload file, be sure to include autoload.php when running phpunit</strong>
<pre> phpunit --bootstrap autoload.php tests/path/testfileTest.php </pre>

## Configuration (app.{dev}.ini)
1. <strong>The environment is set automatically based on the domain. If using .localhost domain, the environment will be set to "dev". All other domains will use "prod" settings.</strong>
2. <strong>Obtaning DLF cookie w/ Chrome</strong>
    * log in to dynastyleaguefootball.com with paid account
    * ensure you're on the main site and open up the Developer Tools (view > developer > developer tools)
    * click the "network" tab
    * refresh the page
    * under the "name" column within the "network" tab, click dynastyleaguefootball.com
    * view the "Request Headers" area under the "headers" tab
    * copy the portions of the cookie that includes amember_ru, amember_rp, and wordpress_logged_in_*
    * paste the copied data into .ini fille (for DLF cookie) adding, "path=/; domain=.dynastyleaguefootball.com; Expires=Tue, 19 Jan 2038 00:00:00 GMT;"
    *The entire cookie will look something like this witin your .ini file*
    <pre>"wordpress_logged_in_RanDomStr1ng=usernameFOLLOWEDbyAlotOFCharacTER5; amember_ru=username; amember_rp=RanDomHA; path=/; domain=.dynastyleaguefootball.com; Expires=Tue, 19 Jan 2038 00:00:00 GMT;"</pre>