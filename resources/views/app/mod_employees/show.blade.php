<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.mod_employees.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('mod-employees.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.mod_id')
                        </h5>
                        <span
                            >{{ optional($modEmployee->mod)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.EmpID')
                        </h5>
                        <span>{{ $modEmployee->EmpID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.rank')
                        </h5>
                        <span>{{ $modEmployee->rank ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.fullName')
                        </h5>
                        <span>{{ $modEmployee->fullName ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.address')
                        </h5>
                        <span>{{ $modEmployee->address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.state')
                        </h5>
                        <span>{{ $modEmployee->state ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.mod_employees.inputs.empType')
                        </h5>
                        <span>{{ $modEmployee->empType ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('mod-employees.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\ModEmployee::class)
                    <a
                        href="{{ route('mod-employees.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\CaseCharge::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Case Charges </x-slot>

                <livewire:mod-employee-case-charges-detail
                    :modEmployee="$modEmployee"
                />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
