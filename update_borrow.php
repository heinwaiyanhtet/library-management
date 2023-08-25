<?php
    include 'database_conn.php'; // Include your database connection file

    if (isset($_POST['id'])) {
        try {
            $id = $_POST['id'];

            $stmt = $pdo->prepare(
                "UPDATE books SET isBorrowed = true WHERE id = :id"
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
