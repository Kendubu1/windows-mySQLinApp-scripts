
<?php
define('ENV_STR', 'MYSQLCONNSTR_localdb');

$return = array('result' => false);

if (isset($_SERVER[ENV_STR])) {
    $connectStr = $_SERVER[ENV_STR];

    $return['connection'] = array(
        'host' => preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $connectStr),
        'database' => preg_replace("/^.*Database=(.+?);.*$/", "\\1", $connectStr),
        'user' => preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $connectStr),
        'password' => preg_replace("/^.*Password=(.+?)$/", "\\1", $connectStr)
    );

    $return['result'] = true;
}

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

header('Content-Type: application/json; charset=utf-8');
echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
echo json_encode($return);
mysqli_close($link);

