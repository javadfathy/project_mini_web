<?php
require_once("header.php");

?>

    <div class="container">
        <h1>SignIn/SignUp</h1>
        <?php
        if (@$_SESSION["user"] == "") {
            ?>
            <form method="post">
                <div class="row mb-3">
                    <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername3" name="userName">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="password">
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Level</legend>
                    <div class="col-sm-10">
                        <select id="inputCategory" class="form-select" name="level">
                            <option selected>Choose...</option>
                            <option value="0">Customer</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                remember me!
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sign in/ Sign up</button>
            </form>
        <?php } else {
            $conn = new db;
            $info = $conn->userInfo();
            echo "
            <div class='card' style='width: 18rem;'>
              <ul class='list-group list-group-flush'>
                <li class='list-group-item'>your UserName is: ".$info['username']."</li>
                <li class='list-group-item'>your password is: ".$info['password']."</li>
                <li class='list-group-item'>your Level is: ".$info['level']."</li>
              </ul>
              <div class='card-footer'>
                <a href='logOut.php'>logOut</a>
              </div>
            </div>


            ";
        }
        ?>
    </div>


<?php
require_once("footer.php");

if (isset($_POST['submit'])) {
    $_SESSION["user"] = $_POST['userName'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $session = $userName;
    $data = [
        'userName' => $userName,
        'level' => $level,
        'password' => $password,
        'session' => $session
    ];
    $conn = new db;
    return $conn->user($data);

}

