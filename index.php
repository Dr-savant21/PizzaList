<?php
 include('./connect/db_connect.php');

//construct and write query for selected columns in our pizzas table and ordering by created_at property
$sql = 'SELECT ID, Title, Ingredients FROM pizza ORDER BY created_at';

//make query and get result
$result = mysqli_query($connect, $sql);

//fetch resulting rows as an associative array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);
//close connection
mysqli_close($connect);

// print_r($pizzas)

?>

<html lang="en">

<?php include("templates/header.php") ?>

<h4 class="center grey-text">pizzas</h4>
<div class="container">
    <div class="row">
        <?php foreach($pizzas as $pizza){ ?>
                 <div class="col s6 md3">
                 <div class="card">
                    <img src="./pizza.svg" alt="pizza" class="pizza">
                     <div class="card-content center">
                         <h6><?php echo htmlspecialchars($pizza['Title']); ?></h6>
                         <ul>
                            <?php foreach(explode(',', $pizza['Ingredients']) as $ingredient){ ?>
                                <li><?php echo htmlspecialchars($ingredient); ?></li>
                            <?php } ?>
                         </ul>
                     </div>
                     <div class="card-action right-align">
                         <a href="details.php?id=<?php echo $pizza['ID'] ?>" class="brand-text">More Info</a>
                     </div>
                 </div>
             </div>
       <?php } ?>
    </div>
</div>

<?php include("templates/footer.php") ?>

</html>