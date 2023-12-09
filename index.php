<?php 

require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";

require_once __DIR__ . "/template/header.php";

$articles = getArticles($pdo, HOME_ARTICLES_LIMIT);
?>

<section class="bg-light text-dark p-5 text-center text-sm-start">
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1>We give you<span class="text-danger">
                        the cars you want.
                    </span> </h1>
                <p class="lead my-4">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam vel ab aliquid velit quisquam
                    pariatur minus? Qui accusamus id numquam quis consequuntur, quo mollitia nihil, temporibus rerum
                    itaque tempore doloribus!
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam vel ab aliquid velit quisquam
                    pariatur minus? Qui accusamus id numquam quis consequuntur, quo mollitia nihil, temporibus rerum
                    itaque tempore doloribus!
                </p>
                <a href="actualites.php" class="btn btn-danger btn-lg">Have a look at our articles</a>
            </div>
            <img class="img-fluid w-50 d-none d-sm-block" src="assets/img/parrot.png" alt="placeholder image alt">
        </div>
    </div>
</section>
<section class="bg-dark text-light p-5">
    <div class="container">
        <div class="d-md-flex">
            <h3 class="mb-3 mb-md-0">Cars of the day</h3>
        </div>
    </div>
</section>

<div class="row py-5 mx-5">
    <?php foreach($articles as $key => $article) {
include __DIR__."/template/component_article.php";
} ?>
</div>

<?php require_once __DIR__ . "/template/footer.php"; ?>