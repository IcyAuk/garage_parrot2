<?php
include __DIR__."/template/header.php";
include __DIR__."/lib/pdo.php";
include __DIR__."/lib/article.php";

$error = false;

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $article = getArticleById($pdo, $id);

    if ($article){
        $imagePath = getArticleImage($article["image"]);
        //getArticleImage($article["image"])
    } else {
        $error = true;
    }
} else {
    $error = true;
}
?>

<?php if(!$error) { ?>
    <div class="container px-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="<?= $imagePath; ?>" class="d-block mx-lg-auto img-fluid" alt="<?= htmlentities($article["title"]); ?>"
                    width="700" height="500" loading="lazy">
            </div>

            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis 1h-1 mb-3"><?= $article["title"]; ?></h1>
                <p class="lead">ANNEE : <?= htmlentities($article["price"]); ?></p>
                <p class="lead">PRIX : <?= htmlentities($article["price"]); ?> €</p>
                <p class="lead">KILOMETRAGE : <?= htmlentities($article["km"]); ?> KM</p>
                <p class="lead"><?= htmlentities($article["description"]); ?></p>

                <!-- Form to gather information -->
                <form action="contact.php?id=<?= $article["id"]; ?>" method="get">
                    <input type="hidden" name="article_id" value="<?= $article["id"]; ?>">
                    <label for="title" hidden>Title:</label>
                    <input type="text" name="title" value="<?= $article["title"]; ?>" readonly hidden>
                    <br>

                    <label for="year" hidden>Year:</label>
                    <input type="text" name="year" value="<?= $article["year"]; ?>" readonly hidden>
                    <br>

                    <label for="km" hidden>Kilométrage:</label>
                    <input type="text" name="km" value="<?= $article["km"]; ?>" readonly hidden>
                    <br>

                    <label for="price" hidden>Price:</label>
                    <input type="text" name="price" value="<?= $article["price"]; ?>" readonly hidden>
                    <br>

                    <input type="submit" value="Nous contacter pour ce véhicule" class="btn btn-primary rounded-pill px-3">
                </form>
            </div>
        </div>
    </div>
<?php include __DIR__."/template/footer.php"; ?>
<?php } else { ?>
    <h1>Article Introuvable</h1>
<?php } ?>
