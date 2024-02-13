<?php 
    require 'user-session.php';

    $user = $data['user'];
?>
<h1>User Edit Details Page</h1>

<form action="/Task1/public/user/editUser" method="POST">
    <input type="hidden" value="<?php echo $user->id?>" name="id">
    <input type="hidden" value="<?php echo $_SESSION['user_role']?>" name="role">
    <div>
        <label>Name:</label>
        <input type="text" value="<?php echo $user->username?>" name="username" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="text" value="<?php echo $user->emailA?>" name="email" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    
    <button>Update</button>
</form>