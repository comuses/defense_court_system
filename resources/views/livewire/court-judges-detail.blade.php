<div>
    <div>
        @can('create', App\Models\Judge::class)
        <button class="button" wire:click="newJudge">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Judge::class)
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
                            name="judge.CourtID"
                            label="Court Id"
                            wire:model="judge.CourtID"
                            maxlength="255"
                            placeholder="Court Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="judge.judgeID"
                            label="Judge Id"
                            wire:model="judge.judgeID"
                            maxlength="255"
                            placeholder="Judge Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="judge.name"
                            label="Name"
                            wire:model="judge.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="judge.courtType"
                            label="Court Type"
                            wire:model="judge.courtType"
                            maxlength="255"
                            placeholder="Court Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="judge.address"
                            label="Address"
                            wire:model="judge.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="judge.state"
                            label="State"
                            wire:model="judge.state"
                            maxlength="255"
                            placeholder="State"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="judge.empType"
                            label="Emp Type"
                            wire:model="judge.empType"
                            maxlength="255"
                            placeholder="Emp Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="judge.description"
                            label="Description"
                            wire:model="judge.description"
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
                        @lang('crud.court_judges.inputs.CourtID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.judgeID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.courtType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.state')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.empType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.court_judges.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($judges as $judge)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $judge->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->CourtID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->judgeID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->courtType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->state ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->empType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $judge->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $judge)
                            <button
                                type="button"
                                class="button"
                                wire:click="editJudge({{ $judge->id }})"
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
                        <div class="mt-10 px-4">{{ $judges->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
