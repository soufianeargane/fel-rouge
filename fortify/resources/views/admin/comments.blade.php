<x-dash>
    <h1>commets</h1>
    <div class="w-full mx-auto">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="p-12 border-b border-gray-200 shadow">
                        <table class="divide-y divide-gray-300 w-full" id="dataTable">
                            <thead class="bg-gray-100">
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
                            <tbody class="bg-white divide-y divide-gray-500">
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
                                        action="" method="post"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="" name="category_id">
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
