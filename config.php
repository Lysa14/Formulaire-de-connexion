<?php 

// Fonction pour vérifier la longueur du mot de passe
function validatePasswordLength($password) {
    if (strlen($password) < 8) {
        return false;
    }
    return true;
}

// Fonction pour vérifier la complexité du mot de passe
function validatePasswordComplexity($password) {
    if (!preg_match("#[0-9]+#", $password)) {
        return false;
    }
    if (!preg_match("#[a-z]+#", $password)) {
        return false;
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        return false;
    }
    if (!preg_match("#\W+#", $password)) {
        return false;
    }
    return true;
}

// Fonction pour hasher le mot de passe
function hashPassword($password) {
    $options = [
        'cost' => 12,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}





?>