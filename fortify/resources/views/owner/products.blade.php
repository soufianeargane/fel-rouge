<x-owner>
    <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add Product
    </button>

    <!-- display errors if any -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- display success message if any -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <!-- table -->
    <div class="w-full mx-auto mt-3">
        <div class="flex flex-col">
                <div class="w-full">
                    <div class=" border-b border-gray-200 shadow">
                        <table class="divide-y divide-gray-300 w-full" id="dataTable">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Image
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Name
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Price
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Quantity
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Category
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-500">
                                @foreach ($products as $product )
                                <tr class="whitespace-nowrap">
                                    <td width="5%" class="py-4 text-sm text-center text-gray-500">
                                        <img 
                                        src="{{asset('img/products/'.$product->image)}}"
                                        alt="" class="w-10 h-10 rounded-full mx-auto">
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-500">
                                        {{$product->name}}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{$product->price}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-500">
                                            {{$product->quantity}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-500">
                                        {{$product->category->name}}
                                    </td>
                                    <td class="px-6 py-4 flex justify-center gap-1 text-center">
                                        <form 
                                        action="{{route('owner.products.delete', $product->id)}}"
                                        method="POST"

                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                            class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">delete</button>
                                        </form>
                                            <button
                                            id="{{$product->id}}"
                                            data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                            class=" js-data px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add New Product
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{route('owner.products.store')}}" method="post" 
                    enctype="multipart/form-data"
                 >
                    @csrf
                    <div class="p-4">
                        <div class="flex flex-col space-y-4">
                            <div class="flex flex-col space-y-1">
                                <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="block w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label for="price" class="text-sm font-medium text-gray-700 dark:text-gray-200">price</label>
                                <input type="text" name="price" id="price" placeholder="price" class="block w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label for="quantity" class="text-sm font-medium text-gray-700 dark:text-gray-200">quantity</label>
                                <input type="text" name="quantity" id="quantity" placeholder="quantity" class="block w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div class="flex flex-col space-y-1">        
                                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center">
                                    <div class="w-1/2 px-1">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                                        <input name="image" id="img_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                    </div>
                                    <div class="w-1/2 px-1">
                                        <div class="border-dashed border-2 border-indigo-600 w-28 h-28">
                                            <img id="display-img" src="" class="w-full h-full" style="display:none;" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                        <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div id="edit-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <div></div>
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Product
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="relative">
                    <div 
                    id="modal-overlay"
                    class="absolute inset-0 z-10 flex items-center justify-center w-full h-full bg-white bg-opacity-80"
                    >
                        <!-- spinning circle -->
                        <div role="status">
                            <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <form action="/owner/products/update/" method="post" 
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <input type="hidden" id="product-id" name="product_id" value="">
                        <div class="p-4">
                            <div class="flex flex-col space-y-4">
                                <div class="flex flex-col space-y-1">
                                    <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                                    <input type="text" name="name" id="name_edit" placeholder="Name" class="block w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                                <div class="flex flex-col space-y-1">
                                    <label for="price" class="text-sm font-medium text-gray-700 dark:text-gray-200">price</label>
                                    <input type="text" name="price" id="price_edit" placeholder="price" class="block w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                                <div class="flex flex-col space-y-1">
                                    <label for="quantity" class="text-sm font-medium text-gray-700 dark:text-gray-200">quantity</label>
                                    <input type="text" name="quantity" id="quantity_edit" placeholder="quantity" class="block w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                                <div class="flex flex-col space-y-1">        
                                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <select id="category_id_edit" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled>select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col space-y-1">
                                    <div class="flex items-center">
                                        <div class="w-1/2 px-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                                            <input name="image" id="img_input_edit" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                        </div>
                                        <div class="w-1/2 px-1">
                                            <div class="border-dashed border-2 border-indigo-600 w-28 h-28">
                                                <img id="display-img_edit" src="" class="w-full h-full" style="display:none;" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="edit-modal" type="submit" class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                            <button data-modal-hide="edit-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-owner>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

        });

        // console.log id of element clicked with class js-data
        $('.js-data').click(function() {
            console.log($(this).attr('id'));
            // set element with id modal-overlay to display block
            $('#modal-overlay').css('display', 'block');
            // make ajax request to get data of the product with the id of the element clicked
            $.ajax({
                url: '/owner/products/' + $(this).attr('id'),
                type: 'GET',
                success: function(data) {
                    console.log(data.product);
                    $('#modal-overlay').css('display', 'none');
                    $('#name_edit').val(data.product.name);
                    $('#price_edit').val(data.product.price);
                    $('#quantity_edit').val(data.product.quantity);
                    $('#category_id_edit').val(data.product.category_id);
                    $('#display-img_edit').attr('src', 'http://127.0.0.1:8000/img/products/' + data.product.image).css('display', 'block');
                    $('#product-id').val(data.product.id);
                    // $('#edit-form').attr('action', '/owner/products/update/' + data.product.id);
                }
            });
        });



    </script>
    <script>
        $(document).ready(function() {
            $('#img_input').change(function() {
                // dsiplay image in the element with id display-img ans set it to block
                $('#display-img').attr('src', URL.createObjectURL(event.target.files[0])).css('display', 'block');

            });
        });
        $(document).ready(function() {
            $('#img_input_edit').change(function() {
                // dsiplay image in the element with id display-img ans set it to block
                $('#display-img_edit').attr('src', URL.createObjectURL(event.target.files[0])).css('display', 'block');

            });
        });
    </script>