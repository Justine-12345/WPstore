

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">



<nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>WP | Store <i class="fas fa-shopping-cart"></i></b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Store</a>
        </li>
        <li class="nav-item">

        <form action="allorders.php" method="post">
           <input type="submit" name="myOrders" class="nav-link active" value="Orders" style="background-color: transparent;border: none;" >
        </form>
         
        </li>
         </li>
        <li class="nav-item">
          <a class="nav-link active" href="help.php">Help</a>
        </li>
      </ul>
      <form action="user.php" method="post">
        <span style="color: white">Welcome, <b><?php echo ucwords($_SESSION['userInfo']['userFName'])." "; echo ucwords( $_SESSION['userInfo']['userLName']); ?></b></span>
        <button class="btn btn-secondary" name="logout" type="submit"><b>LOG-OUT</b></button>
      </form>
    </div>
  </div>
</nav>
