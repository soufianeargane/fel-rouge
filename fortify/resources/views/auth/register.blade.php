<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <title>register</title>
    <style type="text/tailwindcss">
        @layer utilities {
            .container {
                width: 80%;
                /* margin: 0 auto; */
                margin-left: auto;
                margin-right: auto;
            }
            @media (max-width: 991px) {
                .container {
                    width: 90%;
                }
            }
            @media (max-width: 779px) {
                .container {
                    width: 100%;
                }
            }
        }

    </style>
    <style>
        .bg__,
        .bg-2 {
            background-color:  #92a98f!important;
        }

        .bg__:hover {
            background-color: #93a98f !important;
            cursor: pointer;
        }
        .btn__{
            background-color: #93a98f !important;
            color: #fff !important;
        }
        .btn__:hover{
            background-color: #549450 !important;
            cursor: pointer;
            color: black !important;
        }

        .sss{
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.34);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8.9px);
            -webkit-backdrop-filter: blur(8.9px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="bg-2">
    <div style="background-color:  #eee !important;" >
        @include('nav')
    </div>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="flex container mx-auto">
        <div class="hidden md:block w-1/2">
            <div class="p-4">
                <div
                style="background-image: url({{asset('img/supplies-amico.png')}}); background-size: cover; background-position: center; height: 500px; width: 100%; border-radius: 10px;">


                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 grid place-items-center p-4 md:px-12">
            <form class="w-full  p-4  sss" action="" method="post">
                <div>
                    <h3>
                        <span class="text-2xl font-bold">Welcome !!</span>
                    </h3>
                </div>
                @csrf
                <br><input class="appearance-none block w-full  bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{old('name')}}" type="text" name="name" id="name" placeholder="Name">
                @error('name')
                <div class="mt-2 bg-red-100 border border-red-400 text-red-700 px-2 py-1 rounded relative" role="alert">
                    <strong class="font-bold">Holy smokes!</strong>
                    <span class="block sm:inline">{{$message}}.</span>
                </div>
                @enderror
                <br><input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{old('email')}}" type="email" name="email" id="email" placeholder="Email">
                @error('email')
                <div class="mt-2 bg-red-100 border border-red-400 text-red-700 px-2 py-1 rounded relative" role="alert">
                    <strong class="font-bold">Holy smokes!</strong>
                    <span class="block sm:inline">{{$message}}.</span>
                </div>
                @enderror
                <br><input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{old('password')}}" type="password" name="password" id="password" placeholder="Password">
                @error('password')
                <div class="mt-2 bg-red-100 border border-red-400 text-red-700 px-2 py-1 rounded relative" role="alert">
                    <strong class="font-bold">Holy smokes!</strong>
                    <span class="block sm:inline">{{$message}}.</span>
                </div>
                @enderror
                <br><input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                <br><input class="shadow  focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded btn__" type="submit" value="Register">
            </form>
        </div>
    </div>


    <script src="{{asset('js/home.js')}}"></script>
</body>

</html>
