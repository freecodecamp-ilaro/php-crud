<?php include "templates/header.php"; ?><h2>Add a User</h2>

<?php

    if(isset($_POST['submit'])){
        require "../config.php";

        try {
            $connection = new PDO($username, $password, $options);
            $new_user = array(
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "email" => $_POST['email'],
                "age" => $_POST['age'],
                "location" => $_POST['location']
            );
            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
            );
            
            $statement = $connection->prepare($sql);
            $statement->execute($new_user);
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error -> getMessage();
        }
    }
?>

<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname"></br>
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname"></br>
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email"></br>
    <label for="age">Age</label>
    <input type="text" name="age" id="age"></br>
    <label for="location">Location</label>
    <input type="text" name="location" id="location"></br>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">back to home</a>

<?php include "templates/footer.php"; ?>