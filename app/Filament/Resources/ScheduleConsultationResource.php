<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleConsultationResource\Pages;
use App\Filament\Resources\ScheduleConsultationResource\RelationManagers;
use App\Models\ScheduleConsultation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleConsultationResource extends Resource
{
    protected static ?string $model = ScheduleConsultation::class;
    protected static?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?int $navigationSort = 100;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                
                Forms\Components\Repeater::make('items')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                        ->label('Icon / Logo')
                            ->image()
                            ->directory('schedule-consultation')
                            ->required(),
                            
                        Forms\Components\TextInput::make('text')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('url')
                            ->maxLength(255),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->defaultItems(1),
                    
                // Forms\Components\RichEditor::make('description')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScheduleConsultations::route('/'),
            'create' => Pages\CreateScheduleConsultation::route('/create'),
            'edit' => Pages\EditScheduleConsultation::route('/{record}/edit'),
        ];
    }
}
