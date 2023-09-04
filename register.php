<?php

    include 'header.php';
    include 'database_conn.php';

    $validationMessage = '';
    $successMessage = '';


    if(isset( $_POST["register"] ))
    {

        if(empty($_POST['userName']))
        {
            $validationMessage .= '<li>User Name is required</li>';
        }
       

        if (!preg_match('/^(?=.*[0-9]{6,})(?=.*[a-zA-Z]{2,}).*$/', $_POST["password"])) {
            $validationMessage .= '<li>Password must have at least 6 numbers and 2 letters</li>';
        }

        else {

            if(empty($_POST["password"]))
            {
                $validationMessage .= '<li>Password is required</li>';
            }
        }

	}

    

    if($validationMessage == '')
    {

        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $role = 'user';
        // $hashedPassword  = password_hash($password, PASSWORD_DEFAULT);


        $startDate = date('Y-m-d H:i:s');
        $endDate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($currentDate)));
    

        $stmt = $pdo->prepare("INSERT INTO user (userName, password, startDate, endDate, role)
                     VALUES (:userName, :password, :startDate,:endDate,:role)");


        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':role', $role);

        $stmt->execute();

        $successMessage = "Register Successfully";

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
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">user name </label>
                    <input type="" name="userName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>


                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
						<input type="submit" name="register" class="btn btn-primary" value="Register" />
				</div>


            </form>
        </div>
    </div>

    

</div>

<?php
    include "footer.php";
?>