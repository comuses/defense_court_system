<div>
    <div>
        @can('create', App\Models\CaseCharge::class)
        <button class="button" wire:click="newCaseCharge">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\CaseCharge::class)
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
                            name="caseCharge.modID"
                            label="Mod Id"
                            wire:model="caseCharge.modID"
                            maxlength="255"
                            placeholder="Mod Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseCharge.MIDnumber"
                            label="Mi Dnumber"
                            wire:model="caseCharge.MIDnumber"
                            maxlength="255"
                            placeholder="Mi Dnumber"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseCharge.rank"
                            label="Rank"
                            wire:model="caseCharge.rank"
                            maxlength="255"
                            placeholder="Rank"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseCharge.fullName"
                            label="Full Name"
                            wire:model="caseCharge.fullName"
                            maxlength="255"
                            placeholder="Full Name"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseCharge.address"
                            label="Address"
                            wire:model="caseCharge.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="caseCharge.state"
                            label="State"
                            wire:model="caseCharge.state"
                            maxlength="255"
                            placeholder="State"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="caseCharge.crimeType"
                            label="Crime Type"
                            wire:model="caseCharge.crimeType"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="caseCharge.crimeDate"
                            label="Crime Date"
                            wire:model="caseCharge.crimeDate"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="caseCharge.chargeDate"
                            label="Charge Date"
                            wire:model="caseCharge.chargeDate"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="caseCharge.mod_employee_id"
                            label="Mod Employee"
                            wire:model="caseCharge.mod_employee_id"
                        >
                            <option value="null" disabled>Please select the Mod Employee</option>
                            @foreach($modEmployeesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="caseCharge.registrar_id"
                            label="Registrar"
                            wire:model="caseCharge.registrar_id"
                        >
                            <option value="null" disabled>Please select the Registrar</option>
                            @foreach($registrarsForSelect as $value => $label)
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
                        @lang('crud.mod_case_charges.inputs.modID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.MIDnumber')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.rank')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.fullName')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.state')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.crimeType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.crimeDate')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.chargeDate')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.mod_employee_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.mod_case_charges.inputs.registrar_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($caseCharges as $caseCharge)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $caseCharge->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->modID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->MIDnumber ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->rank ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->fullName ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->state ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->crimeType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->crimeDate ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $caseCharge->chargeDate ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($caseCharge->modEmployee)->modID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($caseCharge->registrar)->MIDNumber ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $caseCharge)
                            <button
                                type="button"
                                class="button"
                                wire:click="editCaseCharge({{ $caseCharge->id }})"
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
                    <td colspan="12">
                        <div class="mt-10 px-4">
                            {{ $caseCharges->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
