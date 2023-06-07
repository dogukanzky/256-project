<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>
<p>
<form method="POST">
    <label for="NAME">Name:

    </label>
    <input type="text" id="NAME" name="NAME" required>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required>
    <input type="submit" value="Change">


    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
            name="floatingPassword">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword2" placeholder="Password"
            name="floatingPassword2">
        <label for="floatingPassword2">Validate your password</label>
    </div>

</form>
</p>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>






    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["NAME"] != " ") {
        $newName = $_POST["NAME"];
        $_USER['name'] = $newName;


    }

    if ($_POST["lastname"] != " ") {
        $newLname = $_POST["lastname"];
        $_USER["last_name"] = $newLname;
    }


    if ($_POST["floatingPassword"] !== $_POST["floatingPassword2"] || !isset($_POST["floatingPassword"]) || !isset($_POST["floatingPassword2"]))
        echo "<H1>passwords do not match</H1>";
    else {
        $newPass = $_POST["floatingPassword"];
        $_USER["password"] = $newPass;
    }
    $curUserID = $_SESSION["user_id"];
    $_USER->update_User($curUserID, $name, $last_name, $email, $birthday, $password);
    //profil fotosu biografi 
}
?>