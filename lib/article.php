<?php

function getArticles(PDO $pdo, int $limit = null, $page = null):array|bool
{
    $stmt = "SELECT * FROM articles ORDER BY id DESC";

    if($limit && !$page){
        $stmt .= " LIMIT :limit";
    }  

    if ($page){
        $stmt .= " LIMIT :offset, :limit";
    }
    
    $query = $pdo->prepare($stmt);

    if($limit){
        $query->bindValue(':limit',$limit,PDO::PARAM_INT);
    }

    if($page){
        $offset = ($page - 1) * $limit;
        $query->bindValue(':offset',$offset,PDO::PARAM_INT);
    }

    $query->execute();
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);

    return $articles;
}

function getTotalArticles(PDO $pdo):int
{
    $stmt = "SELECT COUNT(*) as total FROM articles";
    
    $query = $pdo->prepare($stmt);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result["total"];
}

function getArticleById(PDO $pdo, int $id):array|bool
{
    $stmt = "SELECT * FROM articles WHERE id = :id";

    
    $query = $pdo->prepare($stmt);
    $query->bindValue(':id',$id,PDO::PARAM_INT);

    $query->execute();
    $articles = $query->fetch(PDO::FETCH_ASSOC);

    return $articles;
}

function getArticleImage(string|null $image):string
{
    if($image === null || $image === " " || $image === ""){
        return "assets/img/default-article.jpg";
    } else {
        return "uploads/articles/".htmlentities($image);
    }
}