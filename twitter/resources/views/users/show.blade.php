<!DOCTYPE html>
<html>
<head>
    <title>User Detail</title>
</head>
<body>
    <h1>User Detail</h1>
    <p>Name: {{ $user->display_name }}</p>
    <p>Email: {{ $user->email }}</p>
</body>
</html>