<?php


function parseUrlParams($url) {
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    return $params;
}