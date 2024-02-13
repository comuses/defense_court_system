<?php

namespace App\Filament\Resources\AttorneyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class CaseHearingsRelationManager extends RelationManager
{
    protected static string $relationship = 'caseHearings';

    protected static ?string $recordTitleAttribute = 'casehearingID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('court_id')
                    ->rules(['exists:courts,id'])
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
                    ->relationship('mod', 'name')
                    ->searchable()
                    ->placeholder('Mod')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('judge_id')
                    ->rules(['exists:judges,id'])
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
                    ->placeholder('Chilotname')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('fileNumber')
                    ->rules(['max:255', 'string'])
                    ->placeholder('File Number')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                DateTimePicker::make('caseStartDate')
                    ->rules(['date'])
                    ->placeholder('Case Start Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('address')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Address')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('state')
                    ->rules(['max:255', 'string'])
                    ->placeholder('State')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('location')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Location')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                RichEditor::make('description')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Description')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('attoneryWitnessID')
                    ->rules(['max:255', 'string'])
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
                    ->searchable()
                    ->options([])
                    ->placeholder('Acc Emp Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('court.name')->limit(50),
                Tables\Columns\TextColumn::make('mod.name')->limit(50),
                Tables\Columns\TextColumn::make('attorney.courtID')->limit(50),
                Tables\Columns\TextColumn::make('judge.name')->limit(50),
                Tables\Columns\TextColumn::make('witness.name')->limit(50),
                Tables\Columns\TextColumn::make('casehearingID')->enum([]),
                Tables\Columns\TextColumn::make('chilotname')->limit(50),
                Tables\Columns\TextColumn::make('fileNumber')->limit(50),
                Tables\Columns\TextColumn::make('caseStartDate')->dateTime(),
                Tables\Columns\TextColumn::make('address')->limit(50),
                Tables\Columns\TextColumn::make('state')->limit(50),
                Tables\Columns\TextColumn::make('location')->limit(50),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('attoneryWitnessID')->enum([]),
                Tables\Columns\TextColumn::make('accEmpID')->enum([]),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('court_id')->relationship(
                    'court',
                    'name'
                ),

                MultiSelectFilter::make('mod_id')->relationship('mod', 'name'),

                MultiSelectFilter::make('attorney_id')->relationship(
                    'attorney',
                    'courtID'
                ),

                MultiSelectFilter::make('judge_id')->relationship(
                    'judge',
                    'name'
                ),

                MultiSelectFilter::make('witness_id')->relationship(
                    'witness',
                    'name'
                ),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
