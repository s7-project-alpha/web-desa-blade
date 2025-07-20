<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Berita;
use Illuminate\Support\Str;

class FixBeritaSlug extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'berita:fix-slug';

    /**
     * The console command description.
     */
    protected $description = 'Fix missing or empty slugs for existing berita';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing berita slugs...');

        $beritaWithoutSlug = Berita::whereNull('slug')->orWhere('slug', '')->get();

        if ($beritaWithoutSlug->isEmpty()) {
            $this->info('All berita already have valid slugs.');
            return;
        }

        $bar = $this->output->createProgressBar($beritaWithoutSlug->count());
        $bar->start();

        foreach ($beritaWithoutSlug as $berita) {
            $slug = Berita::generateUniqueSlug($berita->judul, $berita->id);
            $berita->update(['slug' => $slug]);
            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info("Fixed {$beritaWithoutSlug->count()} berita slugs successfully!");
    }
}
