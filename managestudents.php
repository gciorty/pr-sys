<?php
require "header.php";
?>


<html>
<body>
  <div class="container my-3 py-3 z-depth-1">
    <div class="jumbotron">
      <div class="col-auto">
        <p class="display-4">Manage Students</p>
      </div>
      <p class="lead">In this area you can search and manage students<small> (shows only student enrolled to the system - search by ID and grade)</small></p>
      <hr>
      <div class="col-auto">
        <div class="container">
          <div class="row">
            <div class="col-9">
              <form class="form-inline" name="SearchForm" action="includes/get-searchstudents.inc.php" method="post">
                <select class="custom-select mr-sm-1" name="searchStudentBy" id="selectSearchStudent"  >
                  <option value="ID">Search by ID</option>
                  <option value="higher">Search by grade greater or equal than..</option>
                  <option value="lower">Search by grade lower than..</option>
                </select>
                <input type="number" name="searchString" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="btn btn-outline-secondary" name="search-submit" type="submit">Search</button>
              </form>
            </div>
            <div class="col-3">
              <form name="showAllStud" action="includes/get-allstudents.inc.php" method="post">
                <button class="btn btn-primary" name="search-submit" type="submit">Show all students</button>
              <form>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="auto">
        <iframe class="col-auto" src="searchresult.php" frameborder="0" style="width:100%;" onload="resizeIframe(this)"></iframe>
      <div>
    </div>
  </div>
</body>
</html>

<?php
require "footer.php"
?>
