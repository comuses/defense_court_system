<?php

namespace App\Filament\Resources;

use App\Models\CaseHearing;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\CaseHearingResource\Pages;

class CaseHearingResource extends Resource
{
    protected static ?string $model = CaseHearing::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'casehearingID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('court_id')
                        ->rules(['exists:courts,id'])
                        ->required()
                        ->relationship('court', 'name')
                        ->searchable()
                        ->placeholder('Court')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('mod_id')
                        ->rules(['exists:mods,id'])
                        ->required()
                        ->relationship('mod', 'name')
                        ->searchable()
                        ->placeholder('Mod')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('attorney_id')
                        ->rules(['exists:attorneys,id'])
                        ->required()
                        ->relationship('attorney', 'courtID')
                        ->searchable()
                        ->placeholder('Attorney')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('judge_id')
                        ->rules(['exists:judges,id'])
                        ->required()
                        ->relationship('judge', 'name')
                        ->searchable()
                        ->placeholder('Judge')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('witness_id')
                        ->rules(['exists:witnesses,id'])
                        ->required()
                        ->relationship('witness', 'name')
                        ->searchable()
                        ->placeholder('Witness')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('casehearingID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->searchable()
                        ->options([])
                        ->placeholder('Casehearing Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('chilotname')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Chilotname')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('fileNumber')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('File Number')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DateTimePicker::make('caseStartDate')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Case Start Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('address')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Address')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('state')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('State')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('location')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Location')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    RichEditor::make('description')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Description')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('attoneryWitnessID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->searchable()
                        ->options([])
                        ->placeholder('Attonery Witness Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('accEmpID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->searchable()
                        ->options([])
                        ->placeholder('Acc Emp Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('court.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('mod.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('attorney.courtID')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('judge.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('witness.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('casehearingID')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('chilotname')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('fileNumber')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('caseStartDate')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('state')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('location')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('description')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('attoneryWitnessID')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('accEmpID')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('court_id')
                    ->relationship('court', 'name')
                    ->indicator('Court')
                    ->multiple()
                    ->label('Court'),

                SelectFilter::make('mod_id')
                    ->relationship('mod', 'name')
                    ->indicator('Mod')
                    ->multiple()
                    ->label('Mod'),

                SelectFilter::make('attorney_id')
                    ->relationship('attorney', 'courtID')
                    ->indicator('Attorney')
                    ->multiple()
                    ->label('Attorney'),

                SelectFilter::make('judge_id')
                    ->relationship('judge', 'name')
                    ->indicator('Judge')
                    ->multiple()
                    ->label('Judge'),

                SelectFilter::make('witness_id')
                    ->relationship('witness', 'name')
                    ->indicator('Witness')
                    ->multiple()
                    ->label('Witness'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CaseHearingResource\RelationManagers\AppointmentsRelationManager::class,
            CaseHearingResource\RelationManagers\DecisionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaseHearings::route('/'),
            'create' => Pages\CreateCaseHearing::route('/create'),
            'view' => Pages\ViewCaseHearing::route('/{record}'),
            'edit' => Pages\EditCaseHearing::route('/{record}/edit'),
        ];
    }
}
