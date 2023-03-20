<?php 
include "../../model/model.php"; 
include "../../model/mediaable/mediaable.php";

$file = $_FILES['file'];
$fileModelId = $_POST['model_id'];
$fileModelName = $_POST['model_name'];

if(empty($file['name']))
{
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo json_encode(array('error' => implode("\n", $errors)));
}
$media = new mediaable(); 
$media->uploadMedia($file, $fileModelId, $fileModelName);
?>