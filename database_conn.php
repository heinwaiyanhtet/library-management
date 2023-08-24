<?php
    $servername = "localhost";
    $username = "hwyh-dev";
    $password = "pass_12ABC";
    $database_name = "library_management";

    try {

        $pdo = new PDO("mysql:host=$servername;dbname=$database_name", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $query = "SELECT * FROM books";


        // $statement = $pdo->prepare($query);
        // $statement->execute();

        // // Fetch all rows as associative arrays
        // $books = $statement->fetchAll(PDO::FETCH_ASSOC);

        // // Process the $books array
        // foreach ($books as $book) {
        //     // Access individual columns like $book['column_name']
        //         echo $book['bookName'];
        //     // echo "Title: " . $book['bookName'] . "<br>";
        //     // echo "Is Borrowed: " . ($book['isBorrowed'] ? 'Yes' : 'No') . "<br>";
        //     // echo "Description: " . $book['description'] . "<br>";
        //     // echo "<br>";
        // }


        // echo "sccess";
    } 
    catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // echo "sccess2";


?>