<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Page</title>
    @vite('resources/js/app.js')
</head>

<body>
    {{-- @class, @style, @selected, @checked, @disabled,@method('PUT'), @csrf, @include --}}
    @php
        $dynamicMessage = 'Dynamic Message';
    @endphp
    {{-- <x-navbar :dynamicMessage="$dynamicMessage" staticMessage = "staticMessage" /> --}}
    <x-navbar />
    <x-class-component>
        <x-slot:title>
            <h1>Home Page</h1>
        </x-slot:title>
    </x-class-component>
    @php
        $users = ['Hakim', 'Rakib', 'Hassan', 'Ashik'];
    @endphp
    @foreach ($users as $user)
        @continue($user == 'Rakib')
        <p>{{ $user }}</p>
        @break($user == 'Hassan')
    @endforeach
</body>

</html>
