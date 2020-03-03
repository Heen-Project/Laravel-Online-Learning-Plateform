<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bluejack Online Learning: Verification Mail</title>
</head>
<body>
	<h2>Change Password</h2>
        <div>
        	{{ $firstName }} {{ $lastName }}, <br>
            {{ $username }}, Please follow the link below to change your password : <br>
            <hr>
            {{ URL::to('profile/password/edit/'.$confirmation_code) }}
        </div>
</body>
</html>