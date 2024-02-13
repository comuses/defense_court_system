<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.case_hearings.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('case-hearings.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('case-hearings.update', $caseHearing) }}"
                    class="mt-4"
                >
                    @include('app.case_hearings.form-inputs')

                    <div class="mt-10">
                        <a
                            href="{{ route('case-hearings.index') }}"
                            class="button"
                        >
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

                        <a
                            href="{{ route('case-hearings.create') }}"
                            class="button"
                        >
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

            @can('view-any', App\Models\Appointment::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Appointments </x-slot>

                <livewire:case-hearing-appointments-detail
                    :caseHearing="$caseHearing"
                />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Decision::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Decisions </x-slot>

                <livewire:case-hearing-decisions-detail
                    :caseHearing="$caseHearing"
                />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
