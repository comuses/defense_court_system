@php $editing = isset($attorney) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="attoneyID"
            label="Attoney Id"
            :value="old('attoneyID', ($editing ? $attorney->attoneyID : ''))"
            maxlength="255"
            placeholder="Attoney Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="court_id" label="Court" required>
            @php $selected = old('court_id', ($editing ? $attorney->court_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Court</option>
            @foreach($courts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="fullname"
            label="Fullname"
            :value="old('fullname', ($editing ? $attorney->fullname : ''))"
            maxlength="255"
            placeholder="Fullname"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="courtType" label="Court Type">
            @php $selected = old('courtType', ($editing ? $attorney->courtType : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >higher</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >First Court</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >Local</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $attorney->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="state"
            label="State"
            :value="old('state', ($editing ? $attorney->state : ''))"
            maxlength="255"
            placeholder="State"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="empType"
            label="Emp Type"
            :value="old('empType', ($editing ? $attorney->empType : ''))"
            maxlength="255"
            placeholder="Emp Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $attorney->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
