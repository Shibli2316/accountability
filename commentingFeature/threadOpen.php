<!-- Reply form -->


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
    <h1>Open Thread</h1>
    <?php
        $id = $_GET['tid'];
        $sql = "SELECT * FROM `threads` WHERE t_id =$id";
        $check = mysqli_query($conn, $sql);

        $nums = mysqli_num_rows($check);
        if ($nums > 0) {


            while ($row = mysqli_fetch_assoc($check)) {
                $t_title = $row['t_title'];
                $t_description = $row['t_desc'];
                $catid = $row['t_cat_id'];
                $user = $row['t_user'];
                $tid = $row['t_id'];
            }
            // echo $catid;
            $sql11 = "SELECT * FROM `categories` WHERE cat_id =$catid";
            $s = mysqli_query($conn, $sql11);
            $num = mysqli_num_rows($s);
            if($num==1){
                while($r = mysqli_fetch_assoc($s)){
                    echo $r['cat_name'];
                }
            }

            echo "<div class='d-flex my-3'>
            <div class='flex-shrink-0'>
                <img src='' width='54px' class='mr-3'>
            </div>
            <div class='flex-grow-1 ms-3'>

                ".$t_title."
                <p>".$t_description."</p> 
                
            </div>
        </div>";
        }
    ?>

    <?php
// INSERT INTO `reply` (`r_id`, `t_id`, `t_cat_id`, `reply`, `user`) VALUES ('1', '6', '2', 'testing rply', 'Shibli');

    $sql3 = "SELECT * FROM `reply` WHERE t_id=$id";
    $test = mysqli_query($conn, $sql3);
    $fetching = mysqli_num_rows($test);
    if($fetching>0){
        while($ro = mysqli_fetch_assoc($test)){
            echo $ro['reply'].'<br>';

        }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $rply = $_POST['rply'];
        $sql4 = "INSERT INTO `reply` (`t_id`, `t_cat_id`, `reply`) VALUES ('$id', '$catid', '$rply');";
        $inserting = mysqli_query($conn, $sql4);
        
    }
?>
<form action="<?php echo $_SERVER['PHP_SELF'].'?tid='.$id; ?>" method="post">
<input type="text" name="rply" id="rply">
<input type="submit" value="Reply">
</form>
    
    <?php include "partials/_footer.php"; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>