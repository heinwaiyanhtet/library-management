<?php

    include 'header.php';
    include 'navbar.php';
    include 'function.php';
    include 'database_conn.php';

    if(!isset($_SESSION['user_id']))
    {
        header('location:login.php'); 
    }


    try {
        
        $query = "SELECT * FROM books";

        $statement = $pdo->prepare($query);

        $statement->execute();

        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    ?>

<section class="container-fluid mt-3">

    <div class="row">
        <?php foreach ($books as $book) { ?>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo book_url();echo $book['bookUrl'];?>" height = "200px" class="card-img-top" alt="books photo">
                <div class="card-body">

                    <h5 class="card-title">
                        <?php 
                            $fileName = $book['bookUrl'];
                            echo fileNameWithoutExtension($fileName);
                        ?>
                    </h5>


                    <div class="d-flex justify-content-between">

                     <button 
                            onclick="confrimBorrow
                            (
                                <?php echo $book['id'] ?>
                             )" 
                             class="btn btn-outline-info btn-sm"
                                    <?php echo $book['isBorrowed'] ? 'disabled' : '' ?>
                             >Borrow<?php echo $book['isBorrowed'] ? 'ed' : '' ?>
                        </button>

                        <p>
                             <?php echo $book['isBorrowed'] ?  "ငှားရမ်းပြီး"  :  ""; ?> 
                        </p>
                       
                     </div>

                    </div>
                    
       
    </section>

    <script>

        function confrimBorrow(id)
        {
            
            Swal.fire({
                title: 'Are you sure?',
                // text: "You won't be able to revert this!",
                // icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Borrow it!'

            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: 'update_borrow.php', // Create this PHP file
                        data: { id: id },

                        success: function(response) 
                        {

                            Swal.fire(
                                'Borrowed!',
                                'Your have borrowed this.',
                                'success'
                            )

                            window.location.href = window.location.href;

                        }
                    });

                }

            })
        }

    </script>
<?php
        }
    } 
    catch (PDOException $e) 
    {
        echo "Query execution failed: " . $e->getMessage();
    }


?>



<?php
    include "footer.php";
?>