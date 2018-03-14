<?php

use App\Models\User;
use App\Models\UserImage;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class TestHostPropertiesSeeder extends Seeder
{

    private $property_count = 2;

    private $total_countries;

    // Faker\Factory
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $this->total_countries = count(  \Helper::readJSON( base_path() . '/countries.json' ) );
        $host = User::where('username', 'testhost')->first();
        $this->deletePropertyData($host);
        $this->createHostProperties($host);

    }

    public function deletePropertyData(User $host)
    {
        $properties = $host->properties()->get();
        if( $properties ){
            foreach($properties as $property) {
                $images = $property->images()->get();
                if( $images ) {
                    foreach($images as $image ){
                        $image->delete();
                    }
                }
                $property->delete();
            }
        }
    }

    public function createHostProperties(User $host)
    {
        $this->command->info('Creating host properties');
        $properties = factory(Property::class, $this->property_count)->make();
        $host->properties()
            ->saveMany( $properties )
            ->each( function($property){
                $this->assignPropertyImages($property);
            });
        $this->command->info('done');
        
    }

    public function assignPropertyImages(Property $property)
    {
        $user_id = $property->user->id;
        $user_images = UserImage::inRandomOrder()
        ->where('user_id', $user_id)
        ->take(5)
        ->get();

        $images = [];
        $ctr = 0;
        foreach( $user_images as $image ){
            $tmp['title'] = pathinfo($image['filename'], PATHINFO_FILENAME);
            $tmp['description'] = $this->faker->words(rand(1,3), true);
            $tmp['sort_order'] = $ctr;
            $tmp['user_image_id'] = $image['id'];

            $images[] = new PropertyImage($tmp);
            $ctr++;
        }

        $property->images()->saveMany($images);
    }
}
