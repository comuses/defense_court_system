<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.witnesses.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('witnesses.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.witnessID')
                        </h5>
                        <span>{{ $witness->witnessID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.name')
                        </h5>
                        <span>{{ $witness->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.address')
                        </h5>
                        <span>{{ $witness->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.state')
                        </h5>
                        <span>{{ $witness->state ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.attorneyWitness')
                        </h5>
                        <span>{{ $witness->attorneyWitness ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.Description')
                        </h5>
                        <span>{{ $witness->Description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.accusedWitness')
                        </h5>
                        <span>{{ $witness->accusedWitness ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.attoneyID')
                        </h5>
                        <span>{{ $witness->attoneyID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.witnesses.inputs.caseChargedID')
                        </h5>
                        <span>{{ $witness->caseChargedID ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('witnesses.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Witness::class)
                    <a href="{{ route('witnesses.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\CaseHearing::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Case Hearings </x-slot>

                <livewire:witness-case-hearings-detail :witness="$witness" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
