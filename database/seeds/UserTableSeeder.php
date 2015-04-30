<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
class UserTableSeeder extends Seeder {
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$faker = Faker::create();
for($i = 0; $i < 1000; $i ++)
{
$firstname=$faker->firstName;
$lastname=$faker->firstName;
$id = \DB::table('users')->insertGetId(array(
'first_name'=>$firstname,
'last_name'=>$lastname,
'full_name'=>"$firstname $lastname",
'user_name'=>$faker->unique()->userName,
'email'=>$faker->unique()->email,
'password'=>\Hash::make('urico'),
'type'=> $faker->randomElement(['editor','contributor','subscriber','user']),
'created_at' => new DateTime,
'updated_at' => new DateTime
// $this->call('UserTableSeeder');
));
\DB::table('user_profiles')->insert(array(
'user_id'=> $id,
'bio'=>$faker->paragraph(rand(2,5)),
'website'=>'http://www.'. $faker->domainName,
'twitter'=>'http://www.twitter.com/'. $faker->userName,
'birthdate'=>$faker->dateTimeBetween('-40 years', $endDate = '-18 years')->format('Y-m-d'),
'created_at' => new DateTime,
'updated_at' => new DateTime,
// $this->call('UserTableSeeder');
));
}
}
}