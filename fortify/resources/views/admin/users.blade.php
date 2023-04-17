<x-dash>
    <h1>Users</h1>
    <div class="px-12">
        <table id="dataTable" class="w-full text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href=""
                        class="bg-red-500 text-white px-2 py-1 rounded"
                        >ban</a>
                        <a href=""
                        class="bg-green-500 text-white px-2 py-1 rounded"
                        >unban</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dash>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

        });



    </script>