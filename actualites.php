<?php


include __DIR__."/template/header.php";
require_once __DIR__."/lib/config.php";
require_once __DIR__."/lib/pdo.php";
require_once __DIR__."/lib/article.php";


$articles = getArticles($pdo);

?>

<div class="contaier px-5">

<div class="container py-5">
    
    <h1>Nos Voitures</h1>
</div>

<div class="row text-center">
    <?php foreach ($articles as $key => $article){
        require __DIR__."/template/component_article.php";
    }
    ?>
</div>

</div>

<?php include __DIR__."/template/footer.php"?>

