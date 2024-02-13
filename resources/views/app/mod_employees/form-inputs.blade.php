@php $editing = isset($modEmployee) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="mod_id" label="Mod" required>
            @php $selected = old('mod_id', ($editing ? $modEmployee->mod_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Mod</option>
            @foreach($mods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="EmpID"
            label="Emp Id"
            :value="old('EmpID', ($editing ? $modEmployee->EmpID : ''))"
            maxlength="255"
            placeholder="Emp Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="rank"
            label="Rank"
            :value="old('rank', ($editing ? $modEmployee->rank : ''))"
            maxlength="255"
            placeholder="Rank"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="fullName"
            label="Full Name"
            :value="old('fullName', ($editing ? $modEmployee->fullName : ''))"
            maxlength="255"
            placeholder="Full Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $modEmployee->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="state"
            label="State"
            :value="old('state', ($editing ? $modEmployee->state : ''))"
            maxlength="255"
            placeholder="State"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="empType"
            label="Emp Type"
            :value="old('empType', ($editing ? $modEmployee->empType : ''))"
            maxlength="255"
            placeholder="Emp Type"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
