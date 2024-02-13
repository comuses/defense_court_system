@php $editing = isset($appointment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="mod_id" label="Mod" required>
            @php $selected = old('mod_id', ($editing ? $appointment->mod_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Mod</option>
            @foreach($mods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="case_hearing_id" label="Case Hearing" required>
            @php $selected = old('case_hearing_id', ($editing ? $appointment->case_hearing_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Case Hearing</option>
            @foreach($caseHearings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="empID" label="Emp Id">
            @php $selected = old('empID', ($editing ? $appointment->empID : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="fullname"
            label="Fullname"
            :value="old('fullname', ($editing ? $appointment->fullname : ''))"
            maxlength="255"
            placeholder="Fullname"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="chargeType"
            label="Charge Type"
            :value="old('chargeType', ($editing ? $appointment->chargeType : ''))"
            maxlength="255"
            placeholder="Charge Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="appointmentDate"
            label="Appointment Date"
            value="{{ old('appointmentDate', ($editing ? optional($appointment->appointmentDate)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $appointment->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
