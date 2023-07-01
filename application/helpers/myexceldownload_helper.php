<?php
function force_download($filename, $data)
{
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . strlen($data));
    header('Connection: close');

    echo $data;
    exit();
}
