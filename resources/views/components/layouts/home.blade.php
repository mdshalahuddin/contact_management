<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
    @vite('resources/sass/app.scss')
</head>

<body class="d-flex justify-content-center mt-5">


    {{ $slot }}


</body>

</html>
