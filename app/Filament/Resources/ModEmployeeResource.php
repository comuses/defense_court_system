<?php

namespace App\Filament\Resources;

use App\Models\ModEmployee;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\ModEmployeeResource\Pages;

class ModEmployeeResource extends Resource
{
    protected static ?string $model = ModEmployee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'modID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
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

                    TextInput::make('EmpID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Emp Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('rank')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Rank')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('fullName')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Full Name')
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

                    TextInput::make('empType')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Emp Type')
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
                Tables\Columns\TextColumn::make('mod.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('EmpID')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('rank')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('fullName')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('state')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('empType')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('mod_id')
                    ->relationship('mod', 'name')
                    ->indicator('Mod')
                    ->multiple()
                    ->label('Mod'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ModEmployeeResource\RelationManagers\CaseChargesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModEmployees::route('/'),
            'create' => Pages\CreateModEmployee::route('/create'),
            'view' => Pages\ViewModEmployee::route('/{record}'),
            'edit' => Pages\EditModEmployee::route('/{record}/edit'),
        ];
    }
}
