<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
    <h2>Students
         List</h2>
    <input type="text" id="memberSearch" placeholder="Search for members...">
    <table>
        <thead>
            <tr>
                <th><a href="?sort=id&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'id' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">ID</a></th>
                <th><a href="?sort=name&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Name</a></th>
                <th><a href="?sort=email&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'email' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Email</a></th>
                <th><a href="?sort=phone&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'phone' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Phone</a></th>
                <th><a href="?sort=address&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'address' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Address</a></th>
            </tr>
        </thead>
        <tbody id="memberTableBody">
            <?php
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
            $sql = "SELECT * FROM members ORDER BY $sort $order";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td><a href='edit_member.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No members found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('memberSearch').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#memberTableBody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const matches = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
        row.style.display = matches ? '' : 'none';
    });
});
</script>

<?php include('footer.php'); ?>
