<?php
session_start();
echo(var_dump($_SESSION));
$method = $_SERVER["REQUEST_METHOD"];

// Соединение, выбор базы данных
$dbconn = pg_connect(getenv("DATABASE_URL"))
    or die('Не удалось соединиться: ' . pg_last_error());
// Выполнение SQL-запроса
$query = 'SELECT * FROM codes';
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

// Вывод результатов в HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Очистка результата
pg_free_result($result);

// Закрытие соединения
pg_close($dbconn);


?>