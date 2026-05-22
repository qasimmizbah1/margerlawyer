<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebinarResource\Pages;
use App\Filament\Resources\WebinarResource\RelationManagers;
use App\Models\Webinar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebinarResource extends Resource
{
    protected static ?string $model = Webinar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Forms\Components\Section::make('Webinar Details')
                ->schema([

                    Forms\Components\FileUpload::make('featured_image')
                        ->image()
                        ->directory('webinars')
                        ->required(),

                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('slug', \Illuminate\Support\Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('subtitle')
                        ->placeholder('M&A Trends in AI'),

                    Forms\Components\Textarea::make('short_description')
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('speaker_name')
                        ->placeholder('Syeda Nazifa Nawroj'),

                    Forms\Components\DatePicker::make('event_date'),

                    Forms\Components\TextInput::make('event_time')
                        ->placeholder('2:00 PM'),

                    Forms\Components\TextInput::make('event_timezone')
                        ->placeholder('PT'),

                    Forms\Components\TextInput::make('button_text')
                        ->default('Register Now'),

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

            Tables\Columns\TextColumn::make('speaker_name'),

            Tables\Columns\TextColumn::make('event_date')
                ->date('d M Y'),

            Tables\Columns\TextColumn::make('event_time'),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean(),

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
            'index' => Pages\ListWebinars::route('/'),
            'create' => Pages\CreateWebinar::route('/create'),
            'edit' => Pages\EditWebinar::route('/{record}/edit'),
        ];
    }
}
