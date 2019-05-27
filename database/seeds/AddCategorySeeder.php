<?php

use Illuminate\Database\Seeder;

class AddCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategory(2);
    }

    private function createCategory($step = 0, $parent_path = false)
    {
        factory(\App\Models\Category::class, rand(1,5))->create([
            'path' => !$parent_path ?: $parent_path
        ])->each(function ($u) use ($step, $parent_path){
            $u->path = !$parent_path ? $u->id : $parent_path.'.'.(string)$u->id;
            $u->save();
            $u->products()->saveMany(factory(\App\Models\Product::class, rand(10,20))->make());
            if($step-- > 0) $this->createCategory($step, $u->path);
        });
    }
}
