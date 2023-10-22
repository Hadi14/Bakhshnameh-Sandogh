<?
session_start();
if (!isset($_SESSION['uname'])) {
    header("Location:index.php");
}
// echo "USENAME :" . $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="js/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons-1.11.1/bootstrap-icons.css">
    <link type="text/css" href="css/style.css" rel="stylesheet" />
    <script src="js/jquery-3.7.0.js"></script>
    <title>Document</title>
</head>

<body>

    <div class="container-uploadtbl">
        <div class="logout">
            <a href="logout.php"> <i class="bi bi-box-arrow-left"></i> </a>
            <a href="index.php"> <i class="bi bi-house-fill"></i></a>
        </div>
        <div class="logout"></div>
        <div class="frm  py-5">
            <form action="" method="post" enctype="multipart/form-data">
                فایل خود را برای آپلود انتخاب کنید.
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input style="border: 1px solid black !important;" type="submit" value="ارسال فایل" name="submit">

            </form>
        </div>
        <div class="wrap-table100">
            <div class="table100">
                <table>
                    <thead>
                        <tr class="table100-head">
                            <th class="column1">ردیف</th>
                            <th class="column2">نام بخشنامه</th>
                            <th class="column3">دانلود</th>
                            <th class="column4">تغییر نام</th>
                            <th class="column5">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        require_once("common.php");
                        // echo "<br>";
                        $dirpath  = "./uploads";
                        $files = scandir($dirpath);
                        // dump($files);
                        $count = 1;
                        foreach ($files as $file) {
                            // $rest = substr($file, 0, -4);
                            // echo $rest;
                            // $rest = explode('.', $file);
                            // dump($rest);
                            $filePath = "./uploads" . '/' . $file;
                            if (is_file($filePath)) {
                                $rest = str_replace(' ', '&nbsp;', $file);
                                $path = "./uploads/" . $file;
                                $filenameNoExten = substr($file, 0, strlen($file) - 4);
                                // echo "<a class='dl'  href='" . getBaseUrl() . "downloadfile/downloadPDF/$file' >" . $file . "</a>" . "&nbsp;&nbsp;&nbsp;" . "<a class='del'  href='" . getBaseUrl() . "upload/RemovePDF/$file' >Delete</a>" . "&nbsp;&nbsp;&nbsp;" . "<a data-bs-toggle='modal' data-bs-target='#renameModal' class='del'  onclick=LoadnameFile('$rest') href='' >Rename</a>";
                                echo "<tr> 
                                    <td class='column1'>" . $count++ . "</td> 
                                    <td class='column2'>" . $filenameNoExten . "</td> 
                                    <td class='column3'> <a class='dl' href='./downloadfile.php?file=$file'  >دانلود</a> </td>
                                    <td class='column3'> <a class='dl' data-bs-toggle='modal' data-bs-target='#renameModal' onclick=LoadnameFile('$rest') href='' ><i class='bi bi-pencil-square'></i></a> </td>
                                    <td class='column3'> <a class='dl' href='./deletefile.php?file=$file'  ><i class='bi bi-trash3'></i></a> </td>
                                    </tr>";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--------------------------- other Edit modal  ------------------------------------------------------------------------->
    <div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" dir="rtl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="otherModalLabel">ویرایش نام فایل</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="upload/renamePDF">
                        <div class="mb-0">
                            <label id="otherfiledlabel" for="recipient-name1" class="col-form-label">نام فایل:</label>
                            <input id="otherrecipientName1" name="newName" type="text" class="form-control">
                            <input id="oldname" name="oldname" type="hidden">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="ویرایش">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خروج</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------- End of Modal ----------------------------------------------------------->
</body>

</html>


<script>
    function LoadnameFile(res) {
        $('#otherrecipientName1').val(res.substr(0, res.length - 4));
        $('#oldname').val(res);
        // console.log($('#oldname').val());
    }
</script>
<script src="js/bootstrap.bundle.min.js"></script>