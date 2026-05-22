<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use FilamentTiptapEditor\TiptapEditor;
use App\Models\User;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        Forms\Components\Grid::make([
            'default' => 1,
            'lg' => 3,
        ])
        ->schema([
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Section::make('Post Details')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                    if ($operation !== 'create') {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            TiptapEditor::make('body')
                                ->required()
                                ->columnSpanFull(),
                        ]),
                    
                    Forms\Components\Section::make('SEO settings')
                        ->schema([
                            Forms\Components\Textarea::make('short_description')
                            ->label('Meta description')
                                ->maxLength(500)
                                ->columnSpanFull(),
                            Forms\Components\TagsInput::make('keywords')
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpan([
                    'lg' => 2,
                ]),
            
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Section::make('Status')
                        ->schema([
                            Forms\Components\Toggle::make('is_published')
                                ->required(),
                            Forms\Components\Select::make('categories')
                                ->relationship('categories', 'name', fn ($query) => $query->whereIn('status', ['1']))
                                ->multiple()
                                ->required()
                                ->preload(),
                            Forms\Components\DateTimePicker::make('published_at')
                                ->native(false)
                                ->required()
                                ->default(now()),
                            Forms\Components\FileUpload::make('feature_image')
                                ->image()
                                ->directory('posts')
                                ->columnSpanFull(),
                            Forms\Components\Select::make('author_id')
                                        ->label('Author')
                                        ->relationship('author', 'name')
                                        ->required()
                                        ->preload()
                                        ->options(function () {
                                            return User::where('status', 'active')
                                                ->pluck('name', 'id');
                                        })
                                        ->default(auth()->id()), // Default to current user
                                    Forms\Components\DateTimePicker::make('published_at')
                                        ->native(false)
                                        ->required()
                                        ->default(now()),
                                    Forms\Components\FileUpload::make('feature_image')
                                        ->image()
                                        ->directory('posts')
                                        ->columnSpanFull(),
                        ]),
                ])
                ->columnSpan([
                    'lg' => 1,
                ]),
        ]),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('feature_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
               
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->query(fn ($query) => $query->where('is_published', true)),
                    
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

    // public static function getRelations(): array
    // {
    //     return [
    //         RelationManagers\CategoriesRelationManager::make(),
    //     ];
    // }
 public static function getRelations(): array
    {
        return [
            RelationManagers\CommentsRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

}