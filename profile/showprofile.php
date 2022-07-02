<?php
require('../conn.php');

$userID = $_POST['userID'];

$userProfile = "SELECT * FROM users WHERE id=$userID";
$userResult = $conn->query($userProfile);

while ($userProfile = $userResult->fetch_assoc()) {
?>
    <?php
    echo '<img src="data:image/jpeg;base64,' . base64_encode($userProfile['image']) . '" class="avatar-picture" />'
    ?>

    <p class="username"><?php echo $userProfile['username'] ?></p>
    <p class="email"><?php echo $userProfile['email'] ?></p>

    <?php
    if ($_SESSION['id'] == $userProfile['id'] || $_SESSION['id'] == 23) {
        echo "<button class='button' onclick='toggleEdit()'>Edit Profile</button>";
    }
    ?>


<?php
}
?>