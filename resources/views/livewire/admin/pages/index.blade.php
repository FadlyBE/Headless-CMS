<x-layouts.admin>
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Page
        </a>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Slug</th>
                <th class="p-2 border w-24">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pages as $page)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $page->title }}</td>
                    <td class="p-2 border">
                        <span class="px-2 py-1 rounded text-sm {{ $page->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($page->status) }}
                        </span>
                    </td>
                    <td class="p-2 border">{{ $page->slug }}</td>
                    <td class="p-2 border flex gap-2">
                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <button wire:click="delete({{ $page->id }})" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">No pages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $pages->links() }}
    </div>
</div>
</x-layouts.admin>