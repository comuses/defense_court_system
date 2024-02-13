<div>
    <div>
        @can('create', App\Models\Decision::class)
        <button class="button" wire:click="newDecision">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Decision::class)
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
                            name="decision.caseHearingID"
                            label="Case Hearing Id"
                            wire:model="decision.caseHearingID"
                            maxlength="255"
                            placeholder="Case Hearing Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="decision.modID"
                            label="Mod Id"
                            wire:model="decision.modID"
                            maxlength="255"
                            placeholder="Mod Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="decision.empID"
                            label="Emp Id"
                            wire:model="decision.empID"
                            maxlength="255"
                            placeholder="Emp Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="decision.name"
                            label="Name"
                            wire:model="decision.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="decision.chargeType"
                            label="Charge Type"
                            wire:model="decision.chargeType"
                            maxlength="255"
                            placeholder="Charge Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="decision.caseStartDate"
                            label="Case Start Date"
                            wire:model="decision.caseStartDate"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="decision.decisionDate"
                            label="Decision Date"
                            wire:model="decision.decisionDate"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="decision.decisionType"
                            label="Decision Type"
                            wire:model="decision.decisionType"
                            maxlength="255"
                            placeholder="Decision Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="decision.description"
                            label="Description"
                            wire:model="decision.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="decision.case_hearing_id"
                            label="Case Hearing"
                            wire:model="decision.case_hearing_id"
                        >
                            <option value="null" disabled>Please select the Case Hearing</option>
                            @foreach($caseHearingsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
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
                        @lang('crud.mod_decisions.inputs.caseHearingID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.modID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.empID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.chargeType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.caseStartDate')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.decisionDate')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.decisionType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.description')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_decisions.inputs.case_hearing_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($decisions as $decision)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $decision->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->caseHearingID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->modID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->empID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->chargeType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->caseStartDate ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->decisionDate ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->decisionType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $decision->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($decision->caseHearing)->casehearingID ??
                        '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $decision)
                            <button
                                type="button"
                                class="button"
                                wire:click="editDecision({{ $decision->id }})"
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
                    <td colspan="11">
                        <div class="mt-10 px-4">{{ $decisions->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
