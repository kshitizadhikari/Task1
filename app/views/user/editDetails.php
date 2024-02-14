<?php 
    require 'user-session.php';
    
    if(isset($data['errorMsg'])) { 
        $errorMsg = $data['errorMsg'];
        echo $errorMsg;
    }

    if(isset($data['user'])) { 
        $user = $data['user'];
    } else {
        $user = null; 
    }
?>
<button onclick="window.location.href='../../user/index'">Back To Home</button>
<button onclick="window.location.href='../../home/logout'">Logout</button>

<h1>User Edit Details Page</h1>

<form action="/Task1/public/user/editDetails" method="POST">
    <input type="hidden" value="<?php echo $user->id?>" name="id">
    <input type="hidden" value="<?php echo $_SESSION['user_role']?>" name="role">
    <div>
        <label>Name:</label>
        <input type="text" value="<?php echo $user->username?>" name="username" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="text" value="<?php echo $user->email   ?>" name="email" required>
    </div>
    <div>
        <label>Old Password:</label>
        <input type="password" name="oldPassword" required>
    </div>
    <div>
        <label>New Password:</label>
        <input type="password" name="newPassword" required>
    </div>
    
    <button>Update</button>
</form>