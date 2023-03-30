<x-store>
    <div class="flex">
        <div style="min-height: 100vh" class="w-60 p-4 bg-red-800">
            <a href="{{route('store.create')}}">
                <button class="bg-red-300 rounded p-2">apply to have a store</button>
            </a>
        </div>
        <div style="width: calc(100% - 15rem)" class="bg-gray-100 py-2 px-4">
            <h3>Stores</h3>
            {{-- cards tailwind --}}
            <div class="flex flex-wrap gap-4">
                @foreach ($accepted_stores as $store )
                <div class="w-80 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto lg:mx-0">
                    <a href="#">
                        <div
                        style="background-size: cover; background-position: center; background-image: url({{asset('img/store/'.$store->image.'')}}); height: 250px; width: 100%; background-repeat: no-repeat;"
                        ></div>
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{$store->title}}
                            </h5>
                        </a>
                        {{-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p> --}}
                        <a href="store/{{$store->id}}/details" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Products
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>




</x-store>
