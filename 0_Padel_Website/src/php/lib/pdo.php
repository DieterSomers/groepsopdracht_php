<?php
function GetData( $sql )
{
    require_once 'connection_data.php';
    global $servername, $dbname, $username, $password;
    // Create and check connection
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    //define and execute query
    $result = $conn->query( $sql );

    //show result (if there is any)
    if ( $result->rowCount() > 0 )
    {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows;
    }
    else
    {
        $conn = null;
        return [];
    }

}

?>
