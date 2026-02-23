<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => fake()->sentence(4),
            'body' => $this->generateBody(),
        ];
    }

    /**
     * Generate body with 2-4 paragraphs, each paragraph 150-500 words.
     */
    private function generateBody(): string
    {
        $paragraphCount = fake()->numberBetween(2, 4);
        $paragraphs = [];

        for ($i = 0; $i < $paragraphCount; $i++) {
            $wordCount = fake()->numberBetween(150, 500);
            $paragraphs[] = $this->paragraphWithWordCount($wordCount);
        }

        return implode("\n\n", $paragraphs);
    }

    /**
     * Generate a single paragraph with approximately the given word count.
     */
    private function paragraphWithWordCount(int $targetWords): string
    {
        $sentences = [];
        $wordCount = 0;

        while ($wordCount < $targetWords) {
            $sentence = fake()->sentence(fake()->numberBetween(8, 20));
            $sentences[] = $sentence;
            $wordCount += str_word_count($sentence);
        }

        return implode(' ', $sentences);
    }
}
