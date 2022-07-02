<?php
require('../conn.php');

$sql = "SELECT * FROM posts ORDER BY posts.id DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>
    <div class="card">
        <a href="./pages/single.php?id=<?php echo $row['id'] ?>">
            <?php
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" />'
            ?>
        </a>
    </div>
<?php
}
?>