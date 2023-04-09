<x-store>
    <style>
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }
        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            margin: -25px 0 0 -25px;
            border: 5px solid #ccc;
            border-top-color: #333;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .show--js{
                display: none;
            }
        }
        @media (min-width: 768px) {
            .media__{
                display: block;
                position: relative;
            }
        }

        .media__{
            display: block ;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 999;
            transition: all 0.3s ease-in-out;
        }

        

    </style>

    <div id="loader" class="loader hidden">
        <div class="spinner"></div>
    </div>
    <div class="flex">
        <button id="toggleSidebarMobile" class="fixed bottom-4 right-4 z-50 bg-red-800 text-white p-2 rounded-full shadow-md block md:hidden">
            <i class="bi bi-layout-text-sidebar-reverse"></i>
        </button>
        <div style="min-height: 100vh" class=" sidebar show--js  relative w-60 p-4 bg-red-800">
            
            <div class="content--js">
                <a href="{{route('store.create')}}">
                    <button class="bg-red-300 rounded p-2">apply to have a store</button>
                </a>
                <div class="mt-2">
                    <select class="city_input" id="select-beast" placeholder="Select a city..." autocomplete="off">
                        <option selected disabled value="">Select a city...</option>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>

                    <button
                    class="bg-red-300 rounded p-1 mt-2 search-btn"
                    >
                        search
                    </button>
                </div>
            </div>
            
        </div>
        
        
        <div style class="bg-gray-100 py-2 px-4 make-w-full w-full">
            <h3>Stores</h3>
            {{-- cards tailwind --}}
            <div id="stores" class="flex flex-wrap gap-4">

            </div>
        </div>
    </div>




</x-store>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
{{-- jquery cdn --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    new TomSelect("#select-beast",{
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    function getAllStores(){
        $(document).ready(function() {
            const loader = $('#loader');

            // Trigger the AJAX request (e.g., on a button click, page load, or any other event)
            loader.removeClass('hidden'); // Show the loader
            $.ajax({
                type: "GET",
                url: "{{route('store.index')}}",
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    loader.addClass('hidden'); // Hide the loader
                    displayStores(response);
                },
                error: function() {
                    loader.addClass('hidden'); // Hide the loader
                    console.error('Error fetching data');
                }
            });
        });
    }

    getAllStores();


    function displayStores(data) {
        const stores = data.stores;
        const storesDiv = $('#stores');
        storesDiv.empty();
        if(stores.length == 0) {
            const storesDiv = $('#stores');
            storesDiv.append('<h3>No stores found</h3>');
            return;
        }
        stores.forEach(store => {
            const storeDiv = `
            <div class="w-80 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto lg:mx-0">
                <a href="#">
                    <div
                    style="background-size: cover; background-position: center; background-image: url('img/store/${store.image}'); height: 250px; width: 100%; background-repeat: no-repeat;"
                    ></div>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            ${store.title}
                        </h5>
                    </a>
                    {{-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p> --}}
                    <a href="store/${store.id}/details" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Products
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                </div>
            `
            storesDiv.append(storeDiv);
        });
    }

    $(document).ready(function() {
        const loader = $('#loader');
        $('.search-btn').click(function() {
            const city = $('.city_input').val();
            console.log(city);
            if (!city) {
                getAllStores();
                return;
            }
            loader.removeClass('hidden'); // Show the loader
            $.ajax({
                type: "GET",
                url: "/store/city/"+city,
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    loader.addClass('hidden'); // Hide the loader
                    displayStores(response);
                },
                error: function() {
                    loader.addClass('hidden'); // Hide the loader
                    console.error('Error fetching data');
                }
            });
        });
    });

    $(document).ready(function() {
        const toggleBtn = $('#toggleSidebarMobile');
        toggleBtn.click(function() {
            const sidebar = $('.sidebar');
            sidebar.toggleClass('media__');
        });

        
    });

    // style="background-size: cover; background-position: center; background-image: url('img/store/${store.image}'); height: 250px; width: 100%; background-repeat: no-repeat;"
</script>
