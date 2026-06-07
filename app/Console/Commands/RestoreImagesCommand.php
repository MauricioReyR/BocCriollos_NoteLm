<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RestoreImagesCommand extends Command
{
    protected $signature = 'restore:images
                            {--dry-run : Previsualizar cambios sin escribir en la BD}';

    protected $description = 'Restaura las rutas de imágenes de combos desde los archivos en disco (storage/combos/).';

    private const IMAGE_MAP = [
        'Combo Bocaditos'             => 'combos/YDMToOlZdLpgLkB2P2AEdF1euj5JDtJcXHvY3eCb.jpg',
        'Combo Mini Pastelitos de Yuca' => 'combos/PG2QKLApSXzfx5r2ImFRvgI7RTRL73eRh7fXtd4I.jpg',
        'Combo Baby Arepitas'         => 'combos/7JGNwF87V1jhYA6BnXM5L5cXLuimAaQ0pyhunyQV.jpg',
        'Combo Tradicional'           => 'combos/DRnuSAoezjBIncugnjidXpgELYrsRJjq1q0mXOu0.jpg',
        'Combo Vegetarianas'          => 'combos/h26FiVclEFZraJhqVbVgGp1rXT5mXYTDcDPANQfJ.jpg',
        'Combo Arepa Trífasica'       => 'combos/CEScFjP4qWq3MLtHGLfpXNTqkSp7cz8tddu0CY14.jpg',
        'Megacombo'                   => 'combos/LWfwLYPtnnbnD7G9fPqJQYhiGFVcazD355fUclKM.jpg',
        'Combo Pipian'                => 'combos/Pipian.jpeg',
        'Combo Cerpincho'             => 'combos/DvSCd34b6vCErydO1cLvMRmGsVdRedR5dDncfwgd.jpg',
        'MegaBocado'                  => 'combos/cIgCuUcMLezUvOijt2JGXbjSexufJ67c1HqJCTcJ.jpg',
        'Combo Valluno'               => 'combos/dOjGC9d5VVhrq7vrLNHn70e9FQcgFcRoImn4gXHl.jpg',
        'Combo Marranitas'            => 'combos/Marranitas.jpeg',
        'Avena Caleña'                => 'combos/47H0XOI7VIeBb6IIwjcPzfVhZ1GAYW2PosWBVJz2.jpg',
        'Masato de Arroz frio'        => 'combos/j4WAVQKWihDpNs03b7DFsouDxmlztQj4O9qYgA1o.jpg',
        'Combo Tolimense'             => 'combos/Tolimenses.jpeg',
    ];

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $storagePath = public_path('storage');

        if (! is_dir($storagePath)) {
            $this->error('El enlace simbólico public/storage no existe. Ejecuta: php artisan storage:link');
            return Command::FAILURE;
        }

        $this->line('');
        $this->info(' 🖼️  Restaurando imágenes de combos...');
        if ($dryRun) {
            $this->warn(' ⚠️  Modo dry-run: no se escribirán cambios en la BD');
        }
        $this->line('');

        $restored = 0;
        $skipped = 0;
        $missing = 0;

        foreach (self::IMAGE_MAP as $name => $relativePath) {
            $fullPath = public_path("storage/{$relativePath}");
            $urlPath = "/storage/{$relativePath}";

            $combo = DB::table('combos')->where('name', $name)->first();

            if (! $combo) {
                $this->warn("   ⚠️  <comment>{$name}</comment> — no encontrado en la BD");
                $missing++;
                continue;
            }

            if (! file_exists($fullPath)) {
                $this->warn("   ⚠️  <comment>{$name}</comment> — archivo no encontrado: {$relativePath}");
                $missing++;
                continue;
            }

            // Check if already correct
            if ($combo->image_url === $urlPath && $combo->image === $relativePath) {
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $this->line("   🔄  <comment>{$name}</comment> — se actualizaría → {$urlPath}");
                $restored++;
                continue;
            }

            DB::table('combos')
                ->where('id', $combo->id)
                ->update([
                    'image'     => $relativePath,
                    'image_url' => $urlPath,
                ]);

            $this->line("   ✅  <comment>{$name}</comment> → {$urlPath}");
            $restored++;
        }

        // Summary
        $this->newLine();
        $this->table(
            ['', 'Resultado'],
            [
                [$dryRun ? '🔄 Actualizaría' : '✅ Restaurados', (string) $restored],
                ['⏭️  Sin cambios',                              (string) $skipped],
                ['⚠️  No encontrados',                           (string) $missing],
            ]
        );

        if ($dryRun && $restored > 0) {
            $this->line(' 💡  Ejecuta sin --dry-run para aplicar los cambios.');
        }

        $this->newLine();

        return Command::SUCCESS;
    }
}
