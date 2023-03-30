<?php

function formatTitle($filename) {
    $title = pathinfo($filename, PATHINFO_FILENAME);
    $title = preg_replace('/[-_]/', ' ', $title);
    $title = ucwords($title);
    return $title;
}

function getFilesSortedByName($folder, $extension) {
    $files = glob($folder . '/*.' . $extension);

    usort($files, function($a, $b) {
        return strcmp($a, $b);
    });

    return $files;
}

$folder = __DIR__;
$mp3_files = getFilesSortedByName($folder, 'mp3');

$result = [];

foreach ($mp3_files as $file) {
    $file_path = basename($file);
    $result[] = [
        'title' => formatTitle($file_path),
        'path' => $file_path
    ];
}

header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>
