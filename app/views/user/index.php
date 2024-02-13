<?php 
    require 'user-session.php';
?>
<button onclick="window.location.href='../home/logout'">Logout</button>
<h1>User Index Page</h1>
<button onclick="window.location.href='editDetailsView/<?php echo $user_id; ?>'">Edit Details</button>
