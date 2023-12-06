<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>بخشنامه های صندوق امداد ولایت</title>
    <link type="text/css" href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-icons-1.11.1/bootstrap-icons.css">
</head>

<body id="indexbody">
    <div class="loginbar">
        <a href="./loginadmin.php"><i class="bi bi-person-circle"></i></a>
    </div>
    <div class="limiter">

        <div class="container-table100">
            <div class="title">
                <h1>سامانه بخشنامه های صندوق امداد ولایت</h1>
                <h3>کمیته امداد امام خمینی(ره) استان چهارمحال و بختیاری</h3>
            </div>
            <div class="wrap-table100">
                <div class="table100">
                    <table>
                        <thead>
                            <tr class="table100-head">
                                <th class="column1">ردیف</th>
                                <th class="column2">نام بخشنامه</th>
                                <th class="column3">دانلود بخشنامه</th>
                                <th class="column3">نمایش بخشنامه</th>
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
                                    // $rest = str_replace(' ', '&nbsp;', $file);
                                    $path = "./uploads/" . $file;
                                    $filenameNoExten = substr($file, 0, strlen($file) - 4);
                                    // echo "<a class='dl'  href='" . getBaseUrl() . "downloadfile/downloadPDF/$file' >" . $file . "</a>" . "&nbsp;&nbsp;&nbsp;" . "<a class='del'  href='" . getBaseUrl() . "upload/RemovePDF/$file' >Delete</a>" . "&nbsp;&nbsp;&nbsp;" . "<a data-bs-toggle='modal' data-bs-target='#renameModal' class='del'  onclick=LoadnameFile('$rest') href='' >Rename</a>";
                                    echo "<tr> 
                                    <td class='column1'>" . $count++ . "</td> 
                                    <td class='column2'>" . $filenameNoExten . "</td> 
                                    <td class='column3'> <a class='dl' href='./downloadfile.php?file=$file'  >دانلود</a> </td>
                                    <td class='column4'> <a class='dl' href='./readpdf.php?file=$file'  >نمایش</a></td>
                                    </tr>";
                                }
                                for ($i = 0; $i < strlen($file); $i++) {
                                    echo " - " ."<b>$file[$i]:</b>". ord($file[$i]);
                                }
                                echo "<hr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>