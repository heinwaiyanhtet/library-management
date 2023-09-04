<?php

include 'header.php';
include 'navbar.php';
include 'function.php';
include 'database_conn.php';


session_start();

if(!isset($_SESSION['user_id']) && $_SESSION[role] == "admin")
{
    header('location:login.php'); 
}


$query = "SELECT * from user";

$statement = $pdo->prepare($query);

// $userId = $_SESSION['id'];
// $statement->bindParam(':userId', $userId);

$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="container-fluid mt-3">

<div class="row">

    <h6 class="text-center text-primary text-decoration-underline mb-2"> userList</h6>


        <table class="table">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">userName</th>
                <th scope="col">role</th>
                <th scope="col">startDate</th>
                <th scope="col">endDate</th>
                
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['id'] ?></th>
                    <td><?php echo $user['userName'] ?></td>
                    <td><?php echo $user['role']?></td>
                    <td><?php echo $user['startDate']?></td>
                    <td><?php echo $user['endDate']?></td>

                </tr>
            <?php }?>
            </tbody>
            </table>

  
   
</section> 

<?php

    include 'footer.php';

?>
