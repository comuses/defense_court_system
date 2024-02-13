@php $editing = isset($witness) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="witnessID"
            label="Witness Id"
            :value="old('witnessID', ($editing ? $witness->witnessID : ''))"
            maxlength="255"
            placeholder="Witness Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $witness->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $witness->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="state"
            label="State"
            :value="old('state', ($editing ? $witness->state : ''))"
            maxlength="255"
            placeholder="State"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="attorneyWitness"
            label="Attorney Witness"
            :value="old('attorneyWitness', ($editing ? $witness->attorneyWitness : ''))"
            maxlength="255"
            placeholder="Attorney Witness"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea
            name="Description"
            label="Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $witness->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="accusedWitness"
            label="Accused Witness"
            :value="old('accusedWitness', ($editing ? $witness->accusedWitness : ''))"
            maxlength="255"
            placeholder="Accused Witness"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="attoneyID"
            label="Attoney Id"
            :value="old('attoneyID', ($editing ? $witness->attoneyID : ''))"
            maxlength="255"
            placeholder="Attoney Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="caseChargedID"
            label="Case Charged Id"
            :value="old('caseChargedID', ($editing ? $witness->caseChargedID : ''))"
            maxlength="255"
            placeholder="Case Charged Id"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
