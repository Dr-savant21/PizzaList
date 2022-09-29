<?php

    include('./connect/db_connect.php');
// to protect ourselves from cross site scripting we use htmlspacialchars
//validating data with flter and regrex
//checking for errors and echoing out the error
$email = $title = $ingredients = '';
$errors = array('email'=>'','title'=>'','ingredients'=>'');

if (isset($_POST['submit'])){
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);

//check for email
if (empty($_POST['email'])){
    $errors['email'] = 'an email is required <br />';
}else{
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'please enter a valid email address';
    }
}
// check for title
if (empty($_POST['title'])){
    $errors['title'] = 'a title is required <br />';
}else{
    $title = $_POST['title'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $title)){
      $errors['title'] = "Title must be alphabet and spaces only";
    }
}
//check for ingredients
if (empty($_POST['ingredients'])){
    $errors['ingredients'] = 'at least one ingredients is required <br />';
}else{
    $ingredients = $_POST['ingredients'];
    if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors['ingredients'] = "Ingredients must be a comma seperated list";
    }
}
// end of check

    if (!array_filter($errors)){
        $email = mysqli_real_escape_string($connect, ($_POST['email']));
       $title = mysqli_real_escape_string($connect, ($_POST['title']));
       $ingredients = mysqli_real_escape_string($connect, ($_POST['ingredients']));
        //sending data to database
       $sql = "INSERT INTO pizza(Title, Ingredients, Email) VALUES('$title','$ingredients','$email')";
        // make query to save connection and save data to database
       if (mysqli_query($connect,$sql)){
        header('Location: index.php');
       }else {
        // checks if there any errors
        echo 'Error: ' . mysqli_error($connect);
       }
    }
}
?>

<html lang="en">

<?php include("templates/header.php") ?>
<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="add.php" class="white" method="POST">
        <label for="Email">Your Email: </label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label for="pizza">Pizza Title: </label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label for="ingredients">Ingredients (comma seperated): </label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand">
        </div>
    </form>
</section>
<?php include("templates/footer.php") ?>

</html>