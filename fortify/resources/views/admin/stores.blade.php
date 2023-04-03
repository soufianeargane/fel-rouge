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
                        {{$store->neighborhood}},
                        {{$store->city->name}}
                    </p>
                    <div class="flex gap-1">
                        <a href="/admin/store-details/{{$store->id}}">
                            <button
                                type="button"
                                class="px-4 py-2 font-semibold text-white transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-blue-500 hover:bg-blue-500 dark:hover:bg-blue-400 focus:outline-none focus:bg-blue-500 dark:focus:bg-blue-400"
                                                        >
                                see Details
                            </button>
                        </a>
                        
                            @if ($store->status == 1)
                                <button
                                data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    id="{{$store->id}}"
                                    type="submit"
                                    class="js-delete-btn px-4 py-2 font-semibold text-white transition-colors duration-200 transform bg-red-600 rounded-md dark:bg-red-500 hover:bg-red-500 dark:hover:bg-red-400 focus:outline-none focus:bg-red-500 dark:focus:bg-red-400"
                                                            >
                                    Delete
                                </button> 
                            @elseif ($store->status == 2)
                                <button
                                    type="button"
                                    class="js-delete-btn px-4 py-2 font-semibold text-black transition-colors duration-200 transform bg-gray-300 rounded-md "
                                                            >
                                    deleted
                                </button>
                            @endif
                        
                    </div>
                    </div>
                </div>
                @endforeach

                

  
  <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
      <div class="relative w-full h-full max-w-md md:h-auto">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="p-6 text-center">
                  <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this Store?</h3>
                  <div class="flex justify-center gap-2">

                    <form action="{{route('admin.stores.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="store_id" id="store_id" value="">

                        <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                    </form>
                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>

                  </div>
              </div>
          </div>
      </div>
  </div>
  



        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        // get id of the button when clicked js-delete-btn
        $('.js-delete-btn').on('click', function() {
            var id = $(this).attr('id');
            console.log(id);
            $('#store_id').val(id);
        })



    </script>



</x-dash>
