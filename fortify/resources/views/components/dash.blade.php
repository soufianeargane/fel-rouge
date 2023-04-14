<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css file using assets -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>
    <div style="min-height: 100vh; background-color:#f1f5f9" class="flex">
        <div style="box-shadow: 0 0 10px #ddd;" class="w-64 sidebar__ bg-white p-5 relative">
            <h3 class="mb-12 relative text-center font-bold mt-0">Soufiane</h3>
            <ul>
                <li>
                    <a class="flex align-center text-sm text-black rounded-md p-2.5" href="{{route('admin')}}">
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="flex align-center text-sm text-black rounded-md p-2.5" href="{{route('demandes')}}">
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>demandes</span>
                    </a>
                </li>
                <li>
                    <a class="flex align-center text-sm text-black rounded-md p-2.5" href="{{route('admin.categories')}}">
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a class="flex align-center text-sm text-black rounded-md p-2.5" href="index.html">
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a class="flex align-center text-sm text-black rounded-md p-2.5" href="{{route('admin.stores')}}">
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>Stores</span>
                    </a>
                </li>
                <li>
                    <a class="flex align-center text-sm text-black rounded-md p-2.5" href="{{route('admin.comments')}}">
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>Comments</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content w-full">
            <!-- Start Head -->
            <div class="bg-white p-4 head__ flex items-center justify-between">
                <div class="search relative">
                    <input class="p-2.5 focus:w-48" type="search" placeholder="Type A Keyword" />
                </div>
                <div class="icons d-flex align-center">

                    <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{asset('img/avatar.png')}}" alt="user photo">
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div>
                                <!-- logged in admin -->
                                {{ Auth::user()->name }}
                            </div>
                            <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
                            <li>
                                <a href="{{url('profile/edit')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Profile</a>
                            </li>
                            <li>
                                <a href="{{url('profile/password')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Password</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Head -->
            <div class="p-5">
                {{ $slot }}
            </div>
        </div>
    </div>



    <!-- js -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>
