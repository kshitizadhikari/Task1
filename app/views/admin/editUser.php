<?php 
    require 'admin-session.php';

    if(isset($data['user'])) {
        $user = $data['user'];
    }
?>
<h1>Admin Edit User Page</h1>

<form action="/Task1/public/admin/editUser" method="POST">
    <input type="hidden" value="<?php echo $user->id?>" name="id">
    <div>
        <label>Name:</label>
        <input type="text" value="<?php echo $user->username?>" name="username">
    </div>
    <div>
        <label>Email:</label>
        <input type="text" value="<?php echo $user->email?>" name="email">
    </div>

    <div>
        <label>Role:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
            <option value="designer">Designer</option>
            <option value="qa">QA</option>
        </select>
    </div>
    <button type="submit">Update</button>
</form>
