<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\JpegEncoder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = Str::random(20) . '.jpg';

        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->create(640, 480)->fill($this->faker->hexColor());


        $image->text(
            $this->faker->word(),
            320,
            240,
            function ($font) {
                $font->size(24);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('center');
            }
        );
        
        $imageData = $image->encode(new JpegEncoder());
        Storage::disk('public')->put('images/' . $filename, (string) $imageData);

        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'image' => 'images/' . $filename,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
