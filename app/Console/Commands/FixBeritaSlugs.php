<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Berita;

class FixBeritaSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'berita:fix-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix missing or empty slugs in berita table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to fix berita slugs...');

        // Get berita with missing or empty slugs
        $beritaWithoutSlugs = Berita::where(function($query) {
            $query->whereNull('slug')->orWhere('slug', '');
        })->get();

        if ($beritaWithoutSlugs->count() === 0) {
            $this->info('No berita found with missing slugs.');
            return;
        }

        $this->info("Found {$beritaWithoutSlugs->count()} berita with missing slugs.");

        $bar = $this->output->createProgressBar($beritaWithoutSlugs->count());
        $bar->start();

        $fixed = 0;
        $errors = 0;

        foreach ($beritaWithoutSlugs as $berita) {
            try {
                $newSlug = Berita::generateUniqueSlug($berita->judul, $berita->id);
                $berita->update(['slug' => $newSlug]);
                $fixed++;
                $this->line("\nFixed: '{$berita->judul}' -> '{$newSlug}'");
            } catch (\Exception $e) {
                $errors++;
                $this->error("\nError fixing berita ID {$berita->id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine();
        $this->info("Slug fixing completed!");
        $this->info("Fixed: {$fixed}");

        if ($errors > 0) {
            $this->error("Errors: {$errors}");
        }

        // Check for duplicate slugs
        $this->info('Checking for duplicate slugs...');
        $duplicates = Berita::selectRaw('slug, COUNT(*) as count')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->groupBy('slug')
            ->having('count', '>', 1)
            ->get();

        if ($duplicates->count() > 0) {
            $this->warn("Found {$duplicates->count()} duplicate slugs:");
            foreach ($duplicates as $duplicate) {
                $this->line("- '{$duplicate->slug}' appears {$duplicate->count} times");
            }

            // Fix duplicates
            $this->info('Fixing duplicate slugs...');
            foreach ($duplicates as $duplicate) {
                $beritasWithDuplicateSlug = Berita::where('slug', $duplicate->slug)->get();
                // Skip the first one, fix the rest
                foreach ($beritasWithDuplicateSlug->skip(1) as $berita) {
                    $newSlug = Berita::generateUniqueSlug($berita->judul, $berita->id);
                    $berita->update(['slug' => $newSlug]);
                    $this->line("Fixed duplicate: '{$berita->judul}' -> '{$newSlug}'");
                }
            }
        } else {
            $this->info('No duplicate slugs found.');
        }

        $this->info('All done!');
    }
}
