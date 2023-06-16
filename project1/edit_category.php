<?php
//To call the function after form submitted
edit_category();

function edit_category() {
  require '../project1/partials/connection.php';
  // Check if the form has been submitted

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the category name and description from the form data
    $old_category_name = $_POST['old_category_name'];
    $old_category_description = $_POST['old_category_description'];

    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Validate the form data
    if (empty($category_name) || empty($category_description)) { ?>
      <script>
        alert("Fill the empty spaces properly");
      </script>
      <?php return;
    }

    // Add the new category to the database
    $sql = "UPDATE `category` SET `category_name` = '$category_name', `category_description`= '$category_description' WHERE `category_name` = '$old_category_name' AND `category_description` = '$old_category_description'";

    $result = mysqli_query($con, $sql);

    if ($result) {?>
      <script>
        alert("The category has been edited.");
      </script>
    <?php } else {?>
        <script>alert("the category cannot be updated as something the old category name is not found");</script>
    <?php }
  }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a category</title>
</head>
<body>
    
    <?php require '../project1/partials/header.html'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit a Category<h1>
        </div>
        <div>
    <div class="row px-2 px-sm-5">
        <form method="post" action="">
            
            <div class="row ">
                <div class="col-12 col-sm-6">
                    <Label class="h6">Category Name:</Label><br>
                    <input type="text" class="form-control" name="old_category_name">
                </div>

                <div class="col-12 col-sm-6">
                    <Label class="h6">Category Description:</Label><br>
                    <input type="text" class="form-control" name="old_category_description">
                </div>
            </div>

<h5 class ="mt-2 mt-sm-3">New name that you want to keep</h5>
            <div class="row ">
                <div class="col-12 col-sm-6">
                    <Label class="h6">New name of the category:</Label><br>
                    <input type="text" class="form-control" name="category_name">
                </div>

                <div class="col-12 col-sm-6">
                    <Label class="h6">New description of the category:</Label><br>
                    <input type="text" class="form-control" name="category_description">
                </div>
            </div>

            <input type="submit" value="Edit category" class="btn rounded-2 btn-info mt-2" onclick="edit_category()">

        </form>
    </div>

</div>


    </main>

</div>
</div>
    
</body>
</html>