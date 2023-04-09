<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            z-index: 1;
        }

        .show {
            display: block;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .show a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 8px 0;
        }

        .show a:hover {
            background-color: #ddd;
        }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-j0S7G7jBGAfz8IjupFvsZxDBB738FJaioo/AK8C/xD4z4U4M4b8v1d8f6xrDf6p/" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    
</head>

<body>@include('nav')

    <div>
        <!-- slot -->
        {{ $slot }}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="{{asset('js/home.js')}}"></script>
    <script>
        var dropdown = document.querySelector(".dropdown");
        var dropdownContent = dropdown.querySelector(".dropdown-content");

        dropdown.addEventListener("click", function() {
            dropdownContent.classList.toggle("show");
        });

        window.onclick = function(event) {
            if (!event.target.matches(".dropdown img")) {
                dropdownContent.classList.remove("show");
            }
        }
    </script>
</body>

</html>
