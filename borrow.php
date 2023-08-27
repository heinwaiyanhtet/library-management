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


try {

    $userId = $_SESSION['id'];

    $query = "
        SELECT b.id, b.bookUrl, u.userName, b.borrowedDate, b.returnedDate
        FROM books b
        LEFT JOIN user u ON b.userId = u.id
        WHERE u.id = $userId;
    ";

    $statement = $pdo->prepare($query);

    $statement->execute();

    $books = $statement->fetchAll(PDO::FETCH_ASSOC);

    var_dump($books);
?>



<section class="container-fluid mt-3">

<div class="row">

    <h6 class="text-center text-primary text-decoration-underline mb-1"> Borrowed & Returned Form</h6>

    <?php foreach ($books as $book) { ?>

    <div class="col-3">

        <div class="card" style="width: 18rem;">
            <img src="<?php echo book_url();echo $book['bookUrl'];?>" height = "200px" class="card-img-top" alt="books photo">

            <div class="card-body">

                <p>
                  borrowedDate -  <?php echo $book['borrowedDate'] ?>


                </p>


                
            </div>
                <?php }?>
   
</section>

<?php

} catch (\Throwable $th) {
    //throw $th;
}


?>

<?php

    include 'footer.php';

?>
