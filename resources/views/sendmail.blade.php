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

<p>Berikut kami cantumkan kode OTP untuk memverifikasi email anda</p>
<p>Rahasiakan kode ini pada orang terdekat anda</p>

<p style="font-weight: bolder">
    {{ $email['kode'] }}
</p>

<p>Kode ini hanya berlaku selama 5 menit.</p>
<br>
<p>Regards</p>
<p>Tim Development</p>

</body>

</html>
