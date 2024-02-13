<?php

namespace App\Filament\Resources\ModResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class CaseChargesRelationManager extends RelationManager
{
    protected static string $relationship = 'caseCharges';

    protected static ?string $recordTitleAttribute = 'modID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('mod_employee_id')
                    ->rules(['exists:mod_employees,id'])
                    ->relationship('modEmployee', 'modID')
                    ->searchable()
                    ->placeholder('Mod Employee')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('rank')
                    ->rules(['max:255', 'string'])
                    ->searchable()
                    ->options([])
                    ->placeholder('Rank')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('fullName')
                    ->rules(['max:255', 'string'])
                    ->searchable()
                    ->options([])
                    ->placeholder('Full Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('address')
                    ->rules(['max:255', 'string'])
                    ->searchable()
                    ->options([])
                    ->placeholder('Address')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('state')
                    ->rules(['max:255', 'string'])
                    ->searchable()
                    ->options([])
                    ->placeholder('State')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                RichEditor::make('crimeType')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Crime Type')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                DateTimePicker::make('crimeDate')
                    ->rules(['date'])
                    ->placeholder('Crime Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                DateTimePicker::make('chargeDate')
                    ->rules(['date'])
                    ->placeholder('Charge Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('registrar_id')
                    ->rules(['exists:registrars,id'])
                    ->relationship('registrar', 'MIDNumber')
                    ->searchable()
                    ->placeholder('Registrar')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('modEmployee.modID')->limit(50),
                Tables\Columns\TextColumn::make('mod.name')->limit(50),
                Tables\Columns\TextColumn::make('rank')->enum([]),
                Tables\Columns\TextColumn::make('fullName')->enum([]),
                Tables\Columns\TextColumn::make('address')->enum([]),
                Tables\Columns\TextColumn::make('state')->enum([]),
                Tables\Columns\TextColumn::make('crimeType')->limit(50),
                Tables\Columns\TextColumn::make('crimeDate')->dateTime(),
                Tables\Columns\TextColumn::make('chargeDate')->dateTime(),
                Tables\Columns\TextColumn::make('registrar.MIDNumber')->limit(
                    50
                ),
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

                MultiSelectFilter::make('mod_employee_id')->relationship(
                    'modEmployee',
                    'modID'
                ),

                MultiSelectFilter::make('mod_id')->relationship('mod', 'name'),

                MultiSelectFilter::make('registrar_id')->relationship(
                    'registrar',
                    'MIDNumber'
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
