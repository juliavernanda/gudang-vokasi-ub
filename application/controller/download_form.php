<?php

    $filename    = "Form Permintaan.docx";

    $back_dir    ="../../assets/";
    $file = $back_dir.$filename;

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        exit;
    }
    else {
        echo "Oops! File - $filename - not found ...";
//        header("Location:./../index.php?page=dasbor");
    }

?>