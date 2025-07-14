<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Filament\Resources\FooterSettingResource\RelationManagers;
use App\Models\Settings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterSettingResource extends Resource
{
    protected static ?string $model = Settings::class;

   protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Footer Settings';

    protected static ?string $modelLabel = 'Footer Setting';

    protected static ?int $navigationSort = 100;

    public static function getEloquentQuery(): Builder
    {
    return parent::getEloquentQuery()
        ->whereIn('id', [30, 31,51]); // Only show records with ID 1 or 2
    }


    public static function form(Form $form): Form
    {
        return $form
             ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->hiddenOn('edit'),
                    
                Forms\Components\Textarea::make('payload')
                    ->label(function ($record) {
                        return match($record?->name) {
                            'copyright' => 'Copyright Text',
                            'google_analytics' => 'Google Analytics Code',
                            default => 'Value'
                        };
                    })
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'copyright' => 'Copyright Text',
                        'google_analytics' => 'Google Analytics Code',
                        default => $state
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('payload')
                    ->label('Value')
                    ->wrap()
                    ->formatStateUsing(fn ($state) => strip_tags($state)) // Strip HTML if needed
                    ->extraAttributes([
                    'style' => 'white-space: pre-wrap; word-break: break-word; max-height: 10em; overflow-y: auto; overflow-x: hidden;',
                    ]),    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFooterSettings::route('/'),
        ];
    }
}
