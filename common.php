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
function getLastInsert($tbl, $yrFieldName, $monFieldName, $yer, $mnth)
{
    $db = Db::getInstance();
    $sql = "select * from $tbl where $yrFieldName='$yer' and $monFieldName='$mnth' ";
    $row = $db->query($sql);
    return $row;
}
// function showmsg($type, $msg, $exit)
// {
//     $ar['msg'] = $msg;
//     Render::render("message/$type.php", $ar);
//     if ($exit) {
//         exit;
//     }
// }
