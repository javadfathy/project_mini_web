<?php
require_once("header.php");

$conn = new db;
$listp = $conn->productList();
?>
    <div class="container">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel"
             style="width: 600px;margin: auto">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <?php
                $ac = 1;
                foreach ($listp as $slide) {
                    ?>
                    <div class="carousel-item <?php if ($ac == 1) {
                        echo "active";
                    } ?>">
                        <img src="<?= $slide["thumbnail"] ?>" class="d-block w-100" alt="..."
                             style="width: 100%;height: auto">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $slide["name"] ?></h5>
                            <!--                    <p>Some representative placeholder content for the second slide.</p>-->
                        </div>
                    </div>
                    <?php
                    $ac = 2;
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="wrapper">
            <hr>
            <h2>last product</h2>
            <div class="row">
                <?php
                foreach ($listp as $product) {

                    ?>
                    <div class="card" style="width: 31.3333%; margin: 1%;">
                        <img src="<?= $product["thumbnail"] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product["name"] ?></h5>
                            <p class="card-text">
                                <?php
                                if ($product["discount"] == 0) {
                                    echo "Price: ".$product["price"];
                                }
                                ?>

                                <?php
                                if ($product["discount"] != 0) {
                                    echo "<del>Price: ".$product["price"]."</del>";
                                    echo "
                                    <span style='background:red;padding:5px;color:white;border-radius:50px;float: right '>
                                    -" . $product["discount"] . "%</span>";
                                    $disPrice = $product["price"] - ($product["price"] * ($product["discount"] / 100));
                                }

                                ?>
                                <br>
                                <?= $disPrice ?>
                            </p>
                            <a href="#" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

<?php
require_once("footer.php");

