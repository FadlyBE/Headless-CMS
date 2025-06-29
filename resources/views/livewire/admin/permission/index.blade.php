<div class="p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Permission Management</h1>
        <a href="{{ route('admin.permissions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Permission
        </a>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">#</th>
                <th class="border px-4 py-2 text-left">Name</th>
                <th class="border px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $permission->name }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
