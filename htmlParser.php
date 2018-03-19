<?php
function htmlParsToArray($html)
{
    $htmlDocument = file_get_contents($html);
    $arrayBase64String = [];
    preg_match_all('<img\s+((src)="[^"]+"\s*)+>', $htmlDocument, $arrayCrsBase64);
    foreach ($arrayCrsBase64[1] as $strCrsBase64) {
        $base64StringWithTrash = substr($strCrsBase64, 4);
        $base64String = trim(trim($base64StringWithTrash), '".." ');
        $arrayBase64String[] = $base64String;
    }
    return $arrayBase64String;
}



