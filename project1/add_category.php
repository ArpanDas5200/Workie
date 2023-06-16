<?php
//To call the function after form submitted
add_category();

function add_category() {
  require '../project1/partials/connection.php';
  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the category name and description from the form data
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Validate the form data
    if (empty($category_name) || empty($category_description)) {
      echo 'Please enter both a category name and description.';
      return;
    }

    //To prevent from adding same category
    $select = "SELECT * FROM `category` WHERE `category_name` = '$category_name' AND `category_description` ='$category_description' ";

    $result1 = mysqli_query($con, $select);
    $rows = mysqli_num_rows($result1);

    if($rows = 0){
      // Add the new category to the database
      $sql = "INSERT INTO `category` (`category_name`, `category_description`) VALUES ('$category_name', '$category_description')";
  
      $result2 = mysqli_query($con, $sql);
  
      if ($result2) {?>
        <script>
          alert("New category added");
        </script>
      <?php } else {
        echo 'Error adding category: ' . mysqli_error($conn);
      }
    }else{ 
      echo "<script>
      alert('New category cannot be added as there already exists same category name.');
    </script> ";
    }
  }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new category</title>
</head>
<body>
    
    <?php require '../project1/partials/header.html'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add a new category</h1>
        </div>
        <div>
    <div class="row px-2 px-sm-5">
        <form method="post" action="">
            
            <div class="row ">
                <div class="col-12 col-sm-6">
                    <Label class="h4">Category Name:</Label><br>
                    <input type="text" class="form-control" name="category_name">
                </div>

                <div class="col-12 col-sm-6">
                    <Label class="h4">Category Description:</Label><br>
                    <input type="text" class="form-control" name="category_description">
                </div>
            </div>

            <input type="submit" value="Add category" class="btn rounded-2 btn-info mt-2" onclick="add_category()">

        </form>
    </div>

</div>


    </main>

</div>
</div>
    
</body>
</html>