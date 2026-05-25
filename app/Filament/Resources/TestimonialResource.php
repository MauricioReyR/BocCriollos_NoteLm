<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Testimonios';

    protected static ?string $modelLabel = 'Testimonio';

    protected static ?string $pluralModelLabel = 'Testimonios';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Cliente')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Ej: María González'),
                        Forms\Components\TextInput::make('role')
                            ->label('Rol / Profesión')
                            ->maxLength(100)
                            ->placeholder('Ej: Estudiante, Ingeniero...'),
                        Forms\Components\Select::make('rating')
                            ->label('Calificación')
                            ->required()
                            ->options([
                                1 => '⭐',
                                2 => '⭐⭐',
                                3 => '⭐⭐⭐',
                                4 => '⭐⭐⭐⭐',
                                5 => '⭐⭐⭐⭐⭐',
                            ])
                            ->native(false),
                        Forms\Components\Select::make('avatar_emoji')
                            ->label('Avatar (Emoji)')
                            ->options([
                                '😊' => '😊 Feliz',
                                '👩' => '👩 Mujer',
                                '👨' => '👨 Hombre',
                                '👨‍💼' => '👨‍💼 Oficinista',
                                '👩‍🏫' => '👩‍🏫 Profesora',
                                '👨‍🍳' => '👨‍🍳 Chef',
                                '🏃‍♀️' => '🏃‍♀️ Deportista',
                                '👩‍💻' => '👩‍💻 Programadora',
                                '🎨' => '🎨 Artista',
                                '👨‍🎓' => '👨‍🎓 Estudiante',
                                '👩‍🎓' => '👩‍🎓 Estudiante',
                            ])
                            ->default('😊'),
                    ]),

                Forms\Components\Section::make('Testimonio')
                    ->schema([
                        Forms\Components\Textarea::make('text')
                            ->label('Texto del testimonio')
                            ->required()
                            ->maxLength(1000)
                            ->minLength(10)
                            ->rows(4)
                            ->placeholder('Cuéntanos su experiencia en Bocaditos Criollos...'),
                    ]),

                Forms\Components\Section::make('Estado y Orden')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('is_approved')
                            ->label('Aprobado')
                            ->helperText('Si está activo, el testimonio se mostrará en el sitio web.')
                            ->default(false),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->helperText('Números más bajos aparecen primero.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('avatar_emoji')
                    ->label('')
                    ->size('lg')
                    ->alignCenter()
                    ->width('60px'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rol')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Calificación')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        5 => 'success',
                        4 => 'warning',
                        3 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('text')
                    ->label('Testimonio')
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('Aprobado')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_approved')
                    ->label('Estado')
                    ->options([
                        true => '✅ Aprobados',
                        false => '⏳ Pendientes',
                    ]),
                Tables\Filters\SelectFilter::make('rating')
                    ->label('Calificación mínima')
                    ->options([
                        1 => '1 ⭐ o más',
                        2 => '2 ⭐ o más',
                        3 => '3 ⭐ o más',
                        4 => '4 ⭐ o más',
                        5 => '5 ⭐',
                    ])
                    ->query(fn (Builder $query, array $data): Builder =>
                        $query->when(
                            $data['value'],
                            fn (Builder $query, $rating): Builder => $query->where('rating', '>=', $rating),
                        )
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Ver'),
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No hay testimonios')
            ->emptyStateDescription('Crea un testimonio o espera a que los clientes envíen los suyos desde el sitio web.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'view' => Pages\ViewTestimonial::route('/{record}'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $pending = static::getPendingCount();
        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getPendingCount() > 0 ? 'warning' : 'success';
    }

    protected static function getPendingCount(): int
    {
        return Testimonial::where('is_approved', false)->count();
    }


}
