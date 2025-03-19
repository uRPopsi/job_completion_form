<div class="m-6">
    <form wire:submit.prevent="generatePDF">
        @csrf

        <div>
            <x-label for="client" value="Client" />
            <x-input id="client" class="block mt-1 w-full p-3 rounded-md" type="text" wire:model="client" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="project" value="Project" />
            <x-input id="project" class="block mt-1 w-full p-3 rounded-md" type="text" wire:model="project" required />
        </div>

        <div class="mt-4">
            <x-label for="po" value="PO" />
            <x-input id="po" class="block mt-1 w-full p-3 rounded-md" type="text" wire:model="po" required />
        </div>

        <div class="mt-4">
            <x-label for="status" value="Status" />
            <x-input id="status" class="block mt-1 w-full p-3 rounded-md" type="text" wire:model="status" required />
        </div>

        <div class="mt-4">
            <x-label for="completion_date" value="Completion Date" />
            <x-input id="completion_date" class="block mt-1 w-full p-3 rounded-md" type="date" wire:model="completion_date" required />
        </div>

        <div class="mt-4">
            <x-label for="invoice" value="Invoice" />
            <x-input id="invoice" class="block mt-1 w-full p-3 rounded-md" type="text" wire:model="invoice" required />
        </div>

        <h3 class="mt-6 text-lg font-semibold">Job Completion Items</h3>
        <div class="flex justify-center w-full overflow-x-auto mt-2">
            <table class="w-[90%] lg:w-[70%] bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">S/N</th>
                        <th class="border px-4 py-2">Item/Service Code</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Required Qty</th>
                        <th class="border px-4 py-2">Supplied Qty</th>
                        <th class="border px-4 py-2">Remark</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2"><input type="text" class="w-full border-gray-300" wire:model="items.{{ $index }}.code"></td>
                        <td class="border px-4 py-2"><input type="text" class="w-full border-gray-300" wire:model="items.{{ $index }}.description"></td>
                        <td class="border px-4 py-2"><input type="number" class="w-full border-gray-300" wire:model="items.{{ $index }}.required_quantity"></td>
                        <td class="border px-4 py-2"><input type="number" class="w-full border-gray-300" wire:model="items.{{ $index }}.supplied_quantity"></td>
                        <td class="border px-4 py-2"><input type="text" class="w-full border-gray-300" wire:model="items.{{ $index }}.remark"></td>
                        <td class="border px-4 py-2">
                            <button type="button" class="text-red-500" wire:click="removeItem({{ $index }})">Remove</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="button" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white px-3 py-2" wire:click="addItem">+ Add Row</button>

        <div class="flex flex-col items-center w-full mt-4">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Generate PDF</button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('pdfGenerated', function (url) {
                let newTab = window.open(url, '_blank'); 
                if (!newTab) {
                    alert('Pop-up blocked! Please allow pop-ups for this site.');
                }
            });
        });
    </script>    
    
</div>

