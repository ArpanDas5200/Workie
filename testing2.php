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

// Define function to retrieve a specific category by ID from the database
function getCategory($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Define function to save a new category to the database
function saveCategory($name, $parent_id = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    $stmt->execute([$name, $parent_id]);
}

// Define function to update an existing category in the database
function updateCategory($id, $name, $parent_id = null) {
    global $conn;
    $stmt = $conn->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
    $stmt->execute([$name, $parent_id, $id]);
}

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;
    $id = $_POST['id'];
    if ($id == 'new') {
        saveCategory($name, $parent_id);
    } else {
        updateCategory($id, $name, $parent_id);
    }
}

// Check if a category ID has been passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = getCategory($id);
    if (!$category) {
        echo 'Category not found';
        exit();
    }
} else {
    $category = null;
}

// Get all categories from the database
$categories = getCategories();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $category ? 'Edit' : 'Create'; ?> Category</title>
</head>
<body>
    <h1><?php echo $category ? 'Edit' : 'Create'; ?> Category</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $category ? $category['id'] : 'new'; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required value="<?php echo $category ? $category['name'] : ''; ?>">
        <br>

        <input type="checkbox" id="parent" name="parent" onchange="showParentCategories()" <?php echo $category && $category['parent_id'] !== null ? 'checked' : ''; ?>>

        <label for="parent">Make this a sub-category:</label>

        <div id="parent-categories" <?php echo $category && $category['parent_id'] !== null ? '' : 'style="display: none;"'; ?> >
        
        <select name="parent_id">
            <option value="">Select parent category</option>
            <?php foreach ($categories as $cat): ?>
                <?php if (!$category || $cat['id'] !== $category['id']): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo $category && $category['parent_id'] === $cat['id'] ? 'selected' : '0'; ?>><?php echo $cat['name']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <br>
    <button type="submit"><?php echo $category ? 'Save' : 'Create'; ?></button>
</form>
<script>
    function showParentCategories() {
        var parentCheckbox = document.getElementById('parent');
        var parentCategories = document.getElementById('parent-categories');
        if (parentCheckbox.checked) {
            parentCategories.style.display = 'block';
        } else {
            parentCategories.style.display = 'none';
        }
    }
</script>

</body>
</html>






















<?php
      // Connect to the database and fetch all categories
     /* try {
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, name, parent_id FROM categories ORDER BY name";
        $stmt = $pdo->query($sql);

        // Output a dropdown list of all categories, grouped by parent-child relationships
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $categories[$row['id']] = $row;
        }

        function outputCategoryOption($category, $indent = '') {
          echo '<option value="' . $category['id'] . '">' . $indent . $category['name'] . '</option>';

          // Recursively output the child categories with increased indent
          foreach ($category['children'] as $childCategory) {
            outputCategoryOption($childCategory, $indent . '&nbsp;&nbsp;&nbsp;');
          }
        }

        // Group the categories by their parent IDs
        $groupedCategories = [];
        foreach ($categories as $category) {
          if ($category['parent_id']) {
            $groupedCategories[$category['parent_id']]['children'][] = $category;
          } else {
            $groupedCategories[$category['id']] = $category;
            $groupedCategories[$category['id']]['children'] = [];
          }
        }

        // Output the root categories and their children recursively
        foreach ($groupedCategories as $category) {
          if (!$category['parent_id'])}}*/
        