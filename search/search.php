<?php

require('../conn.php');

$search = $_POST['search'];

$sql = "SELECT * FROM posts WHERE title LIKE '$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <a href="../pages/single.php?id=<?php echo $row['id'] ?>">
            <li>
                <?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" />'
                ?>
                <p><?php echo $row['title']; ?></p>
            </li>
        </a>
<?php
    }
}

$conn->close();
