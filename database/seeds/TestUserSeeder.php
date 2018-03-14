<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserImage;
use App\Libs\Copier;

class TestUserSeeder extends Seeder
{
    private $host_images_count = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->willDeleteOldData();
        $this->createAdmin();
        $this->createHost();
        $this->createUser();
    }

    public function willDeleteOldData()
    {
        $admin = User::where('username', 'testadmin')->first();
        if( $admin )
            $admin->delete();

        $user = User::where('username', 'testuser')->first();
        if( $user )
            $user->delete();

        $host = User::where('username', 'testhost')->first();
        if( $host ) {
            $this->deleteUserImages($host);
            $this->deletePropertyData($host);
            $host->delete();
        }
            
    }

    public function deleteUserImages(User $user)
    {
        $user_images = $user->images()->get();
        foreach($user_images as $image){
            Storage::delete('media/' . $image->filename);
            $image->delete();
        }
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

    public function createAdmin()
    {
        $this->command->info('Creating test account for admin ...');
        $admin = factory(User::class)->make();
        $admin->username = 'testadmin';
        $admin->email = 'testadmin@admin.com';
        $admin->user_type = 'admin';
        $admin->save();
        $this->command->info('done');
    }

    public function createHost()
    {
        $this->command->info('Creating test account for host ...');
        $host = factory(User::class)->make();
        $host->username = 'testhost';
        $host->email = 'testhost@host.com';
        $host->user_type = 'host';
        $host->save();
        $this->command->info('done');
        
        $this->createHostImages($host);
    }

    public function createHostImages(User $host)
    {
        $this->command->info('Creating test images for host');
        $images = Storage::files('sample_images/houses');
        shuffle( $images );

        $images = array_slice( $images, 0, $this->host_images_count );
        $images_collection = [];
        foreach($images as $image){
            $copied_file_path = Copier::copy( $image, 'media/' . basename($image) );
            $images_collection[] = new UserImage( ['filename' => basename($copied_file_path)] );
        }
        $host->images()->saveMany( $images_collection );
        $this->command->info('done');
    }

    public function createUser()
    {
        $this->command->info('Creating test account for user');
        $user = factory(User::class)->make();
        $user->username = 'testuser';
        $user->email = 'testuser@user.com';
        $user->user_type = 'user';
        $user->save();
        $this->command->info('done');
    }
}
