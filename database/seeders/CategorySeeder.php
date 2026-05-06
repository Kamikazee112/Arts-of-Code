<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Achievement;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Graphs',
                'slug' => 'graphs',
                'description' => 'Learn graph algorithms, traversal, and problem-solving techniques',
            ],
            [
                'name' => 'Trees',
                'slug' => 'trees',
                'description' => 'Master tree data structures, binary trees, and tree algorithms',
            ],
            [
                'name' => 'Data Structures',
                'slug' => 'data-structures',
                'description' => 'Understand fundamental data structures and their applications',
            ],
            [
                'name' => 'Math',
                'slug' => 'math',
                'description' => 'Learn mathematical concepts and problem-solving strategies',
            ],
            [
                'name' => 'Dynamic Programming',
                'slug' => 'dynamic-programming',
                'description' => 'Master DP techniques for optimization problems',
            ],
            [
                'name' => 'Number Theory',
                'slug' => 'number-theory',
                'description' => 'Explore number theory concepts and algorithms',
            ],
            [
                'name' => 'Brute Force',
                'slug' => 'brute-force',
                'description' => 'Learn brute force approaches and optimization techniques',
            ],
            [
                'name' => 'Greedy',
                'slug' => 'greedy',
                'description' => 'Understand greedy algorithms and their applications',
            ],
            [
                'name' => 'Bitmasks',
                'slug' => 'bitmasks',
                'description' => 'Master bitmask techniques for efficient problem solving',
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            // Create or update achievement for completing this category
            Achievement::updateOrCreate(
                ['category_id' => $category->id],
                [
                    'name' => "{$category->name} Master",
                    'description' => "Complete all articles and exams in {$category->name}",
                    'icon' => '🏆',
                    'category_id' => $category->id,
                ]
            );
        }
    }
}
