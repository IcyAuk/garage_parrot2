<?php
    $imagePath = getArticleImage($article["image"]);
?>


<div class="col-md-4 my-2">
<div class="card">
    <img src="<?= $imagePath; ?>" class="card-img-top" alt="<?=htmlentities($article['title'])?>">
    <div class="card-body">
        <h5 class="card-title"><?=htmlentities($article["title"])?></h5>
        <h6 class="card-title"><?=htmlentities($article["year"])?></h6>
        <h6 class="card-title"><?=htmlentities($article["km"])?> KM</h6>
        <p class="card-text"><?= htmlentities(substr($article["description"], 0, 70)) ?></p>
        <a href='actualite.php?id=<?=$article["id"]?>' class='btn btn-primary'>Lire la suite</a>
    </div>
</div>
</div>