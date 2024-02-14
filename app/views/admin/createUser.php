<?php 
    require 'admin-session.php';
    if(isset($data['user'])) {
        $user = $data['user'];
    }
    include 'header.php' 
?>


<div class="container d-flex justify-content-center align-items-center h-100vh mt-5" style="height: 80vh;">
    <div class="card p-5 border border-dark" style="max-width: 400px;">
        <h1 class="text-center">Create User</h1>
        <form action="/Task1/public/admin/createUser" method="POST">
            <div class="mb-3">
                <label class="form-label">UserName</label>
                <input type="text" class="form-control border border-dark" name="username">
                <!-- <div class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control border border-dark" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control border border-dark" name="password">
            </div>

            <div class="mb-3">
                <label>Role:</label>
                <select name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    <option value="designer">Designer</option>
                    <option value="qa">QA</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">CreateUser</button>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>


