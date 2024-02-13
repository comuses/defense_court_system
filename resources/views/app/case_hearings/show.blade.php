<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.case_hearings.show_title')
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

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.court_id')
                        </h5>
                        <span
                            >{{ optional($caseHearing->court)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.mod_id')
                        </h5>
                        <span
                            >{{ optional($caseHearing->mod)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.attorney_id')
                        </h5>
                        <span
                            >{{ optional($caseHearing->attorney)->courtID ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.judge_id')
                        </h5>
                        <span
                            >{{ optional($caseHearing->judge)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.witness_id')
                        </h5>
                        <span
                            >{{ optional($caseHearing->witness)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.casehearingID')
                        </h5>
                        <span>{{ $caseHearing->casehearingID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.chilotname')
                        </h5>
                        <span>{{ $caseHearing->chilotname ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.fileNumber')
                        </h5>
                        <span>{{ $caseHearing->fileNumber ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.caseStartDate')
                        </h5>
                        <span>{{ $caseHearing->caseStartDate ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.address')
                        </h5>
                        <span>{{ $caseHearing->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.state')
                        </h5>
                        <span>{{ $caseHearing->state ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.location')
                        </h5>
                        <span>{{ $caseHearing->location ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.description')
                        </h5>
                        <span>{{ $caseHearing->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.attoneryWitnessID')
                        </h5>
                        <span
                            >{{ $caseHearing->attoneryWitnessID ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_hearings.inputs.accEmpID')
                        </h5>
                        <span>{{ $caseHearing->accEmpID ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('case-hearings.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\CaseHearing::class)
                    <a
                        href="{{ route('case-hearings.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
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
