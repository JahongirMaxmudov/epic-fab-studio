<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Product;
use App\Models\Section;
use Tests\TestCase;

class ClientPortalTest extends TestCase
{
    public function test_landing_page_loads_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('EPIC FAB STUDIO');
        $response->assertSee('КАТЕГОРИИ АССЕТОВ');
        $response->assertSee('ПОПУЛЯРНЫЕ ПРОДУКТЫ');
    }

    public function test_section_catalog_level_2_page(): void
    {
        $section = Section::where('slug', 'fab-plugins')->firstOrFail();

        $response = $this->get(route('catalog.section', $section->slug));

        $response->assertStatus(200);
        $response->assertSee($section->title);
        $response->assertSee('Версия:');

        // Test with engine version filter
        $filterResponse = $this->get(route('catalog.section', ['slug' => $section->slug, 'version' => '5.4']));
        $filterResponse->assertStatus(200);
    }

    public function test_product_presentation_level_3_page(): void
    {
        $product = Product::where('slug', 'omnidialogue-pro-ue5')->firstOrFail();

        $response = $this->get(route('catalog.product', [
            'section_slug' => $product->section->slug,
            'product_slug' => $product->slug,
        ]));

        $response->assertStatus(200);
        $response->assertSee($product->title);
        $response->assertSee('Приобрести на Fab.com');
        $response->assertSee('Технические спецификации');
        $response->assertSee('Отзывы и обсуждение');
    }

    public function test_user_can_submit_product_review(): void
    {
        $product = Product::where('slug', 'omnidialogue-pro-ue5')->firstOrFail();

        $response = $this->post(route('comments.store'), [
            'commentable_type' => 'product',
            'commentable_id' => $product->id,
            'author_name' => 'Unreal Engine Dev',
            'author_email' => 'dev@ue5community.com',
            'rating' => 5,
            'content' => 'Отличный плагин, экономит кучу времени при создании катсцен!',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('comments', [
            'author_name' => 'Unreal Engine Dev',
            'rating' => 5,
        ]);
    }

    public function test_news_index_and_detail_page(): void
    {
        $response = $this->get(route('news.index'));
        $response->assertStatus(200);
        $response->assertSee('ДНЕВНИКИ РАЗРАБОТКИ');

        $article = News::first();
        if ($article) {
            $detailResponse = $this->get(route('news.show', $article->slug));
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($article->title);
        }
    }
}
