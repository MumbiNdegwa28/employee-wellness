<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'title' => 'What is mental wellness?',
            'description' => 'Five Key Things to Know about Mental Wellness',
            'url' => 'https://globalwellnessinstitute.org/what-is-wellness/mental-wellness/',
            
        ]);
        Blog::create([
            'title' => '5 steps to Mental Wellbeing',
            'description' => 'Evidence suggests there are 5 steps you can take to improve your mental health and wellbeing. Trying these things could help you feel more positive and able to get the most out of life.',
            'url' => 'https://www.nhs.uk/mental-health/self-help/guides-tools-and-activities/five-steps-to-mental-wellbeing//',
        ]);
        Blog::create([
            'title' => 'Coping with Depression',
            'description' => 'When you are depressed, you cannot just will yourself to “snap out of it.” But these coping strategies can help you deal with depression and put you on the road to recovery.',
            'url' => 'https://www.helpguide.org/articles/depression/coping-with-depression.htm',
        ]);
        Blog::create([
            'title' => 'Your Guide to Managing Workplace Anxiety',
            'description' => 'Do anxious feelings tend to bubble up suddenly while you are at work? ',
            'url' => 'https://www.healthline.com/health/anxiety/workplace-anxiety',
        ]);
        Blog::create([
            'title' => 'Suicide Emergency Numbers and Free Counselling Centers in Kenya',
            'description' => ' In Kenya, various organizations, towards preventing suicide, offer support to people at risk of the same. Below is a list of such organizations and their hotlines.',
            'url' => 'https://www.enableme.ke/en/article/suicide-emergency-numbers-and-free-counselling-centers-in-kenya-3770',
        ]);

    }
}
