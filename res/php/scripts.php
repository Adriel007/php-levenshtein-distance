<?php
header('Content-Type: application/json; charset=utf-8');
mb_internal_encoding('UTF-8');
include(dirname(__DIR__) . '/machine-learning/levenshtein-distance.php');
error_reporting(0);

if (isset($_FILES['file'])) {
    $tmp = $_FILES['file']['tmp_name'];
    $content = json_decode(file_get_contents($tmp), true);
    $jsonResult = json_encode(['result' => distance($content['str1'], $content['str2'])], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if ($jsonResult === false)
        echo json_encode(['error' => json_last_error_msg()], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    else
        echo $jsonResult;
} else
    echo json_encode(['error' => 'Nenhum arquivo foi enviado'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

function distance($str1, $str2)
{
    return LevenshteinDistance($str1, $str2);
}