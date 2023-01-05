<!-- Comment form -->

<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "idiscuss";
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn) {
    echo "Not connected";
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">

    <title>iDiscuss</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <h1>Threads</h1>
    <?php
    $id = $_GET['cat'];
    $sql = "SELECT * FROM `categories` WHERE cat_id =$id";
    $check = mysqli_query($conn, $sql);

    $nums = mysqli_num_rows($check);
    if ($nums > 0) {


        while ($row = mysqli_fetch_assoc($check)) {
            $name = $row['cat_name'];
            $description = $row['cat_desc'];
        }
    }
    ?>
    <div class="containe mb-4 text-center">
        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Welcome to <?php echo $name; ?></h2>
                <p><?php echo $description; ?></p>
                <button class="btn btn-outline-secondary" type="button">Example button</button>
            </div>
        </div>
    </div>
    <div class="container">
        <h3 class="py-2">Browse Questions</h3>
        <?php
        $id = $_GET['cat'];
        $sql = "SELECT * FROM `threads` WHERE t_cat_id =$id";
        $check = mysqli_query($conn, $sql);

        $nums = mysqli_num_rows($check);
        if ($nums > 0) {


            while ($row = mysqli_fetch_assoc($check)) {
                $t_title = $row['t_title'];
                $t_description = $row['t_desc'];
                $user = $row['t_user'];
                $tid = $row['t_id'];
            
        
        echo "<div class='d-flex my-3'>
            <div class='flex-shrink-0'>
                <img src='' width='54px' class='mr-3'>
            </div>
            <div class='flex-grow-1 ms-3'>
                <a href='threadOpen.php?tid=".$tid."' class='text-dark'>".$t_title."</a> 
            </div>
        </div>";
    }}?>
    </div>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $ques = $_POST["t_title"];
    $d = $_POST["t_desc"];

    $sql2 = "INSERT INTO threads (t_title, t_desc, t_cat_id) VALUES ('$ques', '$d', '$id')";
    $checking = mysqli_query($conn, $sql2);
    if($checking){
        echo "Done";
    }
}


?>
    <form action="<?php echo $_SERVER['PHP_SELF'].'?cat='.$id; ?>" method="post">
    <input type="text" name="t_title" id="t_title">
    <input type="text" name="t_desc" id="t_desc">
    <input type="submit" value="Post">

    </form>
    <?php include "partials/_footer.php"; ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>