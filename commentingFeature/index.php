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
    <h1>Categories</h1>
    <div class="container">

    
    <div class='row'>
        <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo mysqli_connect_errno();
        }
        $fetch = mysqli_num_rows($result);
        if ($fetch < 1) {
            echo "Nothing here";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                    <div class='col col-md-4 mb-4'>
                        <div class='card' style='width: 18rem;'>
                            <img src='' class='card-img-top' alt=''>
                            <div class='card-body'>
                                <h5 class='card-title'><a href='threads.php?cat=".$row['cat_id']."'>" . $row['cat_name'] . "</a></h5>
                                <p class='card-text'>" . substr($row['cat_desc'], 0, 10) . "</p>
                                <a href='#' class='btn btn-primary'>Go somewhere</a>
                            </div>
                        </div>
                    </div>";
            }
        }

        ?>
    </div>
    </div>
    <?php include "partials/_footer.php"; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    -->
</body>

</html>