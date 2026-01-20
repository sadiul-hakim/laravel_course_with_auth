<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>First Client</title>
    @vite('resources/js/app.js')
</head>

<body>

</body>
<script>
    let id = 1;
    window.onload = function() {
        Echo.private(`chat.${id}`)
            .listenForWhisper('typing', (e) => {
                console.log(e.name + ' is typing....');
            })
    };
</script>

</html>
