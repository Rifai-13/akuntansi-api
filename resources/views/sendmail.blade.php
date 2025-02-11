<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Laravel: Send Email Via SMTP GMAIL @ qadrLabs.com</title>
</head>

<body>
<h2>{{ $email['title'] }}</h2>

<p>Below we include the OTP code to verify your email.</p>
<p>Keep this code secret from your closest people and everyone else.</p>

<p style="font-weight: bolder">
    {{ $email['kode'] }}
</p>

<p>This code is only valid for 5 minutes.</p>
<br>
<p>Regards</p>
<p>Team Development</p>

</body>

</html>
