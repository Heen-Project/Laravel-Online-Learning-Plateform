<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bluejack Online Learning: Password Reset Confirmation</title>
</head>
<body>
	<h2>Password Reset</h2>
        <div>
        		{{ $firstName }} {{ $lastName }} <br>
            Thanks for Registering Bluejack Online Learning. <br>
            Your Register username is :	{{ $username }} <br>
            Please follow the link below to activate your account : <br>
            <hr>
            {{ URL::to('guest/register/verify/'.$confirmation_code) }}
        </div>
</body>
</html>