<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.case_hearings.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\CaseHearing::class)
                            <a
                                href="{{ route('case-hearings.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.court_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.mod_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.attorney_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.judge_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.witness_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.casehearingID')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.chilotname')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.fileNumber')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.caseStartDate')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.state')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.location')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.description')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.attoneryWitnessID')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.case_hearings.inputs.accEmpID')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($caseHearings as $caseHearing)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($caseHearing->court)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($caseHearing->mod)->name ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($caseHearing->attorney)->courtID
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($caseHearing->judge)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($caseHearing->witness)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->casehearingID ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->chilotname ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->fileNumber ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->caseStartDate ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->state ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->location ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->description ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->attoneryWitnessID ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $caseHearing->accEmpID ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $caseHearing)
                                        <a
                                            href="{{ route('case-hearings.edit', $caseHearing) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $caseHearing)
                                        <a
                                            href="{{ route('case-hearings.show', $caseHearing) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $caseHearing)
                                        <form
                                            action="{{ route('case-hearings.destroy', $caseHearing) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="16">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="16">
                                    <div class="mt-10 px-4">
                                        {!! $caseHearings->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
