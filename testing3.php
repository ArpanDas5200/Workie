<?php 
<?php foreach($categories as $rows) { ?>
    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['category_name']; ?></option>
    <?php } ?>



$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'users';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function getCategories(){
    global $conn;
    $stmt = $conn -> prepare("SELECT * FROM `categories`");
    $stmt -> execute();
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function saveCategory($name, $parent_id = null){
    global $conn;
    $stmt = $conn -> prepare("INSERT INTO `categories`(`id`, `name`, `parent_id`) VALUES (NULL, :name, :parent_id)");
    $stmt -> bindParam(':name',$name);
    $stmt -> bindParam(':parent_id',$parent_id);

    $stmt -> execute();
   if($stmt){echo "Successfully inserted";}
   else{echo "Failed to insert";}
}


/*if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];

    $id = $_POST['parent_id'];
    if($id){
        echo "neijfef";
    }else{
        saveCategory( $name,$parent_id);
    }
}*/
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $button = $_POST['submit'];
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];

    // echo "<pre>";
    // print_r($button);
    // dies();
    
    if($button == 'old'){
        echo "neijfef";
    }else{
        saveCategory( $name,$parent_id);
    }
}


// Get all categories from the database
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create a new category</h1><br>
    <div>
      <!--  <form method="POST">
            <label for="name"> Name of the category: </label>
            <input type="text" name="name" id="name"> <br>

            <input type="checkbox" name="parent" id="parent" onchange="show_parent_category()">
            <label for="parent" >Check it if you want to make it a Sub Category </label><br>
            
            <div id="parent_categories"  style="display:none;">
                <label for="parent_id">Name of the parent category </label>

                <select name="parent_id" id="parent_id">
                <option value="0">Make a parent category</option>
                    <?php /*foreach($categories as $rows) { ?>
                <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>
                <?php }*/ ?>
                </select>
            </div>
            
            <button type="submit" name="submit">Create category</button>
        </form>
    </div> -->
    <h1>update a category</h1><br>
    <div>
        <form method="POST">
            <label for="name"> Name of the category: </label>
            <input type="text" name="name" id="name"> <br>

            <input type="checkbox" name="parent" id="parent" onchange="show_parent_category()">
            <label for="parent" >Check it if you want to make it a Sub Category </label><br>
            
            <div id="parent_categories"  style="display:none;">
                <label for="parent_id">Name of the parent category </label>

                <select name="parent_id" id="parent_id">
                <option value="0">Make a parent category</option>
                    <?php foreach($categories as $rows) { ?>
                <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>
                <?php } ?>
                </select>
            </div>
            
            <button type="submit" name="submit"  value="old">Update category</button>
        </form>
    </div>
    <script>
        function show_parent_category(){
           const parent_checkbox = document.getElementById('parent');
           const parent_categories = document.getElementById('parent_categories');
           if (parent_checkbox.checked){
            parent_categories.style.display = "block";
           }   else{
            parent_categories.style.display = "none";
           }

        }
    </script>
</body>
</html>