<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="./assets/css/home.css"> -->
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Home</title>
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
</head>

<body>
    <nav>
        <div class=" container">
            <div class="nav__app">
                <div class="f__logo">
                    <div class="logo">
                        <img src="./assets/img/index-logo.png" alt="">
                    </div>
                    <p>My Time</p>
                </div>
                <div class="ul__app">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <a href="{{url('/login')}}">
                        <button>Login</button>
                    </a>
                </div>
                <div id="show-navbar" class="icon__nav">
                    <i class="bi bi-list"></i>
                </div>
            </div>
            <div id="navbar" class="ul__phone navv">
                <ul class="navv">
                    <li class="navv"><a class="navv" href="#">Home</a></li>
                    <li class="navv"><a class="navv" href="#">About</a></li>
                    <li class="navv"><a class="navv" href="#">Services</a></li>
                    <li class="navv"><a class="navv" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container mx-auto">
            <div class="head">
                <h1>ALL The School Supplies You Need. We Make It Easy </h1>
                <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                <a href="">
                    <button>Get Started</button>
                </a>
            </div>
        </div>
    </header>

    <service>
        <div class="container mx-auto mt-20">
            <p class="p-title">SERVICES</p>
            <h1 class="p__head">Why we are different </h1>
            <div class="services__">
                <div class="one__service">
                    <div class="icon__service">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="content__service">
                        <h3>Easy to Use</h3>
                        <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                    </div>
                </div>
                <div class="one__service">
                    <div class="icon__service">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="content__service">
                        <h3>Easy to Use</h3>
                        <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                    </div>
                </div>
                <div class="one__service">
                    <div class="icon__service">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="content__service">
                        <h3>Easy to Use</h3>
                        <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                    </div>
                </div>
            </div>
            <div class="phone__services">
                <div id="default-carousel" class="relative" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out flex justify-center" data-carousel-item>
                            <div class="one__service">
                                <div class="icon__service">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="content__service">
                                    <h3>Easy to Use 1</h3>
                                    <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out flex justify-center" data-carousel-item>
                            <div class="one__service">
                                <div class="icon__service">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="content__service">
                                    <h3>Easy to Use 2</h3>
                                    <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out flex justify-center" data-carousel-item>
                            <div class="one__service">
                                <div class="icon__service">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="content__service">
                                    <h3>Easy to Use 3</h3>
                                    <p>Get the school supplies you need from your favorite store while you're home. We make it easy for you to get the best quality school supplies at the best price.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-2 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span style="background-color: black;" class="inline-flex items-center justify-center w-6 h-6 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-2 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span style="background-color: black;" class="inline-flex items-center justify-center w-6 h-6 rounded-full sm:w-10 sm:h-10 bg-dark dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </service>

    <about class="">
        <div class="pb-8 bg-white">
            <div class="container my-20">
                <div class="about">
                    <p class="p-title">ABOUT</p>
                    <h1 class="p__head">WHo We Are</h1>
                    <div class="about__">
                        <div class="img">
                            <img src="{{asset('img/school_off_06.jpg')}}" alt="">
                        </div>
                        <div class="text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nostrum ipsum debitis, quisquam quidem ad sint similique. Facere, consectetur. Id rem obcaecati adipisci delectus molestiae sint. Similique corrupti porro corporis!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </about>

    <div class="contact">
        <div class="container">
            <div class="contact__">
                <p class="p-title">CONTACT</p>
                <h1 class="p__head">WHo We Are</h1>
                <div class="contact__form">
                    <form class="form" action="">
                        <div class="form__group">
                            <label for="name">Name </label>
                            <input type="text" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="form__group">
                            <label for="email">Email </label>
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form__group">
                            <label for="message">Message </label>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                        </div>
                        <div class="submit_btn">
                            <button type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- js  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
        <script src="{{asset('js/home.js')}}"></script>

</body>

</html>