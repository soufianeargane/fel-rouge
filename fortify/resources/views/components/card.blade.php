@props(['meal'])

<div class="w-72 bg-white mx-2 my-2 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto md:mr-0 md:ml-0 ">
    <div style="background-size:cover; background-position: center; background-repeat:no-repeat; background-image:url('images/{{$meal->image}}'); width:100%; height:250px;">
        <!-- <img style="background-size:cover; background-position: center; background-repeat:no-repeat; background-image:url('images/{{$meal->image}}')" class="rounded-t-lg" src="images/{{$meal->image}}" alt="" /> -->
    </div>
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$meal->title}}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$meal->description}}.</p>
        <!-- <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Read more
            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </a> -->
    </div>
</div>