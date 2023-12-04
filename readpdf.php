<button>بازگشت</button>
<?
$fileNm =  rawurldecode($_GET['file']);
$fileName = basename($fileNm);
$filePath = "./uploads/$fileNm";
/***************************************** */
header("Content-Type: application/pdf");
header("Content-Disposition:inline; filename=$fileName");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges:bytes");
@readfile($filePath);
