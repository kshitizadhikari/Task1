<a href="/Task1/public/home/index">Back To Home</a>

<h1>SignUp Page</h1>

<form action="/Task1/public/user/createUser" method="POST">
    <div>
        <label>UserName: </label>
        <input type="text" name="username" required> 
    </div>
    <div>
        <label>Email: </label>
        <input type="email" name="email" required> 
    </div>
    <div>
        <label>Password: </label>
        <input type="password" name="password" required> 
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>