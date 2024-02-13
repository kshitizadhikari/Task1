<?php 
    require 'admin-session.php';
    
    if(isset($data['result'])) {
        $users = $data['result'];
    }
?>

<button onclick="window.location.href='../home/logout'">Logout</button>

<h1>Admin Index Page</h1>
<button onclick="window.location.href='createUserView'">Create User</button>


<table>
    <thead>
        <tr>
            <th>UserName</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user){
            ?>
        <tr>
            <td><?php echo $user['username'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['role'] ?></td>
            <td><a href="edit<?php echo $user['id']; ?>">Edit</a> | 
            <a href="deleteUser<?php echo $user['id']; ?>">Delete</a></td>
        </tr>
    </tbody>
        <?php
        }
        ?>
        
</table>
