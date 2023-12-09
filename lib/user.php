<?php

function verifyUserLoginPassword(PDO $pdo, string $email, string $password):array|bool
{
    $query = $pdo->prepare("SELECT * FROM moderators WHERE email = :email");
    $query->bindValue(":email",$email,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    if($user && password_verify($password,$user["password"])){
        return $user;
    }else{
        return false;
    }
}

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user"){
    $stmt = "INSERT INTO moderators (
        'first_name' , 'last_name' , 'email' , 'password' , 'role'
    )
            VALUES (
                :first_name , :last_name , :email , :password , :role
            )";
    $query = $pdo->prepare($stmt);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindParam(":first_name", $first_name, PDO::PARAM_STR);
    $query->bindParam(":last_name", $last_name, PDO::PARAM_STR);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->bindParam(":password", $password, PDO::PARAM_STR);
    $query->bindParam(":role", $role, PDO::PARAM_STR);

    return $query->execute();
}