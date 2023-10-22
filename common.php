<?
function dump($var, $return = false)
{
    if (is_array($var)) {
        $out = print_r($var, true);
    } else if (is_object($var)) {
        $out = var_export($var, true);
    } else {
        $out = $var;
    }

    if ($return) {
        return "\n<pre>$out</pre>\n";
    } else {
        echo "\n<pre>$out</pre>\n";
    }
}


function br()
{
    echo "<br>\n";
}
function getFullUrl()
{
    return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
function getRequestUri()
{
    return  $_SERVER['REQUEST_URI'];
}


function getBaseUrl()
{
    return "/MonthStatisticsByMVC/";
}
function getBaseUrlNoLastslash()
{
    return "/MonthStatisticsByMVC";
}

function strHas($str, $srch, $caseSensitive = false)
{
    if ($caseSensitive) {
        return strpos($str, $srch) !== false;
    } else {
        return strpos(strtolower($str), strtolower($srch)) !== false;
    }
}
function connectiondb($options = null)
{
    if ($options == null) {

        $s = 'localhost';
        $u = 'root';
        $p = ")NvD]JBPdI3YjJYs";
        $db = 'bakhshnamehsandogh';
    } else {
        $s = $options['host'];
        $u = $options['user'];
        $p = $options['pass'];
        $db = $options['dbname'];
    }
    // Create connection
    $connect = new mysqli($s, $u, $p, $db);
    // Check connection
    if ($connect->connect_error) {
        echo "Connection failed: " . $connect->connect_error;
    }
}
