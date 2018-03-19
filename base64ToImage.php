<?php
require_once 'htmlParser.php';
require_once 'searchAndReplace.php';
/**
 * Encode base64 given array
 * @param $arrayBase64String array list of the strings
 * @param $pathToSave string path to save the file
 * @return array all saved files
 */
function base64StringToFile($arrayBase64String, $pathToSave)
{
    $result = [];
    foreach ($arrayBase64String as $base64String) {
        $base64StringWithData = substr($base64String, 5);
        $arrayFileExtensionAndBase64 = explode(",", $base64StringWithData);
        $base64 = $arrayFileExtensionAndBase64[1];
        $FileExtension = substr($arrayFileExtensionAndBase64[0], 6);
        $FileExtension = explode(";", $FileExtension);
        $extension = $FileExtension[0];
//            print_r($extension.'<br>');
//            print_r($imageName.'<br>');
        $imageNameMd5 = md5(base64_decode($base64));
        $imageName = $pathToSave . $imageNameMd5 . "." . $extension;
        $result[] = $imageName;
//            print_r($result);
//            print_r($tmpImageName);
//            md5(base64_decode($base64))
        if (file_exists($imageName)){
            echo $imageName.'Уже сушествует';
        }
        else {
            file_put_contents($imageName, base64_decode($base64));
        }
    }
    return $result;
}

