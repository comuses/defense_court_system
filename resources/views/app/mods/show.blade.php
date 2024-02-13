<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.mods.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('mods.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mods.inputs.modID')
                        </h5>
                        <span>{{ $mod->modID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mods.inputs.name')
                        </h5>
                        <span>{{ $mod->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mods.inputs.address')
                        </h5>
                        <span>{{ $mod->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mods.inputs.state')
                        </h5>
                        <span>{{ $mod->state ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mods.inputs.description')
                        </h5>
                        <span>{{ $mod->description ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('mods.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Mod::class)
                    <a href="{{ route('mods.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\CaseCharge::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Case Charges </x-slot>

                <livewire:mod-case-charges-detail :mod="$mod" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\CaseHearing::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Case Hearings </x-slot>

                <livewire:mod-case-hearings-detail :mod="$mod" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Decision::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Decisions </x-slot>

                <livewire:mod-decisions-detail :mod="$mod" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
