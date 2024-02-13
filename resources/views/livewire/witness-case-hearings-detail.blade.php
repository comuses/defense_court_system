<div>
    <div>
        @can('create', App\Models\CaseHearing::class)
        <button class="button" wire:click="newCaseHearing">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\CaseHearing::class)
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
                            name="caseHearing.casehearingID"
                            label="Casehearing Id"
                            wire:model="caseHearing.casehearingID"
                            maxlength="255"
                            placeholder="Casehearing Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.modID"
                            label="Mod Id"
                            wire:model="caseHearing.modID"
                            maxlength="255"
                            placeholder="Mod Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.courtID"
                            label="Court Id"
                            wire:model="caseHearing.courtID"
                            maxlength="255"
                            placeholder="Court Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.judgeID"
                            label="Judge Id"
                            wire:model="caseHearing.judgeID"
                            maxlength="255"
                            placeholder="Judge Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.attorneyID"
                            label="Attorney Id"
                            wire:model="caseHearing.attorneyID"
                            maxlength="255"
                            placeholder="Attorney Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.attoneryWitnessID"
                            label="Attonery Witness Id"
                            wire:model="caseHearing.attoneryWitnessID"
                            maxlength="255"
                            placeholder="Attonery Witness Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.accusedWitnessID"
                            label="Accused Witness Id"
                            wire:model="caseHearing.accusedWitnessID"
                            maxlength="255"
                            placeholder="Accused Witness Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.chilotname"
                            label="Chilotname"
                            wire:model="caseHearing.chilotname"
                            maxlength="255"
                            placeholder="Chilotname"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.accEmpID"
                            label="Acc Emp Id"
                            wire:model="caseHearing.accEmpID"
                            maxlength="255"
                            placeholder="Acc Emp Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.fileNumber"
                            label="File Number"
                            wire:model="caseHearing.fileNumber"
                            maxlength="255"
                            placeholder="File Number"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="caseHearing.caseStartDate"
                            label="Case Start Date"
                            wire:model="caseHearing.caseStartDate"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.address"
                            label="Address"
                            wire:model="caseHearing.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.state"
                            label="State"
                            wire:model="caseHearing.state"
                            maxlength="255"
                            placeholder="State"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseHearing.location"
                            label="Location"
                            wire:model="caseHearing.location"
                            maxlength="255"
                            placeholder="Location"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="caseHearing.description"
                            label="Description"
                            wire:model="caseHearing.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="caseHearing.attorney_id"
                            label="Attorney"
                            wire:model="caseHearing.attorney_id"
                        >
                            <option value="null" disabled>Please select the Attorney</option>
                            @foreach($attorneysForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="caseHearing.court_id"
                            label="Court"
                            wire:model="caseHearing.court_id"
                        >
                            <option value="null" disabled>Please select the Court</option>
                            @foreach($courtsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="caseHearing.mod_id"
                            label="Mod"
                            wire:model="caseHearing.mod_id"
                        >
                            <option value="null" disabled>Please select the Mod</option>
                            @foreach($modsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="caseHearing.judge_id"
                            label="Judge"
                            wire:model="caseHearing.judge_id"
                        >
                            <option value="null" disabled>Please select the Judge</option>
                            @foreach($judgesForSelect as $value => $label)
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
                        @lang('crud.witness_case_hearings.inputs.casehearingID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.modID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.courtID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.judgeID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.attorneyID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.attoneryWitnessID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.accusedWitnessID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.chilotname')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.accEmpID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.fileNumber')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.caseStartDate')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.state')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.location')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.description')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.attorney_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.court_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.mod_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.witness_case_hearings.inputs.judge_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($caseHearings as $caseHearing)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $caseHearing->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->casehearingID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->modID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->courtID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->judgeID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->attorneyID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->attoneryWitnessID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->accusedWitnessID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->chilotname ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->accEmpID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->fileNumber ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->caseStartDate ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->state ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->location ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseHearing->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($caseHearing->attorney)->courtID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($caseHearing->court)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($caseHearing->mod)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($caseHearing->judge)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $caseHearing)
                            <button
                                type="button"
                                class="button"
                                wire:click="editCaseHearing({{ $caseHearing->id }})"
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
                    <td colspan="20">
                        <div class="mt-10 px-4">
                            {{ $caseHearings->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
