<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.registrars.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('registrars.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.MIDNumber')
                        </h5>
                        <span>{{ $registrar->MIDNumber ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.Rank')
                        </h5>
                        <span>{{ $registrar->Rank ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.Name')
                        </h5>
                        <span>{{ $registrar->Name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.fieldType')
                        </h5>
                        <span>{{ $registrar->fieldType ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.address')
                        </h5>
                        <span>{{ $registrar->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.city')
                        </h5>
                        <span>{{ $registrar->city ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.state')
                        </h5>
                        <span>{{ $registrar->state ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registrars.inputs.court_id')
                        </h5>
                        <span
                            >{{ optional($registrar->court)->name ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('registrars.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Registrar::class)
                    <a href="{{ route('registrars.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\CaseCharge::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Case Charges </x-slot>

                <livewire:registrar-case-charges-detail
                    :registrar="$registrar"
                />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
