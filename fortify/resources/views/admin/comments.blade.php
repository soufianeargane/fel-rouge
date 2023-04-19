<x-dash>
    <h1>commets</h1>
    <div class="mt-y-5">
        <!-- if session has message -->
        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
        @endif
    </div>
    <div class="w-full mx-auto">
            <div class="flex flex-col">
                <div  class="w-full">
                    <div class="w-72 sm:w-96 md:w-full mx-auto">
                        <div  class="border-b relative overflow-x-auto border-gray-200 shadow">
                            <table  class="w-full text-sm" id="dataTable">
                                <thead class="bg-gray-300">
                                    <tr>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            ID
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            Rating
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            Comment
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            Store Name
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            User Name
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            Created_at
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500">
                                            action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-100 divide-y divide-gray-500">
                                    @foreach ($commentsData as $comment)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-center text-gray-500">
                                            {{$comment['id']}}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="text-sm text-gray-900">
                                                {{$comment['rating']}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center text-gray-500">
                                                {{ $comment['comment'] }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center text-gray-500">
                                            {{ $comment['store_name'] }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center text-gray-500">
                                            {{ $comment['user_name'] }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center text-gray-500">
                                            {{ $comment['created_at'] }}
                                        </td>
                                        <td class="px-6 py-4 flex justify-center gap-1 text-center">
                                            <form
                                            action="{{route('admin.comments.delete')}}" method="post"
                                            >
                                                <!-- input hidden -->
                                                <input type="hidden" value="{{$comment['id']}}" name="comment_id">
                                                @csrf
                                                <button type="submit" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
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
        $(document).ready(function () {
            $('#dataTable').DataTable();

        });



    </script>
</x-dash>
