<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Calcio','Basket','Formula 1','Cronaca nera', 'Politica', 'Moda', 'Profumi', 'Videogiochi', 'Console', 'Serie Tv', 'Film', 'Vip'];

        foreach ($tags as $tag) {
            $newTags = new Tag();
            $newTags->name = $tag;
            $newTags->slug = Str::slug($tag);
            $newTags->save();
        }
    }
}
