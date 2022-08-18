<?php

//open connection to mysql db
    $connection = mysqli_connect("Host","User","password","database") or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
    $sql = $_POST['query'];
    if ($_POST['query'] != "") {
    
    $start = hrtime(true);
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
    $end = hrtime(true); 

    print "Time to Execute(ms): ";
    $delta = ($end - $start)/1000000; 
    print $delta;
    
//Create an array with query results
    print "<br> <br> Result: <br>";
    $resultarr = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $resultarr[] = $row;
    }
    
    echo json_encode($resultarr);

    mysqli_close($connection);
    $_POST['query'] = "";
    }
?>

<h1>MySQL-In App Query Testing</h1>
<p>
Enter a mySQL query & return the results & execution time.
</p>

<form method="post" action="">
<input type="text" name="query">
<input type="submit">
</form>

