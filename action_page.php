<?php
   $con = mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password

        if connection fails it will stop loading the page and display an error
    */

    mysqli_select_db($con, "university") or die(mysqli_error($con));
    /* tutorial_search is the name of database we've created */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
    $query = $_POST['query'];
    // gets value sent over search form


        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection

        $raw_results = mysqli_query($con,"SELECT * FROM `users` WHERE (`COL 3` LIKE '%".$query."%')") or die(mysqli_error($con));

        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'

        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop

                echo "<p><h3>Career: ".$results['COL 3']."</h3>Major: ".$results['COL 5']."</p>";
                echo "<p> Education: ".$results['COL 6']."<br>Category: ".$results['COL 2']."</p>";

                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }

        }
        else{ // if there is no matching rows do following
            echo "No results";
        }


?>
</body>
</html>
