<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        for ($i=0; $i < 10; $i++) {
            \App\Models\Comment::create([
            'nickname'   => 'Bob',
            'email'    => '454592733@qq.com',
            'website' => 'www.baidu.com',
            'content' => 'test-'.$i,
            'article_id' => '2'
        ]);
        }
    }
}
