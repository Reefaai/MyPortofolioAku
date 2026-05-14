<?php

namespace Tests\Feature\Property;

use Faker\Factory as Faker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Property-based tests for project card rendering.
 *
 * Feature: portfolio-website
 */
class ProjectRenderingTest extends TestCase
{
    /**
     * Property 1: Project card renders all required fields
     *
     * For any valid project data containing a title, description, and list of technologies,
     * the rendered project card HTML should contain the project's title text, description text,
     * and every technology name from the list.
     *
     * Validates: Requirements 5.2
     */
    #[DataProvider('randomProjectsProvider')]
    public function test_project_card_renders_all_required_fields(array $project): void
    {
        config(['portfolio.projects' => [$project]]);

        $response = $this->get('/projects');

        $response->assertStatus(200);
        $response->assertSee($project['title']);
        $response->assertSee($project['description']);

        foreach ($project['technologies'] as $tech) {
            $response->assertSee($tech);
        }
    }

    /**
     * Property 2: Project repository link rendered when present
     *
     * For any project that has a non-null repository_url, the rendered project card
     * should contain an anchor element with that URL as the href and target="_blank" attribute.
     *
     * Validates: Requirements 5.3
     */
    #[DataProvider('projectsWithRepositoryUrlProvider')]
    public function test_project_repository_link_rendered_when_present(array $project): void
    {
        config(['portfolio.projects' => [$project]]);

        $response = $this->get('/projects');

        $response->assertStatus(200);
        $response->assertSee('href="' . $project['repository_url'] . '"', false);
        $response->assertSee('target="_blank"', false);
    }

    /**
     * Data provider generating 100 random valid projects with required fields.
     */
    public static function randomProjectsProvider(): array
    {
        $faker = Faker::create();
        $cases = [];

        for ($i = 0; $i < 100; $i++) {
            $cases["iteration_{$i}"] = [
                [
                    'title' => $faker->sentence(3),
                    'description' => $faker->text(100),
                    'technologies' => $faker->words(rand(1, 5)),
                    'repository_url' => $faker->optional(0.7)->url(),
                ]
            ];
        }

        return $cases;
    }

    /**
     * Data provider generating 100 random projects with non-null repository URLs.
     */
    public static function projectsWithRepositoryUrlProvider(): array
    {
        $faker = Faker::create();
        $cases = [];

        for ($i = 0; $i < 100; $i++) {
            $cases["repo_iteration_{$i}"] = [
                [
                    'title' => $faker->sentence(3),
                    'description' => $faker->text(100),
                    'technologies' => $faker->words(rand(1, 5)),
                    'repository_url' => $faker->url(),
                ]
            ];
        }

        return $cases;
    }
}
