<?php

function getComments(PDO $pdo, int $limit = null, $page = null): array|bool
{
    $stmt = "SELECT * FROM comments ORDER BY id DESC";

    if ($limit && !$page) {
        $stmt .= " LIMIT :limit";
    }

    if ($page) {
        $stmt .= " LIMIT :offset, :limit";
    }

    $query = $pdo->prepare($stmt);

    if ($limit) {
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    if ($page) {
        $offset = ($page - 1) * $limit;
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
    }

    $query->execute();
    $comments = $query->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}

function getTotalComments(PDO $pdo): int
{
    $stmt = "SELECT COUNT(*) as total FROM comments";

    $query = $pdo->prepare($stmt);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result["total"];
}

function getCommentById(PDO $pdo, int $id): array|bool
{
    $stmt = "SELECT * FROM comments WHERE id = :id";

    $query = $pdo->prepare($stmt);
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();
    $comment = $query->fetch(PDO::FETCH_ASSOC);

    return $comment;
}
