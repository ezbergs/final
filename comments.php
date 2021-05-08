<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
// if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

if (isset($_REQUEST['name']) && ($_REQUEST['comment'])) {

    $name = $_POST['name'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="comment-added">Komentārs pievienots veiksmīgi!</div>';
    }
}
?>

<div class="comment-box">
    <h1>Komentāri</h1>

    <?php
    $res = "SELECT * FROM comments ORDER BY id";
    $data = $conn->query($res);

    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) { ?>
            <div class="name"><?php echo $row["name"]; ?></div>
            <div class="comment"><?php echo $row["comment"]; ?></div>
    <?php }
    } else {
        echo '<h4 style="padding-left:20px;">Nav pievienots neviens komentārs!</h4>';
    }
    ?>

    <div class="name">Pievienot komentāru:</div>
    <form method="POST">
        <input type="text" class="text" name="name" placeholder="Ievadiet Jūsu vārdu.." />
        <textarea class="add" name="comment" placeholder="Jūsu komentārs.." rows="10"></textarea>
        <button type="submit" class="add-button">Pievienot komentāru</button>
    </form>
    <br clear="both" />
</div>