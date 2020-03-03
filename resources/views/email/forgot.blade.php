<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bluejack Online Learning: Verification Mail</title>
</head>
<body>
	<h2>Reset Password</h2>
        <div>
        	{{ $firstName }} {{ $lastName }}, <br>
            {{ $username }}, Please ignore this message if you do not request a password change. <br>
            Please follow the link below to reset your password : <br>
            <hr>
            {{ URL::to('guest/password/verify/'.$confirmation_code) }}
        </div>
</body>
</html>