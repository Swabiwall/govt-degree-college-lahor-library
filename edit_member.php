<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE members SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$member_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Member updated successfully";
    } else {
        echo "Error updating member: " . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $member_id = $_GET['id'];
    $sql = "SELECT * FROM members WHERE id='$member_id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Member not found";
        exit;
    }
} else {
    echo "No member ID provided";
    exit;
}
?>

<div class="container">
  <h2>Edit Member</h2>
  <form id="editMemberForm" method="POST" action="edit_member.php">
    <input type="hidden" id="member_id" name="member_id" value="<?php echo $row['id']; ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required><br><br>
    <input type="submit" value="Update Member">
  </form>
</div>

<?php include('footer.php'); ?>
