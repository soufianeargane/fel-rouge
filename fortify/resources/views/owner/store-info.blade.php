<x-owner>
    <!-- title -->
    <h1 class="text-xl">Your Store</h1>
    <div class="p-2 md:px-8">
        <form action="{{route('owner.store-info.update')}}" method="post">
            @csrf
            <div class="flex flex-col gap-10">
                <div class="flex flex-col lg:flex-row justify-between gap-3">
                    <div class="w-full px-3">
                        <label
                        class="block text-lg text-gray-700 text-sm font-bold mb-2"
                        for="title">Store Name</label>
                        <input type="text" name="title" id="title" value="{{ $store->title }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="w-full px-3">
                        <label
                        class="block text-lg text-gray-700 text-sm font-bold mb-2"
                        for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ $store->phone }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row justify-between gap-3">
                    <div class="w-full px-3">
                        <label
                        class="block text-lg text-gray-700 text-sm font-bold mb-2"
                        for="neighborhood">Store Neighborhood</label>
                        <input type="text" name="neighborhood" id="neighborhood" value="{{ $store->neighborhood }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="w-full px-3">
                        <label
                        class="block text-lg text-gray-700 text-sm font-bold mb-2"
                        for="city_id">City</label>
                        <Select class="w-full" name="city_id" id="city_id">
                            <option selected value="{{ $store->city->id }}">{{ $store->city->name }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </Select>

                    </div>

                </div>
                <div class="flex w-full items-center justify-between">
                    <div>
                        <input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;">
                        <label for="file" style="cursor: pointer;"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm md:text-md py-1 px-2 md:py-2 md:px-4 rounded w-full"
                        >Upload Image</label>
                    </div>
                    <div>
                        <img id="output" width="200px" height="200px"
                        src="{{ asset('img/store/' . $store->image) }}"
                        />
                    </div>
                </div>
                <div class="mx-auto md:mx-0 flex gap-3">
                    <div>
                        <button
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        type="submit">Save</button>
                    </div>
                    <div>
                        <a>
                            <button
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Delete</button>
                        </a>
                    </div>

                </div>
            </div>
        </form>
    </div>

</x-owner>
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
