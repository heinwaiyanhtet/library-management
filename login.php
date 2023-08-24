<?php



$message = '';

if(isset($_POST["login"]))
{   

    $formdata = array();

    if(empty($_POST["user_email_address"]))
	{
		$message .= '<h6>Email Address is required</h6>';
	}

    if(empty($_POST['user_password']))
	{
		$message .= '<h6>Password is required</h6>';
	}	
	else
	{
		$formdata['user_password'] = trim($_POST['user_password']);
	}
   
}

include 'header.php';


?>

<div class="container  d-flex justify-content-center vh-100 align-items-center">

    <div class="card">
        <div class="card-header">User Login</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>


                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
						<input type="submit" name="login" class="btn btn-primary" value="Login" />
				</div>

            </form>
        </div>
    </div>

    

</div>

<?php
    include "footer.php";
?>