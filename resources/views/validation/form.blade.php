<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    @vite('resources/js/app.js')
</head>

<body>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/form/validation-custom-request" method="post">
        @csrf
        <div>
            <label for="name">Name</label><br />
            <input type="text" name="name" id="name" placeholder="name" value="{{ old('name') }}" />
            <br />
            @error('name')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="email">Email</label><br />
            <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}" />
            <br />
            @error('email')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="password">Password</label><br />
            <input type="password" name="password" id="password" placeholder="password"
                value="{{ old('password') }}" />
            <br />
            @error('password')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="date_of_birth">Date of Birth</label><br />
            <input type="date" name="date_of_birth" id="date_of_birth" placeholder="date_of_birth"
                value="{{ old('date_of_birth') }}" />
            <br />
            @error('date_of_birth')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="publish_at">Publish At</label><br />
            <input type="text" name="publish_at" id="publish_at" placeholder="publish_at"
                value="{{ old('publish_at') }}" />
            <br />
            @error('publish_at')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="payment_type">Payment Type</label><br />
            <input type="text" name="payment_type" id="payment_type" placeholder="payment_type"
                value="{{ old('payment_type') }}" />
            <br />
            @error('payment_type')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="card_number">Card Number</label><br />
            <input type="number" name="card_number" id="card_number" placeholder="card_number"
                value="{{ old('card_number') }}" />
            <br />
            @error('card_number')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <div>
            <label for="file">File</label><br />
            <input type="file" name="file" id="file" value="{{ old('file') }}" />
            <br />
            @error('file')
                <mark>{{ $message }}</mark>
            @enderror
        </div><br />
        <button type="submit">Send</button>
    </form>
</body>

</html>
