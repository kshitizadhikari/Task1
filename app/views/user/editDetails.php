<?php 
    if(isset($data['errorMsg'])) { 
        $errorMsg = $data['errorMsg'];
        echo $errorMsg;
    }

    if(isset($data['user'])) { 
        $user = $data['user'];
    } else {
        $user = null; 
    }
    include 'user-header.php';
    require 'user-session.php';

?>

<div class="container d-flex justify-content-center align-items-center h-100vh mt-5" style="height: 80vh;">
    <div class="card p-5 border border-dark" style="max-width: 400px;">
        <h1 class="text-center">Edit User</h1>
        <form action="/Task1/public/user/editDetails" method="POST">

            <input type="hidden" value="<?php echo $csrf_token?>" name="csrf_token">
            <input type="hidden" value="<?php echo $user->id?>" name="id">
            <input type="hidden" value="<?php echo $_SESSION['user_role']?>" name="role">
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control" value="<?php echo $user->username?>" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="text" class="form-control" value="<?php echo $user->email   ?>" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Old Password:</label>
                <input type="password" class="form-control" name="oldPassword" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password:</label>
                <input type="password" name="newPassword" required>
            </div>
            
            <button>Update</button>
        </form>
    </div>
</div>

<?php include 'user-footer.php' ?>