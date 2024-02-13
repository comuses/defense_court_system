<div>
    <div>
        @can('create', App\Models\Appointment::class)
        <button class="button" wire:click="newAppointment">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Appointment::class)
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
                            name="appointment.caseHearID"
                            label="Case Hear Id"
                            wire:model="appointment.caseHearID"
                            maxlength="255"
                            placeholder="Case Hear Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="appointment.empID"
                            label="Emp Id"
                            wire:model="appointment.empID"
                            maxlength="255"
                            placeholder="Emp Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="appointment.modID"
                            label="Mod Id"
                            wire:model="appointment.modID"
                            maxlength="255"
                            placeholder="Mod Id"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="appointment.fullname"
                            label="Fullname"
                            wire:model="appointment.fullname"
                            maxlength="255"
                            placeholder="Fullname"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="appointment.chargeType"
                            label="Charge Type"
                            wire:model="appointment.chargeType"
                            maxlength="255"
                            placeholder="Charge Type"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.datetime
                            name="appointment.appointmentDate"
                            label="Appointment Date"
                            wire:model="appointment.appointmentDate"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="appointment.description"
                            label="Description"
                            wire:model="appointment.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="appointment.mod_id"
                            label="Mod"
                            wire:model="appointment.mod_id"
                        >
                            <option value="null" disabled>Please select the Mod</option>
                            @foreach($modsForSelect as $value => $label)
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
                        @lang('crud.case_hearing_appointments.inputs.caseHearID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.empID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.modID')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.fullname')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.chargeType')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.appointmentDate')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.description')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.case_hearing_appointments.inputs.mod_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($appointments as $appointment)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $appointment->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->caseHearID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->empID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->modID ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->fullname ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->chargeType ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->appointmentDate ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $appointment->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($appointment->mod)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $appointment)
                            <button
                                type="button"
                                class="button"
                                wire:click="editAppointment({{ $appointment->id }})"
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
                        <div class="mt-10 px-4">
                            {{ $appointments->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
