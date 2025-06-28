<div>
    @if (session()->has('message'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('message') }}
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Pages</h2>
            <button wire:click="create"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                + Add Page
            </button>
        </div>

        <table class="min-w-full border border-gray-300 mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border">Title</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Slug</th>
                    <th class="py-2 px-4 border w-40">Actions</th>
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
                    <td class="p-2 border space-x-2">
                        <button wire:click="edit({{ $page->id }})" class="inline-flex items-center text-blue-600 hover:underline mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2M4 17l4.586-4.586a2 2 0 012.828 0L16 17M14 13l6-6m0 0a2.121 2.121 0 00-3-3L11 10" />
                            </svg>
                            Edit
                        </button>

                        <button wire:click.prevent="delete({{ $page->id }})"
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

    {{-- Modal --}}
    <div x-data="{ showModal: @entangle('isOpen') }"
        x-show="showModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded w-full max-w-xl shadow-xl"
            @click.away="showModal = false">
            <h2 class="text-xl font-semibold mb-4">
                {{ $pageId ? 'Edit Page' : 'Create Page' }}
            </h2>
            <form wire:submit.prevent="store">
                <input type="text" wire:model.defer="title" placeholder="Title"
                    class="w-full p-2 border rounded mb-2">
                <input type="text" wire:model.defer="slug" placeholder="Slug"
                    class="w-full p-2 border rounded mb-2">
                <textarea wire:model.defer="body" placeholder="Body"
                    class="w-full p-2 border rounded mb-2" rows="5"></textarea>

                <select wire:model.defer="status" class="w-full p-2 border rounded mb-2">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>