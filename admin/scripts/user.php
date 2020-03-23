<?php
function createUser($fname, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();
    
    // TO DO: Run a SQL query to create a new user with the provided data
    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email, user_ip) VALUES(:fname, :username, :password, :email, "no")';

    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
        )
    );

    // TO DO: Redirect to index.php if the user was created successfully
    // Otherwise, return an error message
    if($create_user_result){
        redirect_to('index.php');
    }else{
        return 'The user submission did not go though';
    }
}

function getSingleUser($id){
    $pdo = Database::getInstance()->getConnection();

    // TO DO: execute the proper SQL query to fetch the user data whose user_id = $id
    $get_user_query = 'SELECT * FROM tbl_user WHERE user_id= :id';
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_result = $get_user_set->execute(
        array(
            ':id' => $id,
        )
    );

    // TO DO: if the execution is successful, return the user data
    // Otherwise, return an error message
    if($get_user_result){
        return $get_user_set;
    }else{
        return 'There was a problem accessing the user';
    }

}

function editUser($id, $fname, $username, $password, $email){
    // TO DO: set up a database connection
    $pdo = Database::getInstance()->getConnection();

    // TO DO: run the proper SQL query to update tbl_user with proper values
    $update_user_query ='UPDATE tbl_user SET user_fname = :fname, user_name = :username, user_pass = :password, user_email = :email WHERE user_id = :id';
    $update_user_set = $pdo->prepare($update_user_query);
    $update_user_result = $update_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
            ':id'=>$id
        )
    );

    // How to debug
    //echo $update_user_set->debugDumpParams();
    //exit;

    // TO DO: if everything goes well, redirect user to index.php
    // Otherwise, return an error message
    if($update_user_result){
        redirect_to('index.php');
    }else{
        return 'There was a problem updating the user';
    }
}

function getAllUsers(){
    $pdo = Database::getInstance()->getConnection();

    $get_user_query ='SELECT * FROM tbl_user';
    $users = $pdo->query($get_user_query);

    if($users){
        return $users;
    }else{
        return false;
    }
}

function deleteUser($id){
    // TO DO: finish the function to delete the given user
    $pdo = Database::getInstance()->getConnection();

    $delete_user_query = 'DELETE FROM tbl_user WHERE user_id= :id';
    $delete_user_set = $pdo->prepare($delete_user_query);
    $delete_user_result = $delete_user_set->execute(
        array(
            ':id'=>$id
        )
    );

    // If everythung went through, redirect to admin_deleteuser.php
    // Otherwise, return false
    // row count means that the admin cannot be deleted (the rows need to stay more than 0)
    if($delete_user_result && $delete_user_set->rowCount() > 0){
        redirect_to('admin_deleteuser.php');
    }else{
        return false;
    }
}