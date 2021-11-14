<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{ $row->email }}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{ $row->created_at }}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    {{ $row->lic_download_histories_count }}
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <button wire:click="$emit('openModal', 'edit-user', {{ json_encode(['parentName' => $this->getName(), 'user' => [$row->id]]) }})" type="button"
        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm sm:px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
        Править
    </button>
    <button
        wire:click="$emit('openModal', 'dlg-delete-confirm', {{ json_encode(['parentName' => $this->getName(), 'data' => [$row->id], 'bulk' => false]) }})"
        type="button"
        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm sm:px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
        Удалить
    </button>
</x-livewire-tables::table.cell>
