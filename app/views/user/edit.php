<?php 
if(isset($data['user'])) {
    $user = $data['user'];
}
?>
<form action="/MVC/public/user/editUser" method="POST">
    <input type="hidden" value="<?php echo $user[0]['id']?>" name="id">
    <div>
        <label>Name:</label>
        <input type="text" value="<?php echo $user[0]['username']?>" name="username">
    </div>
    <div>
        <label>Email:</label>
        <input type="text" value="<?php echo $user[0]['email']?>" name="email">
    </div>
    <div>
        <label>Password:</label>
        <input type="password" value="<?php echo $user[0]['password']?>" name="password">
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
    <button>Update</button>
</form>