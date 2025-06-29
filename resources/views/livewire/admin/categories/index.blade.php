<div>
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">Category</h1>

            @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form wire:submit.prevent="save" class="mb-6">
                <div class="flex items-center gap-2">
                    <input type="text" wire:model.defer="name" placeholder="Category name"
                        class="border rounded p-2 w-full">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        {{ $isEditing ? 'Update' : 'Add' }}
                    </button>
                </div>
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </form>

            <table class="min-w-full border border-gray-300 mt-6">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2 text-left">Name</th>
                        <th class="border px-4 py-2 text-left">Slug</th>
                        <th class="border px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">{{ $category->slug }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <button wire:click="edit({{ $category->id }})" class="inline-flex items-center text-blue-600 hover:underline mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5h2M4 17l4.586-4.586a2 2 0 012.828 0L16 17M14 13l6-6m0 0a2.121 2.121 0 00-3-3L11 10" />
                                </svg>
                                Edit
                            </button>

                            <button wire:click.prevent="delete({{ $category->id }})"
                                onclick="return confirm('Are you sure you want to delete?')"
                                class="inline-flex items-center text-red-600 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>