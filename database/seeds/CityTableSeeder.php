<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\City::class, 5)->create()->each(function (\App\City $city) {
            $max = rand(0, 5);
            if ($max) {
                for ($i = 0; $i < $max; $i++) {
                    $training = factory(\App\Training::class)->make();
                    $city->trainings()->save($training);

                    $m2 = rand(0, 5);
                    factory(\App\Order::class, $m2)->create(['training_id' => $training->id]);
                }
            }

            $max = rand(0, 5);
            if ($max) {
                for ($i = 0; $i < $max; $i++) {
                    $training = factory(\App\Training::class)->make();
                    $training->type = 1;
                    $city->trainings()->save($training);

                    $m2 = rand(0, 5);
                    factory(\App\Order::class, $m2)->create(['training_id' => $training->id]);
                }
            }
        });
    }
}
