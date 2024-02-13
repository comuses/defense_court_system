<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.case_charges.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('case-charges.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.mod_employee_id')
                        </h5>
                        <span
                            >{{ optional($caseCharge->modEmployee)->modID ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.mod_id')
                        </h5>
                        <span
                            >{{ optional($caseCharge->mod)->name ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.rank')
                        </h5>
                        <span>{{ $caseCharge->rank ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.fullName')
                        </h5>
                        <span>{{ $caseCharge->fullName ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.address')
                        </h5>
                        <span>{{ $caseCharge->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.state')
                        </h5>
                        <span>{{ $caseCharge->state ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.crimeType')
                        </h5>
                        <span>{{ $caseCharge->crimeType ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.crimeDate')
                        </h5>
                        <span>{{ $caseCharge->crimeDate ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.chargeDate')
                        </h5>
                        <span>{{ $caseCharge->chargeDate ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.case_charges.inputs.registrar_id')
                        </h5>
                        <span
                            >{{ optional($caseCharge->registrar)->MIDNumber ??
                            '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('case-charges.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\CaseCharge::class)
                    <a href="{{ route('case-charges.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
