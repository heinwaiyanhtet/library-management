<?php

    include 'header.php';
    include 'function.php';
    include 'database_conn.php';


    try {
        
        $query = "SELECT * FROM books";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    ?>

<section class=container-fluid>

    <div class="row">
        <?php foreach ($books as $book) { ?>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo book_url();echo $book['bookName'];?>" height = "200px" class="card-img-top" alt="books photo">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php 
                            $fileName = $book['bookName'];
                            echo fileNameWithoutExtension($fileName);
                        ?>
                    </h5>
                    <a href="#" class="btn btn-primary  btn-sm">Borrow</a>
                </div>
            </div>
        </div>
    </div>


       
    </section>
<?php
        }
    } catch (PDOException $e) 
    {

        echo "Query execution failed: " . $e->getMessage();
    }


?>



<?php
    include "footer.php";
?>