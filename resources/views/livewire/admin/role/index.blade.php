
<div class="p-4">

    @if ($showForm)
        @livewire('admin.role.form', ['roleId' => $roleId, 'editMode' => $editMode])
    @endif
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold">{{ __('sidebar.role')}}</h1>
            <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            {{ __('button.create')}}
            </button>
        </div>
        
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">{{ __('thead.name')}}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ __('thead.action')}}</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($roles as $role)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $role->name }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <button wire:click="edit({{ $role->id }})"
                                    class="inline-flex items-center text-blue-600 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5h2M4 17l4.586-4.586a2 2 0 012.828 0L16 17M14 13l6-6m0 0a2.121 2.121 0 00-3-3L11 10" />
                                    </svg>
                                    {{ __('button.edit')}}
                                </button>

                                <button wire:click.prevent="delete({{ $role->id }})"
                                    onclick="return confirm('Are you sure you want to delete?')"
                                    class="inline-flex items-center text-red-600 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    {{ __('button.delete')}}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-4 py-3 text-gray-500 text-center">Belum ada data role.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>

</div>
