<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>

<body>@include('nav') yooo user
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
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