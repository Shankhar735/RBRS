<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - Book Recommendation System</title>
  <link rel="stylesheet" href="adminassetdashboard.css">
</head>
<body>
  <div class="container">
    <h1>Admin Dashboard - Book Recommendation System</h1>
    
    <div class="add-book-form">
      <h2>Add a Book</h2>
      <form>
        <input type="text" placeholder="Title" required>
        <input type="text" placeholder="Author" required>
        <input type="submit" value="Add Book">
      </form>
    </div>
    
    <h2>Book List</h2>
    <table>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>Book 1</td>
        <td>Author 1</td>
        <td>
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
      <tr>
        <td>Book 2</td>
        <td>Author 2</td>
        <td>
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
