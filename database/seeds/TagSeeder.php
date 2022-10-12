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
        $tags = ['calcio','basket','formula 1','film internazionali','cronaca nera', 'politica', 'abiti da sera', 'prova costume', 'Videogiochi', 'Console', 'Serie Tv', 'Film', 'personaggi famosi'];

        foreach ($tags as $tag) {
            $newTags = new Tag();
            $newTags->name = $tag;
            $newTags->slug = Str::slug($tag);
            $newTags->save();
        }
    }
}
