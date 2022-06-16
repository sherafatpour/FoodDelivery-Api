<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $addressable=[User::class,Restaurant::class];

        return [
            'address'=> $this->faker->address(),
            'latitude'=> $this->faker->randomFloat(15),
            'longitude' =>  $this->faker->randomFloat(15), // password
            'addressable_type' => $this->faker->randomElement($addressable),
            'addressable_id' => $this->faker->numberBetween(1,10)

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    public function randomNumberSequence($requiredLength = 7, $highestDigit = 8)
    {
        $numberPrefixes = ['0912', '0913', '0814', '0915', '0916', '0917', '0918', '0919', '0909', '0908'];
        $sequence = '';
        for ($i = 0; $i < $requiredLength; ++$i) {
            $sequence .= mt_rand(0, $highestDigit);
        }
        return $numberPrefixes[array_rand($numberPrefixes)] . $sequence;
    }
}
