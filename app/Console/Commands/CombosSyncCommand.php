<?php

namespace App\Console\Commands;

use App\Models\Combo;
use Illuminate\Console\Command;

class CombosSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'combos:sync
                            {--dry-run : Previsualizar cambios sin escribir en la BD}
                            {--prune : Eliminar combos que ya no existen en la fuente de datos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza contenido de combos desde la fuente de datos sin sobrescribir imágenes ni estado activo.';

    /**
     * Campos protegidos que NUNCA se sobrescriben desde este comando.
     * Estos campos son gestionados exclusivamente desde el panel admin.
     */
    private const PROTECTED_FIELDS = ['image', 'image_url', 'is_active'];

    /**
     * Fuente de datos oficial de combos.
     * Edita aquí para actualizar nombres, descripciones y precios.
     */
    private function sourceData(): array
    {
        return [
            [
                'name'         => 'Combo Bocaditos',
                'description'  => 'Lleva 30 deliciosas empanadas tradicionales en tamaño BOCADO. Disfrutalas acompañadas de aji criollo y nuestra espectacular salsa casera tipo chimichurri. Perfectas para compartir en familia o con amigos. ¡Pide tu domicilio ahora y disfruta de esta delicia en casa! 🏡🛵😎',
                'price'        => 35000,
                'is_featured'  => true,
                'sort_order'   => 1,
                'size'         => 'bocado',
            ],
            [
                'name'         => 'Combo Mini Pastelitos de Yuca',
                'description'  => 'COMBO PASTELITOS DE YUCA*📢 Recibe en la comodidad de tu casa 🏡  20 deliciosos y calientitos mini  pastelitos de yuca 😋 acompañados de ají criollo y salsa casera tipo chimichurri. Haz tu pedido ahora🛵🛵',
                'price'        => 35000,
                'is_featured'  => true,
                'sort_order'   => 2,
                'size'         => 'bocado',
            ],
            [
                'name'         => 'Combo Baby Arepitas',
                'description'  => 'Disfruta de 20 deliciosas arepitas de huevo de codorniz trifasicas, con pollo desmechado y carne molida. ¡Que mejor compañía que nuestra salsa casera y aji criollo para esta pequeñas arepas!',
                'price'        => 35000,
                'is_featured'  => true,
                'sort_order'   => 3,
                'size'         => 'bocado',
            ],
            [
                'name'         => 'Combo Tradicional',
                'description'  => '12 crujientes y deliciosas empanadas vallunas 🤤 con aji criollo🥵 y salsa casera tipo chimichurri😏. Disfruta esta delicia en casa🏡, calientitas y crujientes 🛵 pide tu domicilio ahora 😎',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 4,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Vegetarianas',
                'description'  => 'Deliciosas empanadas vegetarianas😋 hechas en cubierta de harina trigo rellenas de espinaca 🥬, maíz dulce 🌽, queso, tomate 🍅 y ajo🧄. Una opción diferente y deliciosa😏. Animate a probar!!! Haz tu pedido',
                'price'        => 30000,
                'is_featured'  => false,
                'sort_order'   => 6,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Arepa Trífasica',
                'description'  => 'Disfruta de 8 crujientes arepas de huevo 🍳trifasicas con 🍗pollo desmechado y 🥩 carne molida. Las llevamos calientitas a domicilio 🛵. Las entregamos con aji criollo 🥵 y salsa casera tipo chimichurri 😏. Que esperas? ',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 10,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Megacombo',
                'description'  => '⚠️ 6 crujientes y deliciosas😋 empanadas tradicionales y 4 arepas de huevo 🍳 trifasicas con pollo 🍗 desmechado y carne 🥩 desmechada. Se preparan  y salen calientitos para despacho 🏍️. Los entregamos con aji criollo 🥵y salsa casera tipo chimichurri 😏',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 5,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Pipian',
                'description'  => 'Deliciosas receta vegetariana ancestral colombiana. Animate y pide 10 empanaditas de pipian',
                'price'        => 20000,
                'is_featured'  => false,
                'sort_order'   => 7,
                'size'         => 'bocado',
            ],
            [
                'name'         => 'Combo Cerpincho',
                'description'  => 'COMBO CERPINCHO🐷  3 deliciosos pinchos 🍢con chicharroncito carnudito  con papa salada, jugosa carne de cerdo y plátano maduro delicioso💯. Acompañados de ají criollo y nuestra infaltable salsa casera tipo chimichurri',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 8,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'MegaBocado',
                'description'  => '‼️Todo lo que te gusta de Bocaditos Criollos en un solo combo ✅ lleva 5 empanadas tradicionales 😋 2 arepas de huevo🍳 trifasicas con pollo 🍗 y carne molida y 2 empanadas vegetarianas con espinaca 🥬, maiz dulce 🌽 y queso 🧀. Todo esto llega a la puerta de tu casa 🏡 con aji criollo 🥵 y salsa casera tipo chimichurri 😏. Haz tu pedido 🪀!!!',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 9,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Valluno',
                'description'  => '⚠️⚠️COMBO VALLUNO⚠️⚠️ Disfruta de 4 crujientes empanadas rellenas de papa 🥔 y carne desmechada🥩, 4 marranitas 🐷(patacon relleno chicharron) y 2 avenas caleñas🧊 en empaque pet sellado de 250ml. Te las llevamos a 🏡 con aji criollo 🥵 y salsa casera tipo chimichurri 😏. Que esperas? Haz tu pedido ahora',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 11,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Combo Marranitas',
                'description'  => 'Disfruta de esta delicia valluna ‼️COMBO MARRANITAS‼️
                 💯Deliciosas bolitas de plátano verde rellenas del crujiente chicharrón🤤. Y siempre es mejor acompañadas de aji criollo y nuestra exquisita salsa casera tipo chimichurri.',
                'price'        => 30000,
                'is_featured'  => false,
                'sort_order'   => 12,
                'size'         => 'tradicional',
            ],
            [
                'name'         => 'Avena Caleña',
                'description'  => 'Deliciosa avena helada hecha en pura leche, con harina de avena y aliños dulces como canela, clavo de olor y panela. Perfecta para acompañar tus empanadas o simplemente para disfrutarla sola. Pide tu domicilio ahora y disfruta de esta delicia en casa! 🏡🛵😎',
                'price'        => 5500,
                'is_featured'  => false,
                'sort_order'   => 13,
                'size'         => 'adiciones',
            ],            [
                'name'         => 'Masato de Arroz frio',
                'description'  => 'Deliciosa receta de masato de arroz tradicional Bien frio',
                'price'        => 5500,
                'is_featured'  => false,
                'sort_order'   => 14,
                'size'         => 'adiciones',
            ],
            [
                'name'         => 'Combo Tolimense',
                'description'  => '12 Crujientes empanadas de maíz, rellenas de puré de papa con riogo y trozos de pollo desmechado, acompañadas de aji criollo y salsa casera tipo chimichurri. Pide tu domicilio ahora y disfruta de esta delicia en casa! 🏡🛵😎',
                'price'        => 35000,
                'is_featured'  => false,
                'sort_order'   => 15,
                'size'         => 'tradicional',
            ],
        ];

    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $source = $this->sourceData();
        $sourceNames = collect($source)->pluck('name')->all();
        $dryRun = $this->option('dry-run');
        $prune = $this->option('prune');

        // ---- Stats ----
        $created = 0;
        $updated = 0;
        $skipped = 0;
        $deleted = 0;

        // ---- Warm up description ----
        $this->line('');
        $this->info(' 🥟  Sincronizando combos...');
        if ($dryRun) {
            $this->warn(' ⚠️  Modo dry-run: no se escribirán cambios en la BD');
        }
        $this->line('');

        // ---- Sync each combo from source ----
        foreach ($source as $data) {
            $name = $data['name'];
            $existing = Combo::where('name', $name)->first();

            if ($existing) {
                // Check if any syncable field actually changed
                $syncFields = $this->syncableFields($data);
                $changed = collect($syncFields)->contains(fn ($value, $field) => $existing->{$field} != $value);

                if (! $changed) {
                    $skipped++;
                    continue;
                }

                // In dry-run mode, just show what would change
                if ($dryRun) {
                    $this->line("   🔄  <comment>{$name}</comment> — se actualizaría");
                    $updated++;
                    continue;
                }

                // Apply only syncable fields — protected fields are STRICTLY excluded
                $existing->update($syncFields);
                $updated++;
            } else {
                // New combo: create with all fields (protected fields will be null by default in DB)
                if ($dryRun) {
                    $this->line("   🆕  <comment>{$name}</comment> — se crearía");
                    $created++;
                    continue;
                }

                Combo::create($this->syncableFields($data));
                $created++;
            }
        }

        // ---- Deletions (only if --prune flag is set) ----
        if ($prune) {
            $toDelete = Combo::whereNotIn('name', $sourceNames)->get();

            foreach ($toDelete as $combo) {
                if ($dryRun) {
                    $this->line("   🗑️  <comment>{$combo->name}</comment> — se eliminaría");
                    $deleted++;
                    continue;
                }

                $combo->delete();
                $deleted++;
            }
        }

        // ---- Summary ----
        $this->newLine();
        $this->table(
            ['', 'Resultado'],
            [
                [$dryRun ? '🔄 Actualizaría' : '✅ Actualizados',  (string) $updated],
                [$dryRun ? '🆕 Crearía'       : '🆕 Creados',      (string) $created],
                ['⏭️  Sin cambios',            (string) $skipped],
            ]
        );

        if ($prune) {
            $this->table(
                ['', 'Resultado'],
                [[$dryRun ? '🗑️ Eliminaría' : '🗑️ Eliminados', (string) $deleted]]
            );
        }

        // ---- Protected fields safety notice ----
        $this->newLine();
        $this->line(' 🔒  <fg=green>Campos protegidos (no se tocaron):</> '.implode(', ', self::PROTECTED_FIELDS));

        if (! $prune) {
            $this->line(' 💡  Usa <comment>--prune</comment> para eliminar combos que ya no están en la fuente.');
        }
        $this->line(' 💡  Usa <comment>--dry-run</comment> para previsualizar sin modificar la BD.');
        $this->newLine();

        return Command::SUCCESS;
    }

    /**
     * Extrae solo los campos sincronizables desde los datos fuente,
     * excluyendo explícitamente los campos protegidos.
     */
    private function syncableFields(array $data): array
    {
        return collect($data)
            ->except(self::PROTECTED_FIELDS)
            ->toArray();
    }
}
