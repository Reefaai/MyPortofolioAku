<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PageResponseTest extends TestCase
{
    /**
     * Data provider for all pages with their expected heading text.
     */
    public static function pageProvider(): array
    {
        return [
            'home' => ['/', 'home'],
            'about' => ['/about', 'about'],
            'projects' => ['/projects', 'projects'],
            'certificates' => ['/certificates', 'certificates'],
        ];
    }

    // =========================================================================
    // HTTP 200 and Heading Tests
    // =========================================================================

    public function test_home_page_returns_200_with_correct_heading(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $ownerName = config('portfolio.owner.name');
        $response->assertSee($ownerName);
    }

    public function test_about_page_returns_200_with_correct_heading(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('About');
    }

    public function test_projects_page_returns_200_with_correct_heading(): void
    {
        $response = $this->get('/projects');

        $response->assertStatus(200);
        $response->assertSee('Projects');
    }

    public function test_certificates_page_returns_200_with_correct_heading(): void
    {
        $response = $this->get('/certificates');

        $response->assertStatus(200);
        $response->assertSee('Certificates');
    }

    // =========================================================================
    // 404 Test
    // =========================================================================

    public function test_nonexistent_route_returns_404(): void
    {
        $response = $this->get('/nonexistent');

        $response->assertStatus(404);
    }

    // =========================================================================
    // Navbar Links Tests
    // =========================================================================

    #[DataProvider('pageProvider')]
    public function test_each_page_contains_navbar_links(string $url, string $pageName): void
    {
        $response = $this->get($url);

        $response->assertStatus(200);

        // Verify navigation links are present
        $response->assertSee(route('home'), false);
        $response->assertSee(route('about'), false);
        $response->assertSee(route('projects'), false);
        $response->assertSee(route('certificates'), false);
        // Hire Me mailto link
        $response->assertSee('mailto:', false);
    }

    // =========================================================================
    // Semantic HTML Tests
    // =========================================================================

    #[DataProvider('pageProvider')]
    public function test_each_page_contains_semantic_html_elements(string $url, string $pageName): void
    {
        $response = $this->get($url);

        $response->assertStatus(200);

        $content = $response->getContent();

        $this->assertStringContainsString('<header>', $content, "Page {$pageName} is missing <header> element");
        $this->assertStringContainsString('<nav', $content, "Page {$pageName} is missing <nav> element");
        $this->assertStringContainsString('<main', $content, "Page {$pageName} is missing <main> element");
        $this->assertStringContainsString('<footer>', $content, "Page {$pageName} is missing <footer> element");
    }

    // =========================================================================
    // Meta Viewport Tests
    // =========================================================================

    #[DataProvider('pageProvider')]
    public function test_each_page_contains_meta_viewport_tag(string $url, string $pageName): void
    {
        $response = $this->get($url);

        $response->assertStatus(200);

        $content = $response->getContent();

        $this->assertStringContainsString(
            'name="viewport" content="width=device-width, initial-scale=1.0"',
            $content,
            "Page {$pageName} is missing meta viewport tag"
        );
    }

    // =========================================================================
    // Unique Page Titles Tests
    // =========================================================================

    public function test_home_page_has_unique_title(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertMatchesRegularExpression('/<title>.*Home.*<\/title>/i', $content);
    }

    public function test_about_page_has_unique_title(): void
    {
        $response = $this->get('/about');
        $content = $response->getContent();

        $this->assertMatchesRegularExpression('/<title>.*About.*<\/title>/i', $content);
    }

    public function test_projects_page_has_unique_title(): void
    {
        $response = $this->get('/projects');
        $content = $response->getContent();

        $this->assertMatchesRegularExpression('/<title>.*Projects.*<\/title>/i', $content);
    }

    public function test_certificates_page_has_unique_title(): void
    {
        $response = $this->get('/certificates');
        $content = $response->getContent();

        $this->assertMatchesRegularExpression('/<title>.*Certificates.*<\/title>/i', $content);
    }

    public function test_all_pages_have_different_titles(): void
    {
        $pages = ['/', '/about', '/projects', '/certificates'];
        $titles = [];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $content = $response->getContent();

            preg_match('/<title>(.*?)<\/title>/', $content, $matches);
            $this->assertNotEmpty($matches, "Page {$url} is missing a <title> tag");
            $titles[$url] = $matches[1];
        }

        $uniqueTitles = array_unique($titles);
        $this->assertCount(
            count($titles),
            $uniqueTitles,
            'Not all pages have unique titles. Found: ' . implode(', ', $titles)
        );
    }
}
