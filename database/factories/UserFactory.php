<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'mobile' => $this->randomNumberSequence(),
            'password' => Hash::make(Str::random(10)), // password
            'user_role' => 'User',
            'user_status' => '1'

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
