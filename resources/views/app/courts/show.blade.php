<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.courts.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('courts.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.courts.inputs.courtID')
                        </h5>
                        <span>{{ $court->courtID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.courts.inputs.name')
                        </h5>
                        <span>{{ $court->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.courts.inputs.courtType')
                        </h5>
                        <span>{{ $court->courtType ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.courts.inputs.Speciality')
                        </h5>
                        <span>{{ $court->Speciality ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.courts.inputs.Descryption')
                        </h5>
                        <span>{{ $court->Descryption ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('courts.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Court::class)
                    <a href="{{ route('courts.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\Attorney::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Attorneys </x-slot>

                <livewire:court-attorneys-detail :court="$court" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Judge::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Judges </x-slot>

                <livewire:court-judges-detail :court="$court" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Bar::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Bars </x-slot>

                <livewire:court-bars-detail :court="$court" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\CaseHearing::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Case Hearings </x-slot>

                <livewire:court-case-hearings-detail :court="$court" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
