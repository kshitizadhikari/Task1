<?php 
if(isset($data['user'])) {
    $user = $data['user'];
}
?>
<h1>Admin Create User Page</h1>

<form action="/Task1/public/admin/createUser" method="POST">
    <input type="hidden" name="id">
    <div>
        <label>Name:</label>
        <input type="text" name="username">
    </div>
    <div>
        <label>Email:</label>
        <input type="text" name="email">
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password">
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
    <button>Create</button>
</form>