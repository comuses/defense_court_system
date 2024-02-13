<div>
    <div>
        @can('create', App\Models\Bar::class)
        <button class="button" wire:click="newBar">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Bar::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="bar.courtID"
                            label="Court Id"
                            wire:model="bar.courtID"
                            maxlength="255"
                            placeholder="Court Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="bar.address"
                            label="Address"
                            wire:model="bar.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="bar.state"
                            label="State"
                            wire:model="bar.state"
                            maxlength="255"
                            placeholder="State"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="bar.location"
                            label="Location"
                            wire:model="bar.location"
                            maxlength="255"
                            placeholder="Location"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="bar.description"
                            label="Description"
                            wire:model="bar.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_bars.inputs.courtID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_bars.inputs.address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_bars.inputs.state')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_bars.inputs.location')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_bars.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($bars as $bar)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $bar->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $bar->courtID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $bar->address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $bar->state ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $bar->location ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $bar->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $bar)
                            <button
                                type="button"
                                class="button"
                                wire:click="editBar({{ $bar->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="mt-10 px-4">{{ $bars->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
