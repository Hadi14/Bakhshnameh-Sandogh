<?
session_start();
if (!isset($_SESSION['uname'])) {
    header("Location:index.php");
}
if (isset($_GET['upfile'])) {
    uploadPdf();
} elseif (isset($_GET['rename'])) {
    renamePDF();
} elseif (isset($_GET['delete'])) {
    $filename = $_POST['delfilename'];
    RemovePDF($filename);
}
/**************** Remove PDF Function *************************** */
function RemovePDF($file)
{
    $fileNm = preg_replace("/\xC2\xA0/", " ", $file);
    @unlink("./uploads/" . $fileNm);
}
/**************** Rename PDF Function *************************** */
function renamePDF()
{
    $path = "./uploads/";
    $old = $_POST['oldname'];
    $new =  $_POST['newName'] . ".pdf";
    rename($path . $old, $path . $new);
}
/**************** Upload PDF Function *************************** */
function uploadPdf()
{
    $target_dir = "uploads/";
    $pureName = basename($_FILES["fileToUpload"]["name"]);
    $sepName = explode('.', $pureName);
    $fileName = $sepName[0] . '.pdf';
    $exten = strtolower($sepName[1]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        $uploadOk = 0;
        echo "<script>alert('این فایل وجود دارد لطفا فایل دیگری آپلود نمائید.!!!')</script>";
    } else if (!($_FILES["fileToUpload"]["name"])) {
        // echo "Sorry, No file selected. Please Select a file.";
        echo "<script>alert('هیچ فایلی برای آپلود انتخاب نشده است. لطفا فایلی را انتخاب کنید.!!!')</script>";
        $uploadOk = 0;
    }
    // Check file size
    else if ($_FILES["fileToUpload"]["size"] > 15000000) {
        // echo  $_FILES['fileToUpload']['size'] .  "******Sorry, your file is too large.";
        echo "<script>alert('حجم فایل انتخاب شده بیشتر از مقدار مجاز است. لطفا فایلی با حجم کمتر از 15 مگا بایت انتخاب کنید.!!!')</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    else if ($exten != "pdf") {
        // echo "Sorry, only PDF files are allowed.";
        echo "<script>alert('فرمت فایل انتخاب شده مجاز نمی باشد. لطفا فایل با فرمت pdf انتخاب کنید.!!!')</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //     echo "Sorry, your file was not uploaded.";
    //     // if everything is ok, try to upload file
    // }

    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            echo "<script>alert('فایل مورد نظر با موفقیت آپلود شد.')</script>";
        } else {
            // echo "Sorry, there was an error uploading your file.";
            echo "<script>alert('خطایی هنگام آپلود فایل رخ داد لطفا مجددا سعی نمائید.!!!')</script>";
        }
    }
}
/****************************************************************************** */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="js/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons-1.11.1/bootstrap-icons.css">
    <link type="text/css" href="css/style.css" rel="stylesheet" />
    <link type="text/css" href="css/upload.css" rel="stylesheet" />
    <script src="js/jquery-3.7.0.js"></script>
    <title>Document</title>
</head>

<body>

    <div class="container-uploadtbl">
        <div class="logout">
            <a href="logout.php"><i class="bi bi-box-arrow-left mx-3"></i></a>
            <a href="index.php"><i class="bi bi-house-fill mx-3"></i></a>
        </div>
        <div class="logout"></div>
        <div class="frm  py-5">
            <form action="upload.php?upfile=up" method="post" enctype="multipart/form-data">
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
                        $dirpath  = "./uploads";
                        $files = scandir($dirpath);
                        $count = 1;
                        foreach ($files as $file) {
                            $filePath = "./uploads" . '/' . $file;
                            if (is_file($filePath)) {
                                $rest = str_replace(' ', '&nbsp;', $file);
                                $path = "./uploads/" . $file;
                                $filenameNoExten = substr($file, 0, strlen($file) - 4);
                                echo "<tr> 
                                    <td class='column1'>" . $count++ . "</td> 
                                    <td class='column2'>" . $filenameNoExten . "</td> 
                                    <td class='column3'> <a class='dl' href='./downloadfile.php?file=$file'  >دانلود</a> </td>
                                    <td class='column3'> <a class='dl' data-bs-toggle='modal' data-bs-target='#renameModal' onclick=LoadnameFile('$rest') href='' ><i class='bi bi-pencil-square'></i></a> </td>
                                    <td class='column3'> <a class='dl' data-bs-toggle='modal' data-bs-target='#deleteModal' onclick=LoadnameFiledel('$rest') href=''  ><i class='bi bi-trash3'></i></a> </td>
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
                    <form method="post" action="upload.php?rename=true">
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
    <!--------------------------- deleteModal modal  ------------------------------------------------------------------------->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" dir="rtl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="otherModalLabel">حذف فایل</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="upload.php?delete=true">
                        <div class="mb-0">
                            <label class="col-form-label">آیا مطمئن هستید که میخواهید این فایل را حذف کنید؟</label>
                            <input id="delfilename" name="delfilename" type="text">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="بله">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خیر</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------- End of Modal ----------------------------------------------------------->
    <!--------------------------- status upload modal  ------------------------------------------------------------------------->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" dir="rtl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="otherModalLabel"> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="upload/renamePDF">
                        <div class="mb-0">
                            <label id="notemodal" for="recipient-name1" class="col-form-label"></label>
                        </div>
                        <div class="modal-footer">
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
        res = res.replace(/\u00A0+/g, "\u0020");
        $('#otherrecipientName1').val(res.substr(0, res.length - 4));
        $('#oldname').val(res);
    }

    function LoadnameFiledel(file) {
        $('#delfilename').val(file);
    }
</script>
<script src="js/bootstrap.bundle.min.js"></script>