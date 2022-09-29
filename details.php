<?php

include('./connect/db_connect.php');

if (isset($_POST['delete'])){
    $delete = mysqli_real_escape_string($connect,$_POST['delete_btn']);
    $sql = "DELETE FROM pizza WHERE ID = $delete";

    if(mysqli_query($connect,$sql)){
        header('Location: index.php');
    }else{
        echo 'Query Error: '.mysqli_error($connect);
    }
}
if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($connect,$_GET['id']);
// construct or make and write query to get data from database
$sql = "SELECT * FROM pizza WHERE ID = $id";

//get query
$result = mysqli_query($connect,$sql);

//fetch resultin an array
$pizza = mysqli_fetch_assoc($result);

mysqli_free_result($result);
mysqli_close($connect);

// print_r($pizza);

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <?php include("templates/header.php") ?>
    <div class="container center grey-text">
         <p><?php if ($pizza) :?>
            <h4><?php echo htmlspecialchars($pizza['Title']); ?></h4>
            <p>Created by: <?php echo htmlspecialchars($pizza['Email']); ?></p>
            <p>Created on: <?php echo htmlspecialchars($pizza['Created_at']); ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['Ingredients']); ?></p>
            <form action="details.php" method="POST">
                <input type="hidden" name="delete_btn" value="<?php echo $pizza['ID'] ?>">
                <input type="submit" name="delete" value="Delete" class="btn">
            </form>
            <?php else: ?>
                <h5>No such pizza exist</h5>
         <?php endif ?></p>
    </div>
    <?php include("templates/footer.php") ?>
</html>