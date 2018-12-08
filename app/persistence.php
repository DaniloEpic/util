<?php
define("DB_CONF",PROJECT_ADDRESS."/app/db/conexao.json");

function set_db_connection() {
require_once PROJECT_ADDRESS."/lib/classes/MySQLPersistence.php";
return MySQLPersistence::getInstance(DB_CONF);
}

function set_formato_data($f) {
MySQLPersistence::$formato_data = $f;
}
?>