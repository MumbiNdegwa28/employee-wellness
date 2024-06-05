<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'title' => 'How to manage your mental health | Leon Taylor | TEDxClapham',
            'description' => 'Prolonged psychological stress is the enemy of our mental health, and physical movement is our best weapon to respond.',
            'url' => 'https://www.youtube.com/watch?v=rkZl2gsLUp4',
        ]);
        Video::create([
            'title' => 'How to make work-life balance work | Nigel Marsh',
            'description' => 'Work-life balance, says Nigel Marsh, is too important to be left in the hands of your employer. At TEDxSydney, Marsh lays out an ideal day balanced between family time, personal time and productivity and offers some stirring encouragement to make it happen.',
            'url' => 'https://www.youtube.com/watch?v=jdpIKXLLYYM',
        ]);
        Video::create([
            'title' => '"I am Fine" - Learning To Live With Depression',
            'description' => 'Jake is 31 and lives with Depression. Last year Jake embarked on a journey to manage his mental health in a new way, through exercise, sharing and the great outdoors.',
            'url' => 'https://www.youtube.com/watch?v=IDPDEKtd2yM&rco=1',
        ]);
        Video::create([
            'title' => 'How to Overcome Workplace Anxiety and Stress',
            'description' => 'This video talks about stress and anxiety in the workplace. In order to overcome stress and anxiety in the workplace, it is SO important to accurately identify the specific stressor within work, as opposed to assuming that work itself is the problem. ',
            'url' => 'https://www.youtube.com/watch?v=YsuqNzutgTA',
        ]);
}
}