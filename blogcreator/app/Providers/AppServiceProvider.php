<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Article;
use App\Comment;
use App\Blog;
use App\Categorie;
use App\Attachments;
use File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::deleted(function($article) {
            $attachments = $article->attachments;
            foreach ($attachments as $attachment) {
                File::delete(public_path() . '/uploads/attachments/' . $attachment->hash);
                $attachment->delete();
            }

            $comments = $article->comments;
            foreach ($comments as $comment) {
                $comment->delete();
            }
        });

        Categorie::deleted(function($categorie) {
            $articles = $categorie->articles;
            foreach ($articles as $article) {
                $article->delete();
            }
        });

        Blog::deleted(function ($blog) {
            $categories = $blog->categories;
            foreach($categories as $categorie) {
                $categorie->delete();
            }

            $articles = $blog->articles;
            foreach($articles as $article) {
                $article->delete();
            }
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
