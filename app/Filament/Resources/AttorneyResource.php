<?php

namespace App\Filament\Resources;

use App\Models\Attorney;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\AttorneyResource\Pages;

class AttorneyResource extends Resource
{
    protected static ?string $model = Attorney::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'courtID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('attoneyID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Attoney Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

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

                    TextInput::make('fullname')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Fullname')
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
                            '1' => 'higher',
                            '2' => 'First Court',
                            '3' => 'Local',
                        ])
                        ->placeholder('Court Type')
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

                    RichEditor::make('description')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Description')
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
                Tables\Columns\TextColumn::make('attoneyID')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('court.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('fullname')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('courtType')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '1' => 'higher',
                        '2' => 'First Court',
                        '3' => 'Local',
                    ]),
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
                Tables\Columns\TextColumn::make('description')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('court_id')
                    ->relationship('court', 'name')
                    ->indicator('Court')
                    ->multiple()
                    ->label('Court'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AttorneyResource\RelationManagers\CaseHearingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttorneys::route('/'),
            'create' => Pages\CreateAttorney::route('/create'),
            'view' => Pages\ViewAttorney::route('/{record}'),
            'edit' => Pages\EditAttorney::route('/{record}/edit'),
        ];
    }
}
