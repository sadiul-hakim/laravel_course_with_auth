<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>

<body>
    <div>
        <x-navbar />
        <h1>Profile</h1>
    </div>
    @if (session('message'))
        <div style="background-color: lightgreen; color:green;padding:10px; margin:10px 0;text-align: center;">
            {{ session('message') }}
        </div>
    @endif
    <div>

    </div>
    <h2>Update Profile</h2>
    <form action="/save-profile" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" placeholder="your name"
            value="{{ old('name') }}"><br /><br />
        <input type="file" name="file" id="file" /><br /><br />
        <input type="submit" value="save">
    </form>
</body>

</html>
