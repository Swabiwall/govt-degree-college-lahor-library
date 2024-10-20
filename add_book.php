<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
  <h2>Add New Book</h2>
  <form id="addBookForm" method="POST" action="add_book.php">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br><br>
    <label for="author">Author:</label>
    <input type="text" id="author" name="author" required><br><br>
    <label for="publisher">Publisher:</label>
    <input type="text" id="publisher" name="publisher"><br><br>
    <label for="year">Year:</label>
    <input type="text" id="year" name="year"><br><br>
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn"><br><br>
    <input type="submit" name="add_book" value="Add Book">
  </form>
  <div id="message"></div>
</div>

<?php include('footer.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];

    if ($title && $author) {
        $sql = "INSERT INTO books (title, author, publisher, year, isbn) VALUES ('$title', '$author', '$publisher', '$year', '$isbn')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>document.getElementById('message').innerHTML = 'New book added successfully';</script>";
        } else {
            echo "<script>document.getElementById('message').innerHTML = 'Error: " . $sql . "<br>" . $conn->error . "';</script>";
        }
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'Title and Author are required.';</script>";
    }
}
?>
