<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>List of users from database</h2>
    <a  class="btn btn-primary" href="signUp.php" role="button">Signup</a>
    <br>
    <br>
    <table class="table">
       <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>tel</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
     //include connection file
    include_once('connection.php');
    //create in instance of class Connection
    $connection= new Connection();
    //call the selectDatabase method
    $connection->SelectDatabase('cahierDeTexte');
    //include the client file
    include('user.php');
    //call the static selectAllClients method and store the result of the method in $clients
    $users=User::selectAllUsers('user',$connection->conn);
    foreach($users as $row) {
        echo " <tr>
        <td>$row[id_user]</td>
        <td>$row[firstname]</td>
        <td>$row[lastname]</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[role]</td>
        <td>
        <a class ='btn btn-success btn-sm' href='update.php?id=$row[id_user]'>edit</a>
        <a class ='btn btn-danger btn-sm' href='delete.php?id=$row[id_user]'>delete</a>
        </td>
        </tr>";
        }
        
        ?>
        </tbody>
        
    </table>
    </div>
</body>
</html>
