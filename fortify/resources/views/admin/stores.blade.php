<x-dash>

        <!-- tailwind classes -->

        <div class="flex justify-between flex-wrap">
                @foreach ($stores as $store)
                <div

                    class="block mb-3 rounded-lg bg-white w-72 shadow-lg dark:bg-neutral-700">
                    <a href="#!">
                    <img
                        class="rounded-t-lg"
                        src="https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg"
                        alt="" />
                    </a>
                    <div class="p-6">
                    <h5
                        class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        {{$store->title}}
                    </h5>
                    <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                        Some quick example text to build on the card title and make up the
                        bulk of the card's content.
                    </p>
                    <a href="/admin/store-details/{{$store->id}}">
                        <button
                            type="button"
                            class="px-4 py-2 font-semibold text-white transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-blue-500 hover:bg-blue-500 dark:hover:bg-blue-400 focus:outline-none focus:bg-blue-500 dark:focus:bg-blue-400"
                                                    >
                            Button
                        </button>
                    </a>
                    </div>
                </div>
                @endforeach



        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

        });
    </script>



</x-dash>
