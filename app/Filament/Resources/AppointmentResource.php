<?php

namespace App\Filament\Resources;

use App\Models\Appointment;
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
use App\Filament\Resources\AppointmentResource\Pages;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'caseHearID';

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

                    Select::make('case_hearing_id')
                        ->rules(['exists:case_hearings,id'])
                        ->required()
                        ->relationship('caseHearing', 'casehearingID')
                        ->searchable()
                        ->placeholder('Case Hearing')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('empID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->searchable()
                        ->options([])
                        ->placeholder('Emp Id')
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

                    TextInput::make('chargeType')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Charge Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DateTimePicker::make('appointmentDate')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Appointment Date')
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
                Tables\Columns\TextColumn::make('caseHearing.casehearingID')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('empID')
                    ->toggleable()
                    ->searchable()
                    ->enum([]),
                Tables\Columns\TextColumn::make('fullname')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('chargeType')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('appointmentDate')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('description')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('mod_id')
                    ->relationship('mod', 'name')
                    ->indicator('Mod')
                    ->multiple()
                    ->label('Mod'),

                SelectFilter::make('case_hearing_id')
                    ->relationship('caseHearing', 'casehearingID')
                    ->indicator('CaseHearing')
                    ->multiple()
                    ->label('CaseHearing'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
