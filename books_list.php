<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<div class="container">
    <h2>Books List</h2>
    <input type="text" id="bookSearch" placeholder="Search for books...">
    <table>
        <thead>
            <tr>
                <th><a href="?sort=id&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'id' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">ID</a></th>
                <th><a href="?sort=title&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'title' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Title</a></th>
                <th><a href="?sort=author&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'author' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Author</a></th>
                <th><a href="?sort=publisher&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'publisher' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Publisher</a></th>
                <th><a href="?sort=year&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'year' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">Year</a></th>
                <th><a href="?sort=isbn&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'isbn' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>">ISBN</a></th>
            </tr>
        </thead>
        <tbody id="bookTableBody">
            <?php
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
            $sql = "SELECT * FROM books ORDER BY $sort $order";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td><a href='edit_book.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["publisher"] . "</td>";
                    echo "<td>" . $row["year"] . "</td>";
                    echo "<td>" . $row["isbn"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No books found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('bookSearch').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#bookTableBody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const matches = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
        row.style.display = matches ? '' : 'none';
    });
});
</script>

<?php include('footer.php'); ?>
