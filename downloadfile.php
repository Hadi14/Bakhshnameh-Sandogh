<?
$fileNm =  rawurldecode($_GET['file']);
$fileName = basename($fileNm);
$filePath = "./uploads/$fileNm";
/***************************************** */
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$fileName");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");
/********************************************** */
readfile($filePath);
