<?php

    include 'header.php';


    if(isset($_POST["register_button"]))
    {
        $formdata = array();

        if(empty($_POST["user_email_address"]))
        {
            $message .= '<li>Email Address is required</li>';
        }
        else
        {
            if(!filter_var($_POST["user_email_address"], FILTER_VALIDATE_EMAIL))
            {
                $message .= '<li>Invalid Email Address</li>';
            }

            else
            {
                $formdata['user_email_address'] = trim($_POST['user_email_address']);
            }
        }

        if(empty($_POST["user_password"]))
        {
            $message .= '<li>Password is required</li>';
        }
        else
        {
            $formdata['user_password'] = trim($_POST['user_password']);
        }

        if(empty($_POST['user_name']))
        {
            $message .= '<li>User Name is required</li>';
        }
        else
        {
            $formdata['user_name'] = trim($_POST['user_name']);
        }

	}

?>

<div class="container  d-flex justify-content-center vh-100 align-items-center">

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    

</div>

<?php
    include "footer.php";
?>