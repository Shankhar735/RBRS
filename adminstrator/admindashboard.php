<?php
session_start();
require "../Database/connection_db.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {
  if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    
    // For Cover Page
    $coverDirectory = "books/BookCover/";
    $coverExtension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
    $uniqueCoverName = uniqid() . '_'. bin2hex(random_bytes(8)) . '.' . $coverExtension;
    $coverTargetDirectory = $coverDirectory.$uniqueCoverName;

    // For Book
    $bookDirectory = "books/";
    $bookExtension = pathinfo($_FILES['book']['name'], PATHINFO_EXTENSION);
    $uniqueBookName = uniqid() . '_'. bin2hex(random_bytes(8)) . '.' . $bookExtension;
    $bookTargetDirectory = $bookDirectory.$uniqueBookName;

    $validate = true;

    if($validate) {
      if(move_uploaded_file($_FILES['cover']['tmp_name'], $coverTargetDirectory) && move_uploaded_file($_FILES['book']['tmp_name'], $bookTargetDirectory)){
        $query = "INSERT INTO books (title, author, category, coverpage, filename) VALUES ('$title', '$author', '$category', '$uniqueCoverName', '$uniqueBookName')";
        if(mysqli_query($conn, $query)) {
          header("Refresh:0");
        }
      }
    }

  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - Book Recommendation System</title>
  <link rel="stylesheet" href="adminasset/dashboard.css">
</head>
<body>
  <div class="container">
    <h1>Admin Dashboard - Book Recommendation System</h1>
    
    <div class="add-book-form">
      <h2>Add a Book</h2>
      <form action="#" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Title" name="title" required>
        <input type="text" placeholder="Author" name="author" required>
        <input type="text" placeholder="Category" name="category" required>
        Book cover: <input type="file" name="cover" required>
        Book File: <input type="file" name="book" required>
        <input type="submit" name="submit" value="Add">
      </form>
    </div>
    
    <h2>Book List</h2>
    <table>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Cover</th>
        <th>Edit</th>
      </tr>
      <?php
            $query="SELECT * FROM books";
            $result=mysqli_query($conn, $query);
            $data=mysqli_num_rows($result);
            if($data>0){
                while($row=mysqli_fetch_array($result)){
        
        
        ?>
      <tr>
        <td><?php echo $row['title']; ?> </td>
        <td><?php echo $row['author']; ?> </td>
        <td><?php echo $row['category']; ?> </td>
        <td><img style="height: 80px; width: 110px;" src="books/BookCover/<?php echo $row['coverpage']; ?>"></td>
        <td>
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
      <?php
            }
        }
        ?>
      
    </table>
  </div>
</body>
</html>
