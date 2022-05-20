<?php

class db
{

    public function __construct()
    {

    }


    public static function addProduct($data = "")
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "javadfathi";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





        $sql = "INSERT INTO product (name, count, description, thumbnail, category, price, discount) VALUES (:name, :inventory, :description, :thumbnail, :category, :price, :discount)";
        $conn->prepare($sql)->execute($data);
    }

    public static function user($data = "")
    {
        $userName = $data['userName'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "javadfathi";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$userName]);
        $result = $stmt->fetch();
        if ($result == '') {
            $sql = "INSERT INTO users (username, password,level, session) VALUES (:userName, :password, :level, :session)";
            $conn->prepare($sql)->execute($data);
            ?>
            <div class="alert alert-success" role="alert">
                welcome <?= $userName; ?>
            </div>
            <?php
            $_SESSION["user"] = $data["session"];
            header('Location: sign.php');
        } else {
            $stmt = $conn->prepare("SELECT session FROM users WHERE username='$userName'");
            $stmt->execute();
            $resultS = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $_SESSION["user"] = $data["session"];
            ?>
            <div class="alert alert-success" role="alert">
                welcome <?= $userName; ?>(where are you?)
            </div>
            <?php
            header('Location: sign.php');
        }


    }

    public static function userInfo()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "javadfathi";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $conn->prepare("SELECT * FROM users WHERE session=?");
        $stmt->execute([@$_SESSION["user"]]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function productList(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "javadfathi";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->query("SELECT * FROM product ORDER BY `id` DESC");
//        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function levelUser($data){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "javadfathi";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT level FROM users WHERE username=?");
        $stmt->execute([$data]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}