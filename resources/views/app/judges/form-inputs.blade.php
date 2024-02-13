@php $editing = isset($judge) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="court_id" label="Court" required>
            @php $selected = old('court_id', ($editing ? $judge->court_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Court</option>
            @foreach($courts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="judgeID"
            label="Judge Id"
            :value="old('judgeID', ($editing ? $judge->judgeID : ''))"
            maxlength="255"
            placeholder="Judge Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $judge->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="courtType" label="Court Type">
            @php $selected = old('courtType', ($editing ? $judge->courtType : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >higher</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >first court</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >second court</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $judge->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="state"
            label="State"
            :value="old('state', ($editing ? $judge->state : ''))"
            maxlength="255"
            placeholder="State"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="empType"
            label="Emp Type"
            :value="old('empType', ($editing ? $judge->empType : ''))"
            maxlength="255"
            placeholder="Emp Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $judge->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
