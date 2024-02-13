<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.mods.edit_title')
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

                <x-form
                    method="PUT"
                    action="{{ route('mods.update', $mod) }}"
                    class="mt-4"
                >
                    @include('app.mods.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('mods.index') }}" class="button">
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('mods.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\ModEmployee::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Mod Employees </x-slot>

                <livewire:mod-mod-employees-detail :mod="$mod" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Appointment::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Appointments </x-slot>

                <livewire:mod-appointments-detail :mod="$mod" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\CaseCharge::class)
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
