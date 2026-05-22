<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
         return $form
        ->schema([

            Forms\Components\Section::make('Transaction Details')
                ->schema([

                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('slug', \Illuminate\Support\Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('category')
                        ->placeholder('Artificial Intelligence'),

                    Forms\Components\TextInput::make('amount')
                        ->placeholder('$85M'),

                    Forms\Components\TextInput::make('transaction_type')
                        ->placeholder('Series B Acquisition'),

                    Forms\Components\Textarea::make('short_description')
                        ->rows(3),

                    Forms\Components\FileUpload::make('featured_image')
                        ->image()
                        ->directory('transactions'),

                    Forms\Components\TextInput::make('button_text')
                        ->default('View Case Study'),

                    Forms\Components\TextInput::make('button_url')
                        ->url(),

                    Forms\Components\Toggle::make('is_active')
                        ->default(true),

                ])
                ->columns(2)

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([

            Tables\Columns\ImageColumn::make('featured_image')
                ->square(),

            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('category'),

            Tables\Columns\TextColumn::make('amount'),

            Tables\Columns\TextColumn::make('transaction_type')
                ->limit(25),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean(),

            Tables\Columns\TextColumn::make('created_at')
                ->date('d M Y'),

        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
