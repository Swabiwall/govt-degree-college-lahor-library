<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
  <h2>Add Students</h2>
  <form id="addMemberForm" method="POST" action="add_member.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone"><br><br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address"><br><br>
    <input type="submit" name="add_member" value="Add Member">
  </form>
  <div id="message"></div>
</div>

<?php include('footer.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_member'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($name) {
        $sql = "INSERT INTO members (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "<script>document.getElementById('message').innerHTML = 'New student added successfully. And the ID of the student is $last_id';</script>";
        } else {
            echo "<script>document.getElementById('message').innerHTML = 'Error: " . $sql . "<br>" . $conn->error . "';</script>";
        }
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'Name is required.';</script>";
    }
}
?>
