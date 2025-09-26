<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\DB;

class TestOrderingSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:ordering-system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the ordering system functionality';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('🧪 Testing Ordering System...');
        $this->newLine();

        // Test 1: Database Structure
        $this->info('1. Testing Database Structure:');
        $this->testDatabaseColumns();
        $this->newLine();

        // Test 2: Models
        $this->info('2. Testing Models:');
        $this->testModels();
        $this->newLine();

        // Test 3: Controllers
        $this->info('3. Testing Controllers:');
        $this->testControllers();
        $this->newLine();

        // Test 4: Routes
        $this->info('4. Testing Routes:');
        $this->testRoutes();
        $this->newLine();

        // Test 5: Ordering Functionality
        $this->info('5. Testing Ordering Functionality:');
        $this->testOrderingFunctionality();
        $this->newLine();

        $this->info('✅ Ordering System Test Complete!');
    }

    private function testDatabaseColumns()
    {
        $tables = [
            'project_categories' => 'sort_order',
            'projects' => 'sort_order', 
            'project_images' => 'sort_order'
        ];

        foreach ($tables as $table => $column) {
            try {
                $columns = DB::select("SHOW COLUMNS FROM {$table} LIKE '{$column}'");
                if (count($columns) > 0) {
                    $this->line("   ✅ {$table}.{$column} exists");
                } else {
                    $this->error("   ❌ {$table}.{$column} missing");
                }
            } catch (\Exception $e) {
                $this->error("   ❌ {$table}.{$column} check failed: " . $e->getMessage());
            }
        }
    }

    private function testModels()
    {
        try {
            $category = ProjectCategory::first();
            if ($category) {
                $this->line("   ✅ ProjectCategory model works - Found: {$category->name}");
                $this->line("      Sort order: " . ($category->sort_order ?? 'NULL'));
            } else {
                $this->warn("   ⚠️  No ProjectCategory found in database");
            }
        } catch (\Exception $e) {
            $this->error("   ❌ ProjectCategory model failed: " . $e->getMessage());
        }

        try {
            $project = Project::first();
            if ($project) {
                $this->line("   ✅ Project model works - Found: {$project->title}");
                $this->line("      Sort order: " . ($project->sort_order ?? 'NULL'));
            } else {
                $this->warn("   ⚠️  No Project found in database");
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Project model failed: " . $e->getMessage());
        }
    }

    private function testControllers()
    {
        try {
            $categoryController = new \App\Http\Controllers\Admin\ProjectCategoryController();
            $this->line("   ✅ ProjectCategoryController loaded");
        } catch (\Exception $e) {
            $this->error("   ❌ ProjectCategoryController failed: " . $e->getMessage());
        }

        try {
            $projectController = new \App\Http\Controllers\Admin\ProjectController();
            $this->line("   ✅ ProjectController loaded");
        } catch (\Exception $e) {
            $this->error("   ❌ ProjectController failed: " . $e->getMessage());
        }
    }

    private function testRoutes()
    {
        $routes = [
            'admin.projectcategory.update-order',
            'admin.projects.update-order',
            'admin.projects.images.update-order'
        ];

        foreach ($routes as $routeName) {
            try {
                $url = route($routeName);
                $this->line("   ✅ Route '{$routeName}' exists: {$url}");
            } catch (\Exception $e) {
                $this->error("   ❌ Route '{$routeName}' failed: " . $e->getMessage());
            }
        }
    }

    private function testOrderingFunctionality()
    {
        try {
            // Test if we can update sort_order
            $category = ProjectCategory::first();
            if ($category) {
                $originalOrder = $category->sort_order;
                $category->update(['sort_order' => 999]);
                $category->refresh();
                
                if ($category->sort_order == 999) {
                    $this->line("   ✅ Sort order update works");
                    // Restore original order
                    $category->update(['sort_order' => $originalOrder]);
                } else {
                    $this->error("   ❌ Sort order update failed");
                }
            } else {
                $this->warn("   ⚠️  No categories to test ordering");
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Ordering functionality test failed: " . $e->getMessage());
        }
    }
}
