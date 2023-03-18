<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Filament\Resources\AuthorResource\RelationManagers\PostsRelationManager;
use App\Models\Author;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Blog';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('name'))
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->label(__('email'))
                        ->required()
                        ->email()
                        ->unique(Author::class, 'email', fn ($record) => $record),
                    Forms\Components\FileUpload::make('photo')
                        ->label(__('photo'))
                        ->image()
                        ->disk(config('filament-blog.avatar.disk', 'public'))
                        ->maxSize(config('filament-blog.avatar.maxSize', 5120))
                        ->directory(config('filament-blog.avatar.directory', 'blog'))
                        ->columnSpan([
                            'sm' => 2,
                        ]),
                    //self::getContentEditor('bio'),
                    RichEditor::make('bio')->required()->columnSpan(2),
                    Forms\Components\TextInput::make('github_handle')
                        ->label(__('github')),
                    Forms\Components\TextInput::make('twitter_handle')
                        ->label(__('twitter')),
                ])
                ->columns([
                    'sm' => 2,
                ])
                ->columnSpan(2),
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Placeholder::make('created_at')
                        ->label(__('created_at'))
                        ->content(fn (
                            ?Author $record
                        ): string => $record ? $record->created_at->diffForHumans() : '-'),
                    Forms\Components\Placeholder::make('updated_at')
                        ->label(__('last_modified_at'))
                        ->content(fn (
                            ?Author $record
                        ): string => $record ? $record->updated_at->diffForHumans() : '-'),
                ])
                ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('photo')
                    ->label(__('photo'))
                    ->rounded(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('email'))
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('github_handle')
                    ->label(__('github')),
                Tables\Columns\TextColumn::make('twitter_handle')
                    ->label(__('twitter')),
            ])
            ->filters([
                //
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
            PostsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'view' => Pages\ViewAuthor::route('/{record}'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }    
}
