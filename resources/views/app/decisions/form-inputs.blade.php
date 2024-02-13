@php $editing = isset($decision) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="mod_id" label="Mod" required>
            @php $selected = old('mod_id', ($editing ? $decision->mod_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Mod</option>
            @foreach($mods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="case_hearing_id" label="Case Hearing" required>
            @php $selected = old('case_hearing_id', ($editing ? $decision->case_hearing_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Case Hearing</option>
            @foreach($caseHearings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="empID" label="Emp Id">
            @php $selected = old('empID', ($editing ? $decision->empID : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $decision->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="chargeType"
            label="Charge Type"
            :value="old('chargeType', ($editing ? $decision->chargeType : ''))"
            maxlength="255"
            placeholder="Charge Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="caseStartDate"
            label="Case Start Date"
            value="{{ old('caseStartDate', ($editing ? optional($decision->caseStartDate)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="decisionDate"
            label="Decision Date"
            value="{{ old('decisionDate', ($editing ? optional($decision->decisionDate)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="decisionType"
            label="Decision Type"
            :value="old('decisionType', ($editing ? $decision->decisionType : ''))"
            maxlength="255"
            placeholder="Decision Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $decision->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
