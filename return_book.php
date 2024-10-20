<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
  <h2>Return Book</h2>
  <form id="returnBookForm" method="POST" action="return_book.php">
    <label for="issue_id">Issue ID:</label>
    <input type="text" id="issue_id" name="issue_id"><br><br>
    <label for="return_date">Return Date:</label>
    <input type="date" id="return_date" name="return_date"><br><br>
    <input type="submit" name="return_book" value="Return Book">
  </form>
  <div id="message"></div>
</div>

<?php include('footer.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['return_book'])) {
    $issue_id = $_POST['issue_id'];
    $return_date = $_POST['return_date'];

    if ($issue_id && $return_date) {
        // Check if issue_id exists in issues table
        $check_issue_query = "SELECT * FROM issues WHERE id='$issue_id'";
        $check_issue_result = $conn->query($check_issue_query);
        
        if ($check_issue_result->num_rows > 0) {
            // Update return_date in issues table
            $update_issue_query = "UPDATE issues SET return_date='$return_date' WHERE id='$issue_id'";
            if ($conn->query($update_issue_query) === TRUE) {
                echo "<script>document.getElementById('message').innerHTML = 'Book returned successfully';</script>";
            } else {
                echo "<script>document.getElementById('message').innerHTML = 'Error updating record: " . $conn->error . "';</script>";
            }
        } else {
            echo "<script>document.getElementById('message').innerHTML = 'Issue ID not found';</script>";
        }
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'All fields are required.';</script>";
    }
}
?>
