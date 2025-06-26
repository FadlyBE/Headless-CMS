<x-layouts.admin>

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

        <h1 class="text-2xl font-bold mb-4">Posts</h1>

        <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           + Create Post
        </a>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full border border-gray-300 mt-6">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Title</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td class="py-2 px-4 border-b">
                            @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Gambar" class="w-16 h-16 object-cover rounded">
                            @else
                            <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $post->title }}</td>
                        <td class="py-2 px-4 border-b">{{ ucfirst($post->status) }}</td>
                        <td class="py-2 px-4 border-b space-x-2">
                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                class="text-blue-600 hover:underline">Edit</a>

                            <button wire:click.prevent="delete({{ $post->id }})"
                                onclick="return confirm('Yakin ingin menghapus post ini?')"
                                class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>

</x-layouts.admin>