<div>
    <div>
        @can('create', App\Models\Attorney::class)
        <button class="button" wire:click="newAttorney">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Attorney::class)
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
                            name="attorney.courtID"
                            label="Court Id"
                            wire:model="attorney.courtID"
                            maxlength="255"
                            placeholder="Court Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="attorney.attoneyID"
                            label="Attoney Id"
                            wire:model="attorney.attoneyID"
                            maxlength="255"
                            placeholder="Attoney Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="attorney.fullname"
                            label="Fullname"
                            wire:model="attorney.fullname"
                            maxlength="255"
                            placeholder="Fullname"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="attorney.courtType"
                            label="Court Type"
                            wire:model="attorney.courtType"
                            maxlength="255"
                            placeholder="Court Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="attorney.address"
                            label="Address"
                            wire:model="attorney.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="attorney.state"
                            label="State"
                            wire:model="attorney.state"
                            maxlength="255"
                            placeholder="State"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="attorney.empType"
                            label="Emp Type"
                            wire:model="attorney.empType"
                            maxlength="255"
                            placeholder="Emp Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="attorney.description"
                            label="Description"
                            wire:model="attorney.description"
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
                        @lang('crud.court_attorneys.inputs.courtID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.attoneyID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.fullname')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.courtType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.state')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.empType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_attorneys.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($attorneys as $attorney)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $attorney->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->courtID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->attoneyID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->fullname ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->courtType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->state ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->empType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $attorney->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $attorney)
                            <button
                                type="button"
                                class="button"
                                wire:click="editAttorney({{ $attorney->id }})"
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
                    <td colspan="9">
                        <div class="mt-10 px-4">{{ $attorneys->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
