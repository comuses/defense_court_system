<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.courts.edit_title')
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

                <x-form
                    method="PUT"
                    action="{{ route('courts.update', $court) }}"
                    class="mt-4"
                >
                    @include('app.courts.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('courts.index') }}" class="button">
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

                        <a href="{{ route('courts.create') }}" class="button">
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
