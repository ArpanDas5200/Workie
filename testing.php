<?php
// Establish database connection (replace with your own credentials)
$host = 'localhost';
$dbname = 'users';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Database connection failed: ' . $e->getMessage();
}

// Define function to retrieve all categories from the database
function getCategories() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Define function to save a new category to the database
function saveCategory($name, $parent_id = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    $stmt->execute([$name, $parent_id]);
}

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;
    saveCategory($name, $parent_id);
}

// Get all categories from the database
$categories = getCategories();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create New Category</title>
</head>
<body>
    <h1>Create New Category</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <input type="checkbox" id="parent" name="parent" onchange="showParentCategories()">
        <label for="parent">Make this a sub-category:</label>
        <div id="parent-categories" style="display:none;">
            <label for="parent_id">Choose a parent category:</label>
            <select id="parent_id" name="parent_id">
                <option value="0">No parent category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <input type="submit" value="Save">
    </form>

    <script>
        function showParentCategories() {
            const parentCheckbox = document.getElementById('parent');
            const parentCategoriesDiv = document.getElementById('parent-categories');
            if (parentCheckbox.checked) {
                parentCategoriesDiv.style.display = 'block';
            } else {
                parentCategoriesDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>