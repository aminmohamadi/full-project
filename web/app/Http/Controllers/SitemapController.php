<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Models\Option;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{

    public function index()
    {
        $sitemap = Sitemap::create()->add(Url::create("sitemap-articles")
            ->setLastModificationDate(Carbon::yesterday())
        );

        $sitemap->add(Url::create("sitemap-about-us")
            ->setLastModificationDate(Carbon::yesterday())
        );
        $sitemap->add(Url::create("sitemap-services")
            ->setLastModificationDate(Carbon::yesterday())
        );
        $sitemap->add(Url::create("sitemap-projects")
            ->setLastModificationDate(Carbon::yesterday())
        );
//        $sitemap->writeToDisk('public','sitemap.xml');
        $sitemap->render();
        return $sitemap;


    }

    public function articles()
    {
        $sitemap = Sitemap::create();
        foreach (Option::all() as $item) {
            $sitemap->add(Url::create("articles/$item->key")
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8));
        }
        $sitemap->render();
        return $sitemap;
    }


    public function services()
    {
        $sitemap = Sitemap::create();
        foreach (Option::all() as $item) {
            $sitemap->add(Url::create("services/$item->key")
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8));
        }
        $sitemap->render();
        return $sitemap;
    }

    public function projects()
    {
        $sitemap = Sitemap::create();
        foreach (Option::all() as $item) {
            $sitemap->add(Url::create("projects/$item->key")
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8));
        }
        $sitemap->render();
        return $sitemap;
    }
}
