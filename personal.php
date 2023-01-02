<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>

<?php

$insert = false;
$update = false;
$delete = false;

// Connecting to the database

$servername = "localhost";
$username = "root";
$password = "";
$database = "accountability";
$user = $_SESSION['username'];

// Creating a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry access denied" . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `pdg` where `id`=$id ";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idEdit'])) {
        // Update the record

        $id = $_POST['idEdit'];
        $title = $_POST['titleEdit'];
        $goal = $_POST['goalEdit'];

        // SQL query to be executed

        $sql = "UPDATE `pdg` SET `title`= '$title' , `goal`= '$goal' WHERE `pdg`.`id`=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "Failed";
        }
    } else {
        // insert  the record

        $title = $_POST['title'];
        $goal = $_POST['goal'];

        // SQL query to be executed

        $sql = "INSERT INTO `pdg` (`username`, `title`, `goal`, `created`) VALUES ('$user', '$title', '$goal', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        // Adding a new trip
        if ($result) {
            $insert = true;
        } else {
            echo "The record was not inserted successfully due to ---> " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <title>Welcome - <?php echo $user; ?></title>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="personal.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="idEdit" id="idEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Goal Title</label>
                            <input type="text" class="form-control" id="titleEdit" aria-describedby="emailHelp" name="titleEdit">
                        </div>
                        <div class="form-group">
                            <label for="desc">Goal Description</label>
                            <textarea class="form-control" id="goalEdit" name="goalEdit" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    require '_nav.php'
    ?>

    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Goal has been saved successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>

    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Goal has been deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>

    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Goal has been updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>

<!-- Quote Modal -->
<div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Quote of the day</h5>
    <p class="card-text"><blockquote>If what is ahead scares you and what is behind hurts you, then look above. Allah will never fail to help you. &#x1F604;</blockquote></p>
  </div>
  <div class="card-footer text-muted">
    You are doing great keep going. &#128077; 
  </div>
</div>

    <div class="container my-4">
        <h2>Work on yourself</h2>
        <form action="personal.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Goal Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">
            </div>
            <div class="form-group">
                <label for="desc">Describe your goal</label>
                <textarea class="form-control" id="goal" name="goal" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-2">Add goal</button>
        </form>
    </div>

    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Goal</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `pdg` WHERE `username` = '$user'";
                $result = mysqli_query($conn, $sql);
                // echo var_dump($result);
                $id = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $id + 1;
                    echo "<tr>
            <th scope='row'>" . $id . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['goal'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=" . $row['id'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['id'] . ">Completed</button>  </td>
            </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                goal = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, goal);
                titleEdit.value = title;
                goalEdit.value = goal;
                idEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete", );
                id = e.target.id.substr(1, );


                if (confirm("Are you sure")) {
                    console.log("yes");
                    window.location = `personal.php?delete=${id}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>

</body>

</html>