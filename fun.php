<?php

const SENDER_EMAIL_ADDRESS = 'nileshdarji282003@gmail.com';

// registration 
function register_user(string $email, string $username, string $password, string $activation_code, int $pincode, string $address, int $expiry = 1 * 24  * 60 * 60, bool $is_admin = false): bool
{
    if (!isset($link)) {
        include "comp/config.php";
    }
    $sql = 'INSERT INTO users(username, email, password, is_admin, activation_code, activation_expiry,address,pincode)
            VALUES(?,?, ?,?,?,?,?,?)';

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sssisssi", $username, $email, $password, $is_admin, $activation_code, $time, $address, $pincode);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $activation_code = password_hash($activation_code, PASSWORD_DEFAULT);
    $time = date('Y-m-d H:i:s',  time() + $expiry);

    return $stmt->execute();
}
//find user by user name

// user active
function is_user_active($user)
{
    return (int)$user['active'] === 1;
}
//login
function login(string $username, string $password): bool
{
    if (!isset($link)) {
        include "comp/config.php";
    }
    $sql = 'SELECT *
            FROM users
            WHERE username=? OR email=?';

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result)>0) {

        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            if ($user && is_user_active($user)) {
                setcookie('id', $user['id'], time() + 60 * 60 * 24 * 365 * 3);
                setcookie('username', $user['username'], time() + 60 * 60 * 24 * 365 * 3);
                return true;
            }
        }
    }
    return false;
}
//generate activation code
function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}
//send_activation_email


//delete_user_by_id
function delete_user_by_id(int $id, int $active = 0)
{

    if (!isset($link)) {
        include "comp/config.php";
    }
    $sql = 'DELETE FROM users
            WHERE id =? and active=?';

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "ii", $id, $active);

    return $statement->execute();
}
//find_unverified_user
function find_unverified_user(string $activation_code, string $email)
{
    if (!isset($link)) {
        include "comp/config.php";
    }
    $sql = 'SELECT id, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND email=?';

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "s", $email);
    $statement->execute();
    $result = mysqli_stmt_get_result($statement);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // already expired, delete the in active user with expired activation code
        if ((int)$user['expired'] === 1) {
            delete_user_by_id($user['id']);
            return null;
        }
        // verify the password
        if (password_verify($activation_code, $user['activation_code'])) {
            return $user;
        }
    }
    return null;
}
//activate user
function activate_user(int $user_id): bool
{
    if (!isset($link)) {
        include "comp/config.php";
    }
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE id=?';

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "i", $user_id);
    return $statement->execute();
}




include "comp/config.php";
