<?php

namespace App\Filament\Resources;

use App\Models\CaseCharge;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\CaseChargeResource\Pages;

class CaseChargeResource extends Resource
{
    protected static ?string $model = CaseCharge::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'modID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('mod_employee_id')
                        ->rules(['exists:mod_employees,id'])
                        ->required()
                        ->relationship('modEmployee', 'modID')
                        ->searchable()
                        ->placeholder('Mod Employee')
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

                    Select::make('rank')
                        ->rules(['max:255', 'string'])
                        ->required()
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
                        ->required()
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
                        ->required()
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
                        ->required()
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
                        ->required()
                        ->placeholder('Crime Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DateTimePicker::make('crimeDate')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Crime Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DateTimePicker::make('chargeDate')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Charge Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('registrar_id')
                        ->rules(['exists:registrars,id'])
                        ->required()
                        ->relationship('registrar', 'MIDNumber')
                        ->searchable()
                        ->placeholder('Registrar')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
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
                Tables\Columns\TextColumn::make('modEmployee.modID')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('mod.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('rank')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('fullName')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('state')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('crimeType')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('crimeDate')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('chargeDate')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('registrar.MIDNumber')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('mod_employee_id')
                    ->relationship('modEmployee', 'modID')
                    ->indicator('ModEmployee')
                    ->multiple()
                    ->label('ModEmployee'),

                SelectFilter::make('mod_id')
                    ->relationship('mod', 'name')
                    ->indicator('Mod')
                    ->multiple()
                    ->label('Mod'),

                SelectFilter::make('registrar_id')
                    ->relationship('registrar', 'MIDNumber')
                    ->indicator('Registrar')
                    ->multiple()
                    ->label('Registrar'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaseCharges::route('/'),
            'create' => Pages\CreateCaseCharge::route('/create'),
            'view' => Pages\ViewCaseCharge::route('/{record}'),
            'edit' => Pages\EditCaseCharge::route('/{record}/edit'),
        ];
    }
}
