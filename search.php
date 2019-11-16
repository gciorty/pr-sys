<?php
require "header.php";
?>


<html>
<body>
  <div class="container my-3 py-3 z-depth-1">
    <div class="jumbotron">
      <div class="col-auto">
        <p class="display-4">Search Form</p>
      </div>
      <p class="lead">In this area you can search students by ID or by grade<small> (shows only student enrolled to the system)</small></p>
      <hr>
      <div class="col-auto">
        <form class="form-inline" name="SearchForm" action="includes/get-searchstudents.inc.php" method="post">
          <select class="custom-select mr-sm-1" name="searchStudentBy" id="selectSearchStudent"  >
            <option value="ID">Search by ID</option>
            <option value="higher">Search by grade greater or equal than..</option>
            <option value="lower">Search by grade lower than..</option>
          </select>
          <select class="custom-select mr-sm-1" name="itemPage" id="selectItemPAge">
            <option value="5" selected>Results per page (default 5)</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">50</option>
          </select>
          <input type="text" name="searchString" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
          <button class="btn btn-outline-secondary" name="search-submit" type="submit">Search</button>
        </form>
      </div>
      <hr>
      <div class="col-auto">
        <iframe class="col-auto" src="searchresult.php" frameborder="0" style="width:100%;" onload="resizeIframe(this)"></iframe>
      <div>
    </div>
  </div>
</body>
</html>

<?php
require "footer.php"
?>
