<?php

namespace App\Filament\Resources;

use App\Models\Court;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\CourtResource\Pages;

class CourtResource extends Resource
{
    protected static ?string $model = Court::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('courtID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Court Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('courtType')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->searchable()
                        ->options([
                            '1' => 'Higher',
                            '2' => 'First court',
                            '3' => 'Second Court',
                        ])
                        ->placeholder('Court Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('Speciality')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->searchable()
                        ->options([
                            '1' => 'Judge',
                            '2' => 'Lawyer',
                            '3' => 'IT',
                            '4' => 'Attorney',
                            '5' => 'Bar',
                        ])
                        ->placeholder('Speciality')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    RichEditor::make('Descryption')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Descryption')
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
                Tables\Columns\TextColumn::make('courtID')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('courtType')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '1' => 'Higher',
                        '2' => 'First court',
                        '3' => 'Second Court',
                    ]),
                Tables\Columns\TextColumn::make('Speciality')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '1' => 'Judge',
                        '2' => 'Lawyer',
                        '3' => 'IT',
                        '4' => 'Attorney',
                        '5' => 'Bar',
                    ]),
                Tables\Columns\TextColumn::make('Descryption')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([DateRangeFilter::make('created_at')]);
    }

    public static function getRelations(): array
    {
        return [
            CourtResource\RelationManagers\RegistrarsRelationManager::class,
            CourtResource\RelationManagers\AttorneysRelationManager::class,
            CourtResource\RelationManagers\JudgesRelationManager::class,
            CourtResource\RelationManagers\BarsRelationManager::class,
            CourtResource\RelationManagers\CaseHearingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourts::route('/'),
            'create' => Pages\CreateCourt::route('/create'),
            'view' => Pages\ViewCourt::route('/{record}'),
            'edit' => Pages\EditCourt::route('/{record}/edit'),
        ];
    }
}
