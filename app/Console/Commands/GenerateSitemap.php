<?php

namespace App\Console\Commands;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Spatie\Sitemap\Sitemap;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\SitemapGenerator;


class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $sitemapPath = public_path('sitemap.xml');

        $sidemap = Sitemap::create();

        //home
        $sidemap->add(route('home'), now(), '1.0', 'monthly');

        //about
        $sidemap->add(route('about'), now(), '0.9', 'monthly');

        //contact
        $sidemap->add(route('contact-us'), now(), '0.9', 'monthly');

        //terms
        $sidemap->add(route('terms'), now(), '0.9', 'monthly');

        //privacy
        $sidemap->add(route('privacy-policy'), now(), '0.9', 'monthly');

        //blog
        $sidemap->add(route('blog'), now(), '0.9', 'monthly');



        //posts
        foreach (Post::all() as $post) {
            $sidemap->add(url('/blog/'.$post->slug), $post->updated_at, '0.9', 'monthly');
        }



        $sidemap->writeToFile($sitemapPath);



            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/sitemap.log'),
              ])->info('Sitemap generated successfully.');
    }
}
