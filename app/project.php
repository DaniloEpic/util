<?php
$dir = explode("/",$_SERVER["PHP_SELF"]);
define("PROJECT_ADDRESS",$_SERVER["DOCUMENT_ROOT"]."/".$dir[1]);

function getController($n) {
$n = ucfirst(strtolower($n))."Controller";
require PROJECT_ADDRESS."/app/controllers/".$n.".php";
$c = new ReflectionClass($n);
$m = $c->getMethod("init");
$m->invoke(NULL);
}

function not_found_header() {
header("HTTP/1.1 404 Not Found");
}

function bad_request_header() {
header("HTTP/1.1 400 Bad Request");
}

function exception_header() {
header("HTTP/1.1 299 Exception");
}

function ok_header() {
header("HTTP/1.1 200 Ok");
}

function created_header() {
header("HTTP/1.1 201 Created");
}

function unauthorized_header() {
header("HTTP/1.1 401 Unauthorized");
}

function forbiden_header() {
header("HTTP/1.1 403 Forbiden");
}

function jwt_secret_key() {
return file_get_contents(PROJECT_ADDRESS."/app/keys/jwt-secret");
}
?>