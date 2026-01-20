<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Broadcasting Client</title>
    @vite('resources/js/app.js')
</head>

<body>

</body>
<script>
    let orderId = 1;
    window.onload = function() {
        Echo.private(`channel-name-${orderId}`)
            .listen('ForPusherEvent', (e) => {
                console.log(e);
            });
    };
</script>

</html>
