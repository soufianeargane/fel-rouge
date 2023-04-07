<x-store>
    <style>
        .star-rating i {
        color: #ddd;
        font-size: 18px;
        cursor: pointer;
        }

        .star-rating i.active,
        .star-rating i:hover {
        color: #f1c40f;
        /* background-color: #f1c40f; */
}

    </style>
    <div class="container mx-auto">
        <div class="flex">
            <div class="w-2/3">
                <section class="text-gray-700 body-font overflow-hidden bg-white">
                    <div class="container py-5 mx-auto">
                        <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg">
                        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest">Store NAME</h2>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 capitalize">
                                {{ $store->title }}
                            </h1>
                            <div class="flex mb-4">
                            {{-- <span class="flex items-center">
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                <span class="text-gray-600 ml-3">4 Reviews</span>
                            </span> --}}
                            <div class="star-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                <a class="text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                                </a>
                                <a class="ml-2 text-gray-500">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                                </a>
                            </span>
                            </div>
                            <p class="leading-relaxed">
                                {{ $store->phone }}
                            </p>
                            <p class="leading-relaxed font-bold uppercase">
                                {{ $store->user->name }}
                            </p> <span>
                                    {{ $store->user->email }}
                                </span>
                            <p class="leading-relaxed mt-5">
                                {{ $store->neighborhood }}, {{ $store->city }}
                            </p>

                        </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- comments -->
            <div class="w-1/3 pr-8">
                    <section class="bg-white dark:bg-gray-900 py-6">
                        <div class="max-w-2xl mx-auto px-4">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Leave a comment</h2>
                            </div>
                            <form method="post" action="" class="mb-2">
                                <div class="py-2 px-1 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <input
                                     id="comment"
                                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                        placeholder="Write a comment..." />
                                </div>
                                <div class="star-rating">
                                    <i class="fa-solid fa-star" data-value="1"></i>
                                    <i class="fa-solid fa-star" data-value="2"></i>
                                    <i class="fa-solid fa-star" data-value="3"></i>
                                    <i class="fa-solid fa-star" data-value="4"></i>
                                    <i class="fa-solid fa-star" data-value="5"></i>
                                </div>
                                <input type="hidden" 
                                name="rating" id="rating">
                                <input type="hidden" id="store_id"
                                name="store_id" value="{{ $store->id }}"
                                >
                                <button type="button" id="submit_rating"
                                    class="px-2 py-1 bg-blue-500 rounded-lg text-white">
                                    Share
                                </button>
                            </form>
                            <div>
                            <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                        class="mr-2 w-6 h-6 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                        alt="Michael Gough">Michael Gough</p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                        title="February 8th, 2022">Feb. 8, 2022</time></p>
            </div>

            <!-- Dropdown menu -->

        </footer>
        <p class="text-gray-500 dark:text-gray-400">Very straight-to-point article. Really worth time reading. Thank you! But tools are just the
            instruments for the UX designers.</p>
    </article>
                            </div>

                        </div>
                    </section>
                </div>
        </div>
    </div>

    <div>
    <div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <a
    href="/store/{{ $store->id }}"
    >
        <!-- button to buy -->
        <button
            type="button"
            class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            Buy now
        </button>
    </a>
    <!-- input search -->
    <input id="search-input" type="text"
        class="relative m-0  flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-neutral-700 outline-none transition duration-300 ease-in-out focus:border-primary-600 focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
        placeholder="Search"
        >

        <div class="flex gap-2 flex-wrap">
            @foreach ($products as $product)
            <div class="mt-4 p-2 mx-auto sm:mx-0">
        <div class="group relative">
            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 ">
            <img
            src="{{ asset('img/products/'.$product->image)}}" width="250px" height="300px"  class=" object-cover object-center">
            </div>
            <div class="mt-4 flex justify-between">
            <div>
                <h3 class="text-sm text-gray-700 search-js">

                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ $product->name }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    <!-- product category if it exists -->
                    @if ($product->category)
                    {{ $product->category->name }}
                    @endif
                </p>
            </div>
            <p class="text-sm font-medium text-gray-900">
                {{ $product->price }} DHs
            </p>
            </div>
            </div>

        </div>


            @endforeach
        </div>
    </div>
  </div>
</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <script>
        // search on keyup by h3 with class search-js and hide the div
        $(document).ready(function(){
            $("#search-input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                console.log(value);
                $(".search-js").filter(function() {
                $(this).parent().parent().parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function() {
            $('.star-rating i').click(function() {
                var rating = $(this).data('value');
                $('#rating').val(rating);
                console.log(rating);
                $(this).addClass('active');
                $(this).prevAll().addClass('active');
                $(this).nextAll().removeClass('active');
            });
        });

        $(document).ready(function() {
            $('#submit_rating').click(function() {
                var rating = $('#rating').val();
                var store_id = $('#store_id').val();
                var comment = $('#comment').val();
                // validation
                if (rating == '') {
                    alert('Please select rating');
                    return false;
                }
                if (comment == '') {
                    alert('Please enter comment');
                    return false;
                }
                console.log(rating);
                console.log(store_id);
                console.log(comment);
                $.ajax({
                    url: '/client/store/rating',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {
                        rating: rating,
                        store_id: store_id,
                        comment: comment,
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });


        // ajax call to get comments and ratings
        $(document).ready(function() {
            var store_id = $('#store_id').val();
            $.ajax({
                url: '/client/store/rating/details/' + store_id,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    return;
                }
                });
        });
    </script>

</x-store>
<script src="https://kit.fontawesome.com/1c3b083d98.js" crossorigin="anonymous"></script>
