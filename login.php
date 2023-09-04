<?php

include 'header.php';
include 'database_conn.php';

$validationMessage = '';
$successMessage = '';

if(isset($_POST["login_submit"]))
{   
    if(empty($_POST["login_email"]))
	{
		$validationMessage .= '<h6>Email Address is required</h6>';
	}

    if(empty($_POST['login_password']))
	{
		$validationMessage .= '<h6>Password is required</h6>';
	}	
}

if($validationMessage == '')
{

    $userName = $_POST['login_email'];
    $password = $_POST['login_password'];

    $stmt = $pdo->prepare(
        "SELECT * FROM user WHERE
         userName = :userName AND password = :password"
    );

    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {

        $_SESSION['user_id'] = $user['userName']; 
        
        $_SESSION['id'] = $user['id']; 

        $_SESSION['role'] = $user['role'];

        header('location:index.php'); 

    }
    // echo $users['userName'];
    // header()

    // if($stmt->rowCount() > 0)
    // {
    //     header('location:index.php');
    // }
    


   

}

?>

<div class="container  d-flex justify-content-center vh-100 align-items-center">

    <div class="card">

        <?php

            if($validationMessage != '')
            {
                echo '<div class="alert alert-danger"><ul>'.$validationMessage.'</ul></div>';
            }

            if($successMessage != '')
            {
                echo '<div class="alert alert-success">'.$successMessage.'</div>';
            }

        ?>


        <div class="card-header">User Login</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">your name</label>
                    <input name="login_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="login_password" class="form-control" id="exampleInputPassword1">
                </div>


                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
						<input type="submit" name="login_submit" class="btn btn-primary" value="Login" />
				</div>

            </form>
        </div>
    </div>

    

</div>

<?php
    include "footer.php";
?>