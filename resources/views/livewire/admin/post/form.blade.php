{{-- resources/views/livewire/admin/post/form.blade.php --}}
<div>
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label>Title</label>
            <input type="text" wire:model="post.title" class="border rounded w-full">
            @error('post.title') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Slug</label>
            <input type="text" wire:model="post.slug" class="border rounded w-full">
            @error('post.slug') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Status</label>
            <select wire:model="post.status" class="border rounded w-full">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('post.status') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Categories</label>
            @foreach($categories as $category)
                <label class="block">
                    <input type="checkbox" value="{{ $category->id }}" wire:model="selectedCategories">
                    {{ $category->name }}
                </label>
            @endforeach
        </div>

        <div>
            <label>Image</label>
            <input type="file" wire:model="image">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="w-32 h-32 object-cover">
            @endif
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
    </form>
</div>
