<?php
    include 'database_conn.php'; // Include your database connection file
    include 'function.php';

    ini_set('display_errors', 1);
error_reporting(E_ALL);


    if (isset($_POST['bookId']) and isset($_POST['borrowedId'])) 
    {

        try {

         $bookQuery = 
            "
                UPDATE books
                SET isBorrowed = false
                WHERE id = :bookId;
             ";
    
            $statement = $pdo->prepare($bookQuery);
    
            $bookId = $_POST['bookId'];

            $statement->bindParam(':bookId', $bookId);

            $statement->execute();

            $borrowQuery = 
            "
                UPDATE borrowed
                SET returnedDate = :currentDate
                WHERE id = :borrowedId;
            ";

            $statement = $pdo->prepare($borrowQuery);

            $currentDate = currentDate();
            $statement->bindParam(':currentDate', $currentDate);

            $borrowedId = $_POST['borrowedId'];
            $statement->bindParam(':borrowedId', $borrowedId);


            $statement->execute();


            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

    }




?>

