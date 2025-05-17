<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YearbookPlatform;
use Illuminate\Support\Facades\DB;

class YearbookPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample yearbook platforms
        $platforms = [
            [
                'year' => 2023,
                'name' => 'Blazer 2023 Yearbook',
                'theme_title' => 'Celebrating Excellence',
                'status' => 'archived',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'year' => 2024,
                'name' => 'Blazer 2024 Yearbook',
                'theme_title' => 'New Horizons',
                'status' => 'archived',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'year' => 2025,
                'name' => 'Blazer 2025 Yearbook',
                'theme_title' => 'Building Tomorrow',
                'status' => 'active',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // First, make sure all platforms are set to inactive to avoid conflicts
        DB::table('yearbook_platforms')->update(['is_active' => false]);

        foreach ($platforms as $platform) {
            // Check if the platform already exists by year
            $exists = DB::table('yearbook_platforms')
                ->where('year', $platform['year'])
                ->exists();
                
            if ($exists) {
                // Update the existing platform
                DB::table('yearbook_platforms')
                    ->where('year', $platform['year'])
                    ->update($platform);
                    
                $this->command->info("Updated yearbook platform: {$platform['name']} ({$platform['year']})");
            } else {
                // Create a new platform
                DB::table('yearbook_platforms')->insert($platform);
                $this->command->info("Created yearbook platform: {$platform['name']} ({$platform['year']})");
            }
        }
    }
}
