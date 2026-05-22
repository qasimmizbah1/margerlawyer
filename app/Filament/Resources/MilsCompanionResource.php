<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MilsCompanionResource\Pages;
use App\Filament\Resources\MilsCompanionResource\RelationManagers;
use App\Models\MilsCompanion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use illuminate\Support\Str;

class MilsCompanionResource extends Resource
{
    protected static ?string $model = MilsCompanion::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'MILS Companion';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            Forms\Components\Grid::make(3)
                ->schema([

                    Forms\Components\Section::make('MILS Companion Details')
                        ->schema([

                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, Forms\Set $set) {
                                    $set('slug', Str::slug($state));
                                }),

                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\Textarea::make('short_description')
                                ->rows(4)
                                ->columnSpanFull(),

                            \FilamentTiptapEditor\TiptapEditor::make('content')
                                ->columnSpanFull(),

                        ])
                        ->columnSpan(2),

                    Forms\Components\Section::make('Media & Publish')
                        ->schema([

                            Forms\Components\FileUpload::make('hero_image')
                                ->image()
                                ->directory('mils-companion')
                                ->imageEditor(),

                            Forms\Components\FileUpload::make('gallery')
                                ->multiple()
                                ->image()
                                ->directory('mils-companion/gallery'),

                            Forms\Components\Toggle::make('is_featured')
                                ->default(false),

                            Forms\Components\Toggle::make('is_published')
                                ->default(true),

                            Forms\Components\DateTimePicker::make('published_at')
                                ->default(now()),

                        ])
                        ->columnSpan(1),

                ]),

            Forms\Components\Section::make('App URLs')
                ->schema([

                    Forms\Components\TextInput::make('android_url')
                        ->url(),

                    Forms\Components\TextInput::make('ios_url')
                        ->url(),

                    Forms\Components\TextInput::make('website_url')
                        ->url(),

                ]),

            Forms\Components\Section::make('Features')
                ->schema([

                    Forms\Components\Repeater::make('features')
                        ->schema([

                            Forms\Components\TextInput::make('title')
                                ->required(),

                            Forms\Components\Textarea::make('description'),

                            Forms\Components\FileUpload::make('icon')
                                ->image(),

                        ])
                        ->collapsible()
                        ->columnSpanFull(),

                ]),

            Forms\Components\Section::make('SEO')
                ->schema([

                    Forms\Components\TagsInput::make('keywords'),

                ]),

        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([

            Tables\Columns\ImageColumn::make('hero_image')
                ->square(),

            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),

            Tables\Columns\IconColumn::make('is_featured')
                ->boolean(),

            Tables\Columns\IconColumn::make('is_published')
                ->boolean(),

            Tables\Columns\TextColumn::make('published_at')
                ->dateTime(),

        ])

        ->filters([

            Tables\Filters\TernaryFilter::make('is_featured'),

            Tables\Filters\TernaryFilter::make('is_published'),

        ])

        ->actions([

            Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListMilsCompanions::route('/'),
            'create' => Pages\CreateMilsCompanion::route('/create'),
            'view' => Pages\ViewMilsCompanion::route('/{record}'),
            'edit' => Pages\EditMilsCompanion::route('/{record}/edit'),
        ];
    }
}
