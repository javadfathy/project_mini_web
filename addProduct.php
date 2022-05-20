<?php
require_once("header.php");
$conn = new db;
$leveluser = $conn->levelUser(@$_SESSION["user"]);
$leveluser = $leveluser['level'];

if (@$_SESSION["user"] == "" || $leveluser == 0) {

    header('Location: index.php');
}
?>

<div class="container">
    <?php if (isset($_POST['submit'])) {
        ?>
        <div class="alert alert-success" role="alert">
            Product added successful:)

        </div>
        <?php
    }
    ?>
    <form class="row g-3" method="post"  enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputName4" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName4" name="nameProduct">
        </div>
        <div class="col-md-6">
            <label for="inputInventory4" class="form-label">Inventory</label>
            <input type="number" class="form-control" id="inputInventory4" name="inventory">
        </div>
        <div class="col-12">
            <label for="inputDescription" class="form-label">Description</label>
            <textarea class="form-control" id="inputDescription" placeholder="Description" name="description"
                      rows="3"></textarea>
        </div>
        <div class="col-12">
            <label for="thumbnail" class="form-label">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
        </div>
        <div class="col-md-6">
            <label for="inputCategory" class="form-label">Category</label>
            <select id="inputCategory" class="form-select" name="category">
                <option selected>Choose...</option>
                <option>cat1</option>
                <option>cat2</option>
                <option>cat3</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="inputPrice" name="price">
        </div>
        <div class="col-md-2">
            <label for="inputDisCount" class="form-label">DisCount(%)</label>
            <input type="number" class="form-control" id="inputDisCount" name="discount">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="submit">Insert</button>
        </div>
    </form>
</div>


<?php
require_once("footer.php");
if (isset($_POST['submit'])) {

    $file = $_FILES["thumbnail"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $fileTmp = $file["tmp_name"];
    $fileType = $file["type"];
    $fileError = $file["error"];
    $uploadOk = 1;
    $target = 'thumbnail/';
    $newName = 'productPic'.time();
    if ($fileType != 'image/jpg' and $fileType != 'image/jpeg') {
        $uploadOk = 0;
        echo "format";
    }
    if ($fileSize > 1000000) {
        $uploadOk = 0;
        echo "size";
    }
    if ($uploadOk == 1) {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $target = $target . $newName . '.' . $ext;
        move_uploaded_file($fileTmp, $target);
    }
    $name = $_POST['nameProduct'];
    $inventory = $_POST['inventory'];
    $description = $_POST['description'];
    $thumbnail = $target;
    $category = $_POST['category'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];

    $data = [
        'name' => $name,
        'inventory' => $inventory,
        'description' => $description,
        'thumbnail' => $thumbnail,
        'category' => $category,
        'price' => $price,
        'discount' => $discount,
    ];
    if($uploadOk == 1){
        $conn = new db;
        return $conn->addProduct($data);
    }


}
?>
