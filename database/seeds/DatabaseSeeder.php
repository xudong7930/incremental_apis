<?php

use App\Lesson;
use App\LessonTag;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $tables = [
        'users', 'tags', 'lesson', 'lesson_tag'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->clearDatabase();
        factory(Lesson::class, 60)->create();
        factory(Tag::class, 60)->create();
        factory(LessonTag::class, 30)->create();
        factory(User::class, 1)->create();
    }

    protected function clearDatabase()
    {
        \DB::statment('SET FOREIGN_KEY_CHECKS=0');
        foreach($this->tables as $table) {
            \DB::table($table)->truncate();
        }
        \DB::statment('SET FOREIGN_KEY_CHECKS=1');
    }
}
