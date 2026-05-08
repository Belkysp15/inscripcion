<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionResource\Pages;
use App\Models\Inscripcion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InscripcionResource extends Resource
{
    protected static ?string $model = Inscripcion::class;

    // Configuración visual del panel UNESR
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Listas por Materia';
    protected static ?string $modelLabel = 'Inscripción';
    protected static ?string $pluralModelLabel = 'Inscripciones';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // INTERRUPTOR PARA VALIDAR PLANILLA FÍSICA
                Tables\Columns\ToggleColumn::make('validado')
                    ->label('VALIDAR')
                    ->onColor('success')
                    ->offColor('danger'),

                // CÉDULA CON BÚSQUEDA
                Tables\Columns\TextColumn::make('cedula')
                    ->label('CÉDULA')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                // ESTUDIANTE CON BÚSQUEDA Y MAYÚSCULAS
                Tables\Columns\TextColumn::make('nombre_apellido')
                    ->label('ESTUDIANTE')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => strtoupper($state))
                    ->description(fn (Inscripcion $record): string => "REGISTRADO: " . $record->created_at->format('d/m/Y h:i A')),

                // MATERIA (Aquí activamos la búsqueda por nombre de materia)
                Tables\Columns\TextColumn::make('materia.nombre')
                    ->label('MATERIA')
                    ->badge()
                    ->color('primary')
                    ->searchable() // <-- AHORA PUEDES BUSCAR "ESFERA" EN LA LUPA
                    ->sortable(),

                // CÓDIGO DE SEGURIDAD ANTI-FALSIFICACIÓN
                Tables\Columns\TextColumn::make('codigo_verificacion')
                    ->label('CÓDIGO CUR')
                    ->fontFamily('mono')
                    ->weight('black')
                    ->color('info')
                    ->icon('heroicon-m-shield-check')
                    ->copyable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // FILTRO DE EMBUDO (DERECHA)
                SelectFilter::make('materia_id')
                    ->relationship('materia', 'nombre')
                    ->label('FILTRAR POR MATERIA')
                    ->preload(),
                
                // FILTRO PARA VER QUIÉN FALTA POR ENTREGAR PAPELES
                Tables\Filters\TernaryFilter::make('validado')
                    ->label('ESTADO DE VALIDACIÓN')
                    ->placeholder('TODOS')
                    ->trueLabel('VALIDADOS')
                    ->falseLabel('PENDIENTES'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('ANULAR')
                    ->modalHeading('¿ELIMINAR REGISTRO Y LIBERAR CUPO?')
                    ->successNotificationTitle('CUPO LIBERADO CORRECTAMENTE'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // BOTÓN PARA BELKIS (DESCARGAR EXCEL PARA EL SGA)
                    ExportBulkAction::make()
                        ->label('DESCARGAR EXCEL (SGA)')
                        ->icon('heroicon-o-document-arrow-down'),
                    
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscripcions::route('/'),
        ];
    }
}
