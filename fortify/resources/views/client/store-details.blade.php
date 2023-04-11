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
        <div class="flex flex-wrap">
            <div class="w-full md:w-2/3">
                <section class="text-gray-700 body-font overflow-hidden ">
                    <div class="py-5 mx-auto">
                        <div class="flex flex-wrap md:flex-nowrap">
                        <div
                        style="width: 279px; height: 330px; background-image: url({{ asset('img/store/'.$store->image) }}); background-size: cover; background-position: center;"
                        class="mx-auto md:mx-0 "
                        >

                        </div>
                        <div class="w-full md:w-1/2  pl-5 lg:py-6 mt-6 lg:mt-0">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest">Store NAME</h2>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1 capitalize">
                                {{ $store->title }}
                            </h1>
                            <div class="flex mb-4">
                            <div class="star-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>

                            </div>
                            <p class="leading-relaxed">
                                {{ $store->phone }}
                            </p>
                            <p class="leading-relaxed font-bold uppercase">
                                {{ $store->user->name }}
                            </p>
                            <p>
                                    {{ $store->user->email }}
                            </p>
                            <p
                            class="leading-relaxed mt-4 font-bold"
                            >
                                Adress:
                            </p>
                            <p class="leading-relaxed">
                                {{ $store->neighborhood }}, {{ $store->city->name }}
                            </p>
                            <!-- <p class="leading-relaxed mt-5">
                                {{ $store->neighborhood }}, {{ $store->city }}
                            </p> -->

                        </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- comments -->
            <div class="w-full md:w-1/3 ">
                    <section class=" dark:bg-gray-900 py-6">
                        <div class="max-w-2xl mx-auto px-4">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Leave a comment</h2>
                            </div>
                            <form method="post" action="" class="mb-2">
                                <div class="py-2 bg-white px-1 mb-1  rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
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
                                    class="px-2 py-1 bg-blue-500 rounded-lg text-white disabled:bg-blue-600 ">
                                    <div id="loading"
                                        class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                                        role="status"
                                        style="display:none">
                                        <span
                                            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
                                            >Loading...</span
                                        >
                                    </div>
                                    Share
                                </button>
                            </form>
                            <div id="comments">

                            </div>

                        </div>
                    </section>
                </div>
        </div>
    </div>

    <div>
    <div class="">
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
            <div class=" aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 ">
            <img
            src="{{ asset('img/products/'.$product->image)}}" width="150px" height="150px"
            style="width: 150px !important; height: 150px !important;"
            >
            </div>
            <div class="mt-4 flex justify-between">
            <div>
                <h3 class="text-sm text-gray-800 font-medium search-js">

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
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
                // disable button
                $('#submit_rating').attr('disabled', true);
                $('#loading').show();
                // ajax call
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
                        // clear form
                        $('#comment').val('');
                        $('#rating').val('');
                        // if data has message property
                        if (data.message) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,

                                })
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: data.message,
                                    showConfirmButton: true,

                                })

                            }
                        }
                        $('#loading').hide();
                        $('#submit_rating').attr('disabled', false);
                        getComments();
                    }
                });
            });
        });


        // ajax call to get comments and ratings

        function getComments() {
            $(document).ready(function() {
            var store_id = $('#store_id').val();
            $.ajax({
                url: '/client/store/rating/details/' + store_id,
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    updateStarColors(data);
                    return;
                }
                });
            });
        }
        getComments();
        function updateStarColors(data) {
            console.log(data);
            const rating = data.average_rating;
            const stars = $('.star-rating i');
            stars.removeClass('active');

            for (let i = 0; i < rating; i++) {
                stars.eq(i).addClass('active');
            }

            const commentsDiv = $('#comments');
            let comments = data.latest_comments;
            commentsDiv.empty();

            comments.forEach(comment => {
                const commentHtml = `
                <article class="p-2 mb-1 text-base bg-white rounded-lg dark:bg-gray-900">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                                                class="mr-2 w-6 h-6 rounded-full"
                                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                                alt="Michael Gough">
                                            <span class="font-semibold">${comment.user_name}</span>
                                                </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                                title="February 8th, 2022">
                                                ${comment.created_at}
                                                </time></p>
                                    </div>

                                    <!-- Dropdown menu -->

                                </footer>
                                <p class="text-gray-500 dark:text-gray-400 text-xs">
                                    ${comment.comment}
                                .</p>
                            </article>`;
                commentsDiv.append(commentHtml);
            });

        }
    </script>

</x-store>
<script src="https://kit.fontawesome.com/1c3b083d98.js" crossorigin="anonymous"></script>
