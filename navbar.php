<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Books</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">

        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="/borrow.php"> borrow </a>
        <a class="nav-link" href="/notification.php">Notification</a>

        <?php


          session_start();
          if($_SESSION['role'] == 'admin')
          { ?>
          
             <a class="nav-link" href="/userlist.php">userlist</a>
        <?php
          }
        ?>
        
        <!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
      </div>
    </div>
  </div>
</nav>