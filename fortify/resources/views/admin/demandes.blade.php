<x-dash>
    <h1 class="p-relative">demandes</h1>


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
                                        Image
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Title
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Phone
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-500">
                            @foreach ($pending_stores as $store )
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{$store->id}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-500">
                                        <img src="https://picsum.photos/200" alt="" class="w-10 h-10 rounded-full">
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                        {{$store->title}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{$store->phone}}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="/demandes/{{$store->id}}/action/1"
                                            class="px-4 py-1 text-sm text-green-600 bg-green-200 rounded-full">Accept</a>
                                            <a href="/demandes/{{$store->id}}/action/2"
                                            class="px-4 py-1 text-sm text-red-500 bg-red-200 rounded-full">Refuse</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
