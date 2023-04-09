<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    
    <title>Login</title>
    <style>
        .bg__,
        .bg-2 {
            background-color: #9c4221 !important;
        }

        .bg__:hover {
            background-color: #b7765f !important;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-2">
    @include('nav')
    <br>


    <form class="mx-auto w-80 p-4 bg-white" action="" method="post">
        @csrf
        <br><input class="w-full appearance-none block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{old('email')}}" type="email" name="email" id="email" placeholder="Email">
        @error('email')
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Holy smokes!</strong>
            <span class="block sm:inline">{{$message}}.</span>
        </div>
        @enderror
        <br><input class="w-full appearance-none block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{old('password')}}" type="password" name="password" id="password" placeholder="Password">
        @error('password')
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Holy smokes!</strong>
            <span class="block sm:inline">{{$message}}.</span>
        </div>
        @enderror
        <br><input class="mr-2 leading-tight mx-auto" type="checkbox" name="remember" id="remember"> remember me
        @if (Route::has('password.request'))
        <br><a class="inline-block mx-auto align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
        <br><input class="shadow bg__ hover:bg-orange-900 focus:shadow-outline focus:outline-none text-dark font-bold py-2 px-4 rounded" type="submit" value="Login">
    </form>
    <script src="{{asset('js/home.js')}}"></script>
</body>

</html>