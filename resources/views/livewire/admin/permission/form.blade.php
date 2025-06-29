<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">
        {{ $editMode ? 'Edit Permission' : 'Create Permission' }}
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Permission Name</label>
            <input type="text" wire:model.defer="name" class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200" placeholder="e.g. edit_user" />
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ $editMode ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.permissions.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
