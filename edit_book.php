<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];

    $sql = "UPDATE books SET title='$title', author='$author', publisher='$publisher', year='$year', isbn='$isbn' WHERE id='$book_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Book updated successfully";
    } else {
        echo "Error updating book: " . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id='$book_id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Book not found";
        exit;
    }
} else {
    echo "No book ID provided";
    exit;
}
?>

<div class="container">
  <h2>Edit Book</h2>
  <form id="editBookForm" method="POST" action="edit_book.php">
    <input type="hidden" id="book_id" name="book_id" value="<?php echo $row['id']; ?>">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required><br><br>
    <label for="author">Author:</label>
    <input type="text" id="author" name="author" value="<?php echo $row['author']; ?>" required><br><br>
    <label for="publisher">Publisher:</label>
    <input type="text" id="publisher" name="publisher" value="<?php echo $row['publisher']; ?>"><br><br>
    <label for="year">Year:</label>
    <input type="text" id="year" name="year" value="<?php echo $row['year']; ?>"><br><br>
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" value="<?php echo $row['isbn']; ?>"><br><br>
    <input type="submit" value="Update Book">
  </form>
</div>

<?php include('footer.php'); ?>
