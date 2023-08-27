<!-- 

    borrow ငှားထားတဲ့  dateကို update လုပ်ရန်ကျန်ရှိ

 -->


<?php
    include 'database_conn.php'; // Include your database connection file

    session_start();

    if (isset($_POST['id'])) {
        try {

            $borrowedDate = date('Y-m-d H:i:s');
            $id = $_POST['id'];

            $stmt = $pdo->prepare(
                "UPDATE books SET isBorrowed = true  WHERE id = :id"
            );


            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Add success response or further processing if needed
        } catch (PDOException $e) {
            // Handle the exception, e.g., log the error or send a meaningful error response
            echo "Error: " . $e->getMessage();
        }
    }
?>
