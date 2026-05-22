<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseStudyResource\Pages;
use App\Filament\Resources\CaseStudyResource\RelationManagers;
use App\Models\CaseStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CaseStudyResource extends Resource
{
    protected static ?string $model = CaseStudy::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $modelLabel = 'Case Study';

    protected static ?string $pluralModelLabel = 'Case Studies';

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            Forms\Components\Section::make('Case Study Details')
                ->columns(2)
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

                    Forms\Components\TextInput::make('client_name'),

                    Forms\Components\TextInput::make('industry'),

                    Forms\Components\Textarea::make('short_description')
                        ->rows(3),

                    \FilamentTiptapEditor\TiptapEditor::make('content')
                        ->required()
                        ->columnSpanFull(),

                ]),

            Forms\Components\Section::make('Media & SEO')
                ->columns(2)
                ->schema([

                    Forms\Components\FileUpload::make('feature_image')
                        ->image()
                        ->directory('case-studies'),

                    Forms\Components\FileUpload::make('gallery')
                        ->multiple()
                        ->image()
                        ->directory('case-studies/gallery'),

                    Forms\Components\TagsInput::make('keywords'),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->default(now()),

                    Forms\Components\Toggle::make('is_published')
                        ->default(true),

                ])

        ]);
}

   public static function table(Table $table): Table
{
    return $table
        ->columns([

            Tables\Columns\ImageColumn::make('feature_image')
                ->square(),

            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('client_name')
                ->searchable(),

            Tables\Columns\TextColumn::make('industry'),

            Tables\Columns\IconColumn::make('is_published')
                ->boolean(),

            Tables\Columns\TextColumn::make('published_at')
                ->dateTime(),

        ])

        ->filters([
            Tables\Filters\TernaryFilter::make('is_published')
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
            'index' => Pages\ListCaseStudies::route('/'),
            'create' => Pages\CreateCaseStudy::route('/create'),
            'edit' => Pages\EditCaseStudy::route('/{record}/edit'),
        ];
    }
}
