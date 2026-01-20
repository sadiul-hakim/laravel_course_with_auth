<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Second Client</title>
    @vite('resources/js/app.js')
</head>

<body>

</body>
<script>
    let id = 1;
    window.onload = function() {
        setInterval(() => {
            Echo.private(`chat.${id}`)
                .whisper('typing', {
                    name: 'John Doe'
                });
        }, 1000);
    };
</script>

</html>
