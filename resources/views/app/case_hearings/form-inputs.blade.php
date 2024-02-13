@php $editing = isset($caseHearing) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="court_id" label="Court" required>
            @php $selected = old('court_id', ($editing ? $caseHearing->court_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Court</option>
            @foreach($courts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="mod_id" label="Mod" required>
            @php $selected = old('mod_id', ($editing ? $caseHearing->mod_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Mod</option>
            @foreach($mods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="attorney_id" label="Attorney" required>
            @php $selected = old('attorney_id', ($editing ? $caseHearing->attorney_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Attorney</option>
            @foreach($attorneys as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="judge_id" label="Judge" required>
            @php $selected = old('judge_id', ($editing ? $caseHearing->judge_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Judge</option>
            @foreach($judges as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="witness_id" label="Witness" required>
            @php $selected = old('witness_id', ($editing ? $caseHearing->witness_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Witness</option>
            @foreach($witnesses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="casehearingID" label="Casehearing Id">
            @php $selected = old('casehearingID', ($editing ? $caseHearing->casehearingID : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="chilotname"
            label="Chilotname"
            :value="old('chilotname', ($editing ? $caseHearing->chilotname : ''))"
            maxlength="255"
            placeholder="Chilotname"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="fileNumber"
            label="File Number"
            :value="old('fileNumber', ($editing ? $caseHearing->fileNumber : ''))"
            maxlength="255"
            placeholder="File Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="caseStartDate"
            label="Case Start Date"
            value="{{ old('caseStartDate', ($editing ? optional($caseHearing->caseStartDate)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $caseHearing->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="state"
            label="State"
            :value="old('state', ($editing ? $caseHearing->state : ''))"
            maxlength="255"
            placeholder="State"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="location"
            label="Location"
            :value="old('location', ($editing ? $caseHearing->location : ''))"
            maxlength="255"
            placeholder="Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $caseHearing->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="attoneryWitnessID" label="Attonery Witness Id">
            @php $selected = old('attoneryWitnessID', ($editing ? $caseHearing->attoneryWitnessID : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="accEmpID" label="Acc Emp Id">
            @php $selected = old('accEmpID', ($editing ? $caseHearing->accEmpID : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>
</div>
