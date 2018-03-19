<?php
function searchAndReplace($htmlfile,$directory,$path)
{
    require_once 'htmlParser.php';
    $html = $htmlfile;
    $arrayFile = array_slice(scandir($directory), 2);
    $htmlDocument = file_get_contents($html);
    $path = $path;
    $arrayBase64String = htmlParsToArray($html);
    $base64 = [];
    $hesh = [];
    $extension = [];

    foreach ($arrayBase64String as $base64String) {

        $base64StringWithData = substr($base64String, 5);
        $arrayFileExtensionAndBase64 = explode(",", $base64StringWithData);
        $base64[] = md5(base64_decode($arrayFileExtensionAndBase64[1]));

    }

    foreach ($arrayFile as $file) {

        $heshName = explode('.', $file);
        $hesh[] = $heshName[0];
        $extension[] = $heshName[1];

    }
    $quantityBase64 = count($base64);
    $quantityHesh = count($hesh);
    $arrayHesh = [];
    for ($i = 0; $i < $quantityBase64; $i++) {

        for ($v = 0; $v < $quantityHesh; $v++) {

            if ($base64[$i] == $hesh[$v]) {

                $arrayHesh[] = $path . $hesh[$v] . '.' . $extension[$v];

            }
        }
    }
    $htmlDocumentNew = str_replace
    (
        $arrayBase64String, $arrayHesh, $htmlDocument
    );
    file_put_contents($html, $htmlDocumentNew);
return;
}

