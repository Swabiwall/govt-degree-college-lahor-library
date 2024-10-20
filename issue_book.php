<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
  <h2>Issue Book</h2>
  <form id="issueBookForm" method="POST" action="issue_book.php">
    <label for="book_id">Book ID:</label>
    <input type="text" id="book_id" name="book_id" required><br><br>
    <label for="member_id">Member ID:</label>
    <input type="text" id="member_id" name="member_id" required><br><br>
    <label for="issue_date">Issue Date:</label>
    <input type="date" id="issue_date" name="issue_date" required><br><br>
    <input type="submit" name="issue_book" value="Issue Book">
  </form>
  <div id="message"></div>
</div>

<?php include('footer.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['issue_book'])) {
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $issue_date = $_POST['issue_date'];

    if ($book_id && $member_id && $issue_date) {
        // Check if book_id exists in books table
        $check_book_query = "SELECT * FROM books WHERE id='$book_id'";
        $check_book_result = $conn->query($check_book_query);

        // Check if member_id exists in members table
        $check_member_query = "SELECT * FROM members WHERE id='$member_id'";
        $check_member_result = $conn->query($check_member_query);

        if ($check_book_result->num_rows > 0 && $check_member_result->num_rows > 0) {
            // Check if the book is already issued and not returned
            $check_issue_query = "SELECT * FROM issues WHERE book_id='$book_id' AND return_date IS NULL";
            $check_issue_result = $conn->query($check_issue_query);

            if ($check_issue_result->num_rows == 0) {
                // Insert into issues table
                $sql = "INSERT INTO issues (book_id, member_id, issue_date) VALUES ('$book_id', '$member_id', '$issue_date')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>document.getElementById('message').innerHTML = 'Book issued successfully';</script>";
                } else {
                    echo "<script>document.getElementById('message').innerHTML = 'Error issuing book: " . $conn->error . "';</script>";
                }
            } else {
                echo "<script>document.getElementById('message').innerHTML = 'This book is not returned yet.';</script>";
            }
        } else {
            echo "<script>document.getElementById('message').innerHTML = 'Invalid Book ID or Member ID.';</script>";
        }
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'All fields are required.';</script>";
    }
}
?>
