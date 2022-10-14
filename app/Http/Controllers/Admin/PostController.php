<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();//istanzio posts riempendolo con i dati prelevati dal Model Post
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4|max:255',
            'description' => 'required|max:65535',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image|max:6000'
        ],
        [
            'image.image' => 'IL formato dell\'immagine non è valido!'
        ]
    );

        $data = $request->all();

        $img_path = Storage::put('cover', $data['image']);

        $data['cover'] = $img_path;

        $newPost = new Post();
        $newPost->fill($data);

        $slug = $this->calcSlug($newPost->title);

        $newPost->slug = $slug;

        $newPost->save();

        if(array_key_exists('tags', $data)){//se non selezioniamo nessuna check, il post viene salvato allo stesso modo senza dare errore
            $newPost->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Hai creato un post correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
            $request->validate([
                'title' => 'required|min:4|max:255',
                'description' => 'required|max:65535',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'exists:tags,id',
                'image' => 'nullable|image|max:6000'
            ],
            [
                'image.image' => 'IL formato dell\'immagine non è valido!'
            ]
        );
        $data = $request->all();

        if(array_key_exists('image', $data)){

            if($post->cover){
                Storage::delete($post->cover);
            }


            $img_path = Storage::put('cover', $data['image']);
            $data['cover'] = $img_path;
        }

        if($post->title !== $data['title']){
            $data['slug'] = $this->calcSlug($data['title']);
        }

        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }
        return redirect()->route('admin.posts.show', compact('post'))->with('warning', 'Hai modificato il post correttamente');
    }


    protected function calcSlug($title){
        $slug = Str::slug($title, '-');//metodo che converto in una stringa

        $checkPost = Post::where('slug', $slug)->first();//guarda se quel slug è gia presente

        $counter = 1;

        while($checkPost){
            $slug = Str::slug($title, '-' . $counter . '-');
            $counter++;
            $checkPost = Post::where('slug', $slug)->first();
        }
        return $slug;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover){
            Storage::delete($post->cover);
        }
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('danger', 'Hai eliminato il post correttamente');
    }
}
