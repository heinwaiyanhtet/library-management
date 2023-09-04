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

    $query = "
        SELECT b.id AS bookId, b.bookUrl, b.isBorrowed, br.id AS borrowedId, br.borrowedDate, br.returnedDate
        FROM borrowed br
        JOIN books b ON br.bookId = b.id
        WHERE br.userId = :userId;
    ";

    $statement = $pdo->prepare($query);

    $userId = $_SESSION['id'];

    $statement->bindParam(':userId', $userId);

    $statement->execute();

    $books = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

 
<section class="container-fluid mt-3">

<div class="row">

    <h6 class="text-center text-primary text-decoration-underline mb-2"> Borrowed & Returned Form</h6>

    <?php foreach ($books as $book) { ?>

    <div class="col-3">

        <div class="card" style="width: 18rem;">
            <img src="<?php echo book_url();echo $book['bookUrl'];?>" height = "200px" class="card-img-top" alt="books photo">

            <div class="card-body">

                <p>
                  borrowedDate -  <?php echo $book['borrowedDate'] ?>
                </p>

                <p class="d-inline mb-0">
                  returnedDate -  <p class="d-inline" id="returnedDate"> <?php echo $book['returnedDate'] ?> </p>
                </p>

                <button 
                        id = "returnedButton"
                        onclick="returnBorrowed
                            (
                                <?php echo $book['bookId']; ?> ,
                                <?php echo $book['borrowedId']; ?>
                            )" 
                        class="
                                btn btn-outline-info btn-sm
                        "
                    <?php echo $book['returnedDate'] != null ? 'disabled': '';?>
                        
                        >
                    return<?php echo $book['returnedDate'] != null ? 'd': '';?>

                </button>

            </div>
        </div>

    </div>

    <?php }?>
   
</section> 

<script>

        function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }

        const currentDate = new Date();
        const formattedDate = formatDate(currentDate);



    function returnBorrowed(bookId,borrowedId)
    {

            
        Swal.fire({
                title: 'Are you sure?',

                // text: "You won't be able to revert this!",
                // icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes , return it!'

            })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: 'return_borrow.php', // Create this PHP file

                        data: 
                        {
                             bookId: bookId,
                             borrowedId: borrowedId , 
                        },

                        success: function(response) 
                        {

                            
                            let returnButton = document.getElementById("returnedButton");
                            returnButton.textContent = "returned";

                            const currentDate = new Date();
                            const formattedDate = formatDate(currentDate);

                            let returnedDate = document.getElementById("returnedDate");
                            returnedDate.textContext = formattedDate;

                            // console.log(response);

                            Swal.fire(
                                "returned!",
                                'Your have returned this.',
                                'success'
                            )

                            // window.location.href = window.location.href;

                        },

                    });

                }

            })
    }
</script>

<?php

} catch (\Throwable $th) {
    //throw $th;
}


?>

<?php

    include 'footer.php';

?>
