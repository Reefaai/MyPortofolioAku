<?php

namespace Tests\Feature\Property;

use Faker\Factory as Faker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Property-based tests for certificate card rendering.
 *
 * Feature: portfolio-website
 */
class CertificateRenderingTest extends TestCase
{
    /**
     * Property 3: Certificate card renders all required fields
     *
     * For any valid certificate data containing a name, issuer, and year,
     * the rendered certificate card HTML should contain the certificate name,
     * issuer name, and the 4-digit year.
     *
     * Validates: Requirements 6.2
     */
    #[DataProvider('certificateRequiredFieldsProvider')]
    public function test_certificate_card_renders_all_required_fields(array $certificate): void
    {
        config(['portfolio.certificates' => [$certificate]]);

        $response = $this->get('/certificates');

        $response->assertStatus(200);
        $response->assertSee($certificate['name']);
        $response->assertSee($certificate['issuer']);
        $response->assertSee((string) $certificate['year']);
    }

    /**
     * Property 4: Certificate optional fields rendered when present
     *
     * For any certificate that has a non-null verification_url or a non-null image path,
     * the rendered certificate card should contain an anchor element with the verification URL
     * (with target="_blank") when verification_url is present, and an img element with the
     * image path when image is present.
     *
     * Validates: Requirements 6.3, 6.4
     */
    #[DataProvider('certificateOptionalFieldsProvider')]
    public function test_certificate_optional_fields_rendered_when_present(
        array $certificate,
        bool $hasVerificationUrl,
        bool $hasImage
    ): void {
        config(['portfolio.certificates' => [$certificate]]);

        $response = $this->get('/certificates');

        $response->assertStatus(200);

        if ($hasVerificationUrl) {
            $response->assertSee('href="' . $certificate['verification_url'] . '"', false);
            $response->assertSee('target="_blank"', false);
        }

        if ($hasImage) {
            $response->assertSee('<img', false);
            $response->assertSee($certificate['image'], false);
        }
    }

    /**
     * Property 5: Certificates displayed in descending year order
     *
     * For any list of certificates with varying years, the rendered certificates page
     * should display them in descending order by year (newest first).
     *
     * Validates: Requirements 6.6
     */
    #[DataProvider('certificateSortOrderProvider')]
    public function test_certificates_displayed_in_descending_year_order(array $certificates): void
    {
        config(['portfolio.certificates' => $certificates]);

        $response = $this->get('/certificates');

        $response->assertStatus(200);

        $content = $response->getContent();

        // Extract years in the order they appear in the HTML
        $sortedYears = collect($certificates)->pluck('year')->sortDesc()->values()->all();

        // Verify each year appears after the previous one in the HTML
        $lastPosition = 0;
        foreach ($sortedYears as $year) {
            $position = strpos($content, (string) $year, $lastPosition);
            $this->assertNotFalse(
                $position,
                "Year {$year} not found in rendered HTML after position {$lastPosition}"
            );
            $lastPosition = $position + strlen((string) $year);
        }
    }

    /**
     * Data provider generating 100 random valid certificates with required fields.
     */
    public static function certificateRequiredFieldsProvider(): array
    {
        $faker = Faker::create();
        $cases = [];

        for ($i = 0; $i < 100; $i++) {
            $certificate = [
                'name' => $faker->sentence(3),
                'issuer' => $faker->company(),
                'year' => $faker->numberBetween(2000, 2025),
                'verification_url' => null,
                'image' => null,
            ];

            $cases["certificate_{$i}"] = [$certificate];
        }

        return $cases;
    }

    /**
     * Data provider generating 100 random certificates with optional fields.
     */
    public static function certificateOptionalFieldsProvider(): array
    {
        $faker = Faker::create();
        $cases = [];

        for ($i = 0; $i < 100; $i++) {
            $hasVerificationUrl = $faker->boolean(70);
            $hasImage = $faker->boolean(70);

            // Ensure at least one optional field is present
            if (!$hasVerificationUrl && !$hasImage) {
                $hasVerificationUrl = true;
            }

            $certificate = [
                'name' => $faker->sentence(3),
                'issuer' => $faker->company(),
                'year' => $faker->numberBetween(2000, 2025),
                'verification_url' => $hasVerificationUrl ? $faker->url() : null,
                'image' => $hasImage ? 'images/certs/' . $faker->slug(2) . '.jpg' : null,
            ];

            $cases["certificate_optional_{$i}"] = [$certificate, $hasVerificationUrl, $hasImage];
        }

        return $cases;
    }

    /**
     * Data provider generating 100 random certificate lists with varying years for sort order testing.
     */
    public static function certificateSortOrderProvider(): array
    {
        $faker = Faker::create();
        $cases = [];

        for ($i = 0; $i < 100; $i++) {
            $count = $faker->numberBetween(3, 8);
            $certificates = [];

            // Generate unique years to avoid ambiguity in ordering
            $years = $faker->unique(true)->randomElements(range(2000, 2025), $count);

            foreach ($years as $year) {
                $certificates[] = [
                    'name' => $faker->sentence(3),
                    'issuer' => $faker->company(),
                    'year' => $year,
                    'verification_url' => null,
                    'image' => null,
                ];
            }

            // Shuffle to ensure the controller's sort is being tested
            shuffle($certificates);

            $cases["certificate_sort_{$i}"] = [$certificates];
        }

        return $cases;
    }
}
