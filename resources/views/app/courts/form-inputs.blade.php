@php $editing = isset($court) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="courtID"
            label="Court Id"
            :value="old('courtID', ($editing ? $court->courtID : ''))"
            maxlength="255"
            placeholder="Court Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $court->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="courtType" label="Court Type">
            @php $selected = old('courtType', ($editing ? $court->courtType : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >Higher</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >First court</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >Second Court</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="Speciality" label="Speciality">
            @php $selected = old('Speciality', ($editing ? $court->Speciality : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >Judge</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >Lawyer</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >IT</option>
            <option value="4" {{ $selected == '4' ? 'selected' : '' }} >Attorney</option>
            <option value="5" {{ $selected == '5' ? 'selected' : '' }} >Bar</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="Descryption"
            label="Descryption"
            maxlength="255"
            required
            >{{ old('Descryption', ($editing ? $court->Descryption : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
