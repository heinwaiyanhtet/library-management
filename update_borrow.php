<!-- 

    borrow ငှားထားတဲ့  userIdကို update လုပ်ရန်ကျန်ရှိ

 -->

<?php
    include 'database_conn.php'; // Include your database connection file

    session_start();

    if (isset($_POST['id'])) {
        try {

            $id = $_POST['id'];

            $stmt = $pdo->prepare(
                "UPDATE books SET isBorrowed = true  WHERE id = :id"
            );

            $stmt->bindParam(':id', $id);
            $stmt->execute();


            $insertStmt = $pdo->prepare
            (
                "INSERT INTO borrowed (bookId, userId, borrowedDate)
                VALUES (:bookId, :userId, :borrowedDate)"
            );

            $insertStmt->bindParam(':bookId', $id);

            $userId = $_SESSION['id'];
            $insertStmt->bindParam(':userId', $userId);

            $borrowedDate = date('Y-m-d H:i:s');
            $insertStmt->bindParam(':borrowedDate', $borrowedDate);

            $insertStmt->execute();

            // Add success response or further processing if needed
        } catch (PDOException $e) {
            // Handle the exception, e.g., log the error or send a meaningful error response
            echo "Error: " . $e->getMessage();
        }
    }
?>
