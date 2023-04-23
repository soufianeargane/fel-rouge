<!-- hide login and register if user is logged in -->
<style>
    .shodow__{
        box-shadow: 0px 10px 17px 0px rgba(69,62,62,0.21);
        /* -webkit-box-shadow: 0px 10px 17px 0px rgba(69,62,62,0.51);
        -moz-box-shadow: 0px 10px 17px 0px rgba(69,62,62,0.51); */
    }
</style>

<nav class="bg-white shodow__">
    <div class=" mx-auto container ">
        <div class="nav__app">
            <div class="f__logo">
                <a class="flex justify-center items-center" href="/">
                <div class="logo">
                    <img src="./assets/img/index-logo.png" alt="">
                </div>
                <p>My Time</p>
                </a>
            </div>
            <div class="flex justify-between items-center">
                @if (Auth::check())
                <ul class="flex justify-between items-center">
                    <li class="mr-6">
                        <a href="{{route('user.orders')}}">
                            orders
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="/user">
                            stores
                        </a>
                    </li>
                </ul>

                
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
                            <ul style="display: block" class="py-2 text-sm text-gray-700 dark:text-gray-200 block" aria-labelledby="dropdownUserAvatarButton">
                                <li>
                                    <a href="{{url('profile/edit')}}" class="block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Profile</a>
                                </li>
                                <li>
                                    <a href="{{url('profile/password')}}" class="block  py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Password</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>





{{-- <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
    <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
        <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="flex flex-row items-center justify-between p-4">
                <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Mytime</a>
                <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{url('/')}}">Home</a>
                @if (Auth::check())
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{route('user.orders')}}">Orders</a>
                <div class="dropdown">
                    <img src="settings-icon.png" alt="Settings" width="20" height="20">
                    <div class="dropdown-content">
                        <p>
                            {{Auth::user()->name}}
                        </p>
                        <a href="{{url('profile/edit')}}">Update Profile</a>
                        <a href="{{url('profile/password')}}">Update Password</a>
                        <a href="{{url('/logout')}}">Logout</a>
                    </div>
                </div>
                @else
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{url('/login')}}">Login</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{url('/register')}}">Register</a>
                @endif
            </nav>
        </div>
    </div>
</div> --}}
<!-- <a href="{{url('/')}}">Home</a>. -->
