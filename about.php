<?php
require "header.php";
?>


<html>
<body>
  <div class="container my-3 py-3 z-depth-1">
    <div>
      <?php
          if (isset($_GET['success'])) {
              if ($_GET['success'] == "reviewdeleted") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> You have delete the review for the member.</div>';
              }
          } else if (isset($_GET['error'])) {
              if ($_GET['error'] == "finalized") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> You finalized the review for the specific member.</div>';
              }
          }
      ?>
    </div>
    <div class="jumbotron">
    <!--Section: Content-->
    <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">

      <!--Grid row-->
      <div class="row d-flex justify-content-center">

        <!--Grid column-->
        <div class="col-lg-8 text-center">
          <!--Image-->
          <div class="view overlay z-depth-1-half">
            <img src="/~gc8298r/img/UoG_BLACK.png" class="img-fluid" alt="">
          </div>

          <h3 class="font-weight-bold mb-4">Peer Review System</h3>

          <p class="text-muted"><strong>Author:</strong> Gabriel Ciortea</p>
          <p class="text-muted"><strong>Student ID:</strong> 000968052</p>
          <p class="text-muted"><strong>Coursework:</strong> COMP-1687 Web Application Development</p>
        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->


    </section>
    <!--Section: Content-->

    </div>
  </div>
</body>
</html>

<?php
require "footer.php"
?>
