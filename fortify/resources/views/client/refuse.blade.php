<x-store>
    <div class="min-h-screen p-10 pt-32 h-100">
        <div class="font-regular relative block w-full rounded-lg bg-pink-500 p-4 text-base leading-5 text-white opacity-100" data-dismissible="alert"><div class="mr-12">Alert dismissible</div><div class="absolute top-2.5 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20" data-dismissible-target="alert"><button role="button" class="w-max rounded-lg p-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg></button></div></div><div class="w-full md:w-7/12 pt-5 px-4 mb-8 mx-auto text-center">
            <div class="text-sm text-gray-700 py-1">
                <h1 class="text-2xl font-bold">{{$title}}</h1>
                <p class="text-gray-500">{{$discription}}</p>
            </div>
            <!-- copy right -->
            <div class="text-sm text-gray-700 py-1">
                <p class="text-gray-500">© 2021 All rights reserved.</p>
            </div>
        </div>
    </div>
</x-store>
