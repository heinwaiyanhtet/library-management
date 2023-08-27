<?php
    include 'database_conn.php'; 
    include 'function.php';

    if (isset($_POST['bookId']) and isset($_POST['borrowedId'])) 
    {

        try {

        //  $bookQuery = 
        //     "
        //         UPDATE books
        //         SET isBorrowed = false
        //         WHERE id = :bookId;
        //      ";
    
        //     $statement = $pdo->prepare($bookQuery);
    
        //     $bookId = $_POST['bookId'];

        //     $statement->bindParam(':bookId', $bookId);

        //     $statement->execute();
            
        
            $currentDate = currentDate();
            
            $borrowedId = $_POST['borrowedId'];


            // $currentDate =  date('Y-m-d H:i:s');

            $borrowQuery = 
            "
                UPDATE borrowed
                SET returnedDate = $currentDate
                WHERE id = :borrowedId;
            ";


        $statement->bindParam(':borrowedId', $borrowedId);

         $statement->execute();



        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

       




    }


?>