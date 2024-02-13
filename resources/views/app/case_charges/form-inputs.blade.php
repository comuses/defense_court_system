@php $editing = isset($caseCharge) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="mod_employee_id" label="Mod Employee" required>
            @php $selected = old('mod_employee_id', ($editing ? $caseCharge->mod_employee_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Mod Employee</option>
            @foreach($modEmployees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="mod_id" label="Mod" required>
            @php $selected = old('mod_id', ($editing ? $caseCharge->mod_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Mod</option>
            @foreach($mods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="rank" label="Rank">
            @php $selected = old('rank', ($editing ? $caseCharge->rank : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="fullName" label="Full Name">
            @php $selected = old('fullName', ($editing ? $caseCharge->fullName : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="address" label="Address">
            @php $selected = old('address', ($editing ? $caseCharge->address : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="state" label="State">
            @php $selected = old('state', ($editing ? $caseCharge->state : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="crimeType"
            label="Crime Type"
            maxlength="255"
            required
            >{{ old('crimeType', ($editing ? $caseCharge->crimeType : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="crimeDate"
            label="Crime Date"
            value="{{ old('crimeDate', ($editing ? optional($caseCharge->crimeDate)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="chargeDate"
            label="Charge Date"
            value="{{ old('chargeDate', ($editing ? optional($caseCharge->chargeDate)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="registrar_id" label="Registrar" required>
            @php $selected = old('registrar_id', ($editing ? $caseCharge->registrar_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Registrar</option>
            @foreach($registrars as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
