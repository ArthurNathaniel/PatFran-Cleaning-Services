<?php
include 'db.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Get the project image path
    $sql = "SELECT project_image FROM projects WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if ($row) {
        // Delete the image file from the server
        $image_path = $row['project_image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        
        // Delete the record from the database
        $sql = "DELETE FROM projects WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Project deleted successfully!";
        } else {
            echo "Error deleting project: " . $conn->error;
        }
    }
}

// Handle file upload and project addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST['project_name'];

    // Handling file upload
    $target_dir = "projects_images/";
    $target_file = $target_dir . basename($_FILES["project_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["project_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO projects (project_name, project_image) VALUES ('$project_name', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "New project added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Fetch projects from the database
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <section>
        <h1>Add New Project</h1>
        <form action="add_project.php" method="post" enctype="multipart/form-data">
            <label for="project_name">Project Name:</label><br>
            <input type="text" id="project_name" name="project_name" required><br><br>

            <label for="project_image">Select image to upload:</label><br>
            <input type="file" name="project_image" id="project_image" required><br><br>

            <input type="submit" value="Upload Project">
        </form>
    </section>

    <section>
        <div class="projects_all">
            <div class="project_title">
                <h1>Our Projects</h1>
            </div>
            <div class="project_grid">
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="project">';
                        echo '<a href="' . $row['project_image'] . '" data-fancybox="gallery">';
                        echo '<img src="' . $row['project_image'] . '" alt="' . htmlspecialchars($row['project_name']) . '">';
                        echo '</a>';
                        echo '<p>' . htmlspecialchars($row['project_name']) . '</p>';
                        echo '<a href="add_project.php?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this project?\');">Delete</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No projects available.</p>";
                }
                ?>
            </div>
        </div>
    </section>

   
</body>

</html>
