<?php


function parseUrlParams($url) {
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    return $params;
}

function createDirIfNotExist($dirname) {
    if (!file_exists($dirname) || !is_dir($dirname)) {
        mkdir($dirname, 0777, true);
    }
}