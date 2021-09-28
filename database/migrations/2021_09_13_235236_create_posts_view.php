<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePostsView extends Migration
{
    public function up(): void
    {
        DB::statement(file_get_contents(database_path('views\followedPosts.sql')));
    }

    public function down(): void
    {
        DB::statement("DROP VIEW followed_posts_view");
    }
}
