<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>

<body>
    <form action="/login" method="post">
        @csrf
        <fieldset>
            <legend>Login Please</legend>
            <div>
                <label for="email">Email</label><br />
                <input type="email" name="email" id="email" />
            </div><br />
            <div>
                <label for="password">Password</label><br />
                <input type="password" name="password" id="password" />
            </div><br />
            <button type="submit">Login</button>
        </fieldset>
    </form>
</body>

</html>
