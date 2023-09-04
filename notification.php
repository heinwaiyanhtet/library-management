<?php

include 'header.php';
include 'navbar.php';
include 'function.php';
include 'database_conn.php';

session_start();

if(!isset($_SESSION['user_id']))
{
    header('location:login.php'); 
}


?>


<?php

    $userId = $_SESSION['id'];

    $query = 
    "
        SELECT b.userId, b.borrowedDate, bk.bookUrl
        FROM borrowed b
        JOIN books bk ON b.bookId = bk.id
        WHERE b.userId = :userId
        AND b.borrowedDate + INTERVAL 3 DAY < CURRENT_DATE
    ";
    

    $stmt = $pdo->prepare(
        $query
    );

    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php foreach ($users as $user) { ?>

    <div class="alert alert-warning mt-3" role="alert">
            Due date for <?php 
                        $bookName = $user['bookUrl'];
                        echo fileNameWithoutExtension($bookName);
                    ?>, book  you have to pay for $ 
            <?php 

                $borrowedDate = $user['borrowedDate'];
                $currentDate = currentDate();

                $numberOfDaysOverdue = (strtotime($currentDate) - strtotime($borrowedDate)) / 86400;
                echo calcuateFine($numberOfDaysOverdue);
            ?>
    </div>

<?php } ?>




<?php

    include 'footer.php';

?>
