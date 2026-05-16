<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ExportStatic extends Command
{
    protected $signature = 'static:export';
    protected $description = 'Export site as static HTML for Vercel';

    public function handle()
    {
        $port = 8899;
        $baseUrl = "http://localhost:$port";

        $this->info('Building assets...');
        passthru('npm run build', $exitCode);
        if ($exitCode !== 0) {
            $this->error('npm run build failed');
            return 1;
        }

        $this->info('Starting dev server...');
        $process = proc_open("php artisan serve --port=$port 2>&1", [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ], $pipes);

        if (!$process) {
            $this->error('Failed to start dev server');
            return 1;
        }

        sleep(3);

        $pages = [
            '/' => 'index.html',
            '/about' => 'about/index.html',
            '/projects' => 'projects/index.html',
            '/certificates' => 'certificates/index.html',
        ];

        $outputDir = base_path('static');

        $failed = false;
        foreach ($pages as $uri => $path) {
            $this->line("  Fetching $uri...");
            $response = Http::timeout(10)->get("$baseUrl$uri");

            if (!$response->successful()) {
                $this->warn("  Failed to fetch $uri (status: {$response->status()})");
                $failed = true;
                continue;
            }

            $filePath = "$outputDir/$path";
            @mkdir(dirname($filePath), 0755, true);
            file_put_contents($filePath, $response->body());
            $this->info("  Saved static/$path");
        }

        $this->info('Copying public assets...');
        $this->copyDir(public_path('build'), "$outputDir/build");
        if (is_dir(public_path('images'))) {
            $this->copyDir(public_path('images'), "$outputDir/images");
        }
        foreach (['favicon.ico', 'robots.txt'] as $file) {
            $src = public_path($file);
            if (file_exists($src)) {
                copy($src, "$outputDir/$file");
            }
        }

        $this->info('Stopping dev server...');
        proc_terminate($process);
        proc_close($process);

        if ($failed) {
            $this->warn('Some pages failed, check output above.');
            return 1;
        }

        $this->info('Static export complete! Output in: static/');
        $this->line('Deploy: cd static && vercel --prod');
    }

    private function copyDir(string $src, string $dst): void
    {
        if (!is_dir($src)) return;
        @mkdir($dst, 0755, true);
        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($items as $item) {
            $target = $dst . '/' . $items->getSubPathname();
            if ($item->isDir()) {
                @mkdir($target, 0755, true);
            } else {
                copy($item, $target);
            }
        }
    }
}
