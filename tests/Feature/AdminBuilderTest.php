<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Section;
use App\Models\User;
use Tests\TestCase;

class AdminBuilderTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::where('email', 'admin@example.com')->first() ?? User::factory()->create([
            'is_admin' => true,
        ]);
    }

    public function test_guest_is_redirected_from_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Обзор студии & Метрики');
    }

    public function test_admin_can_create_section(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.sections.store'), [
            'title' => 'Аудио & Саундтреки',
            'slug' => 'audio-soundtracks',
            'icon' => 'music',
            'badge' => 'FLAC & WAV',
            'description' => 'Адаптивная музыка и звуковые эффекты для Unreal Engine.',
            'accent_color' => '#10b981',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.sections.index'));
        $this->assertDatabaseHas('sections', [
            'slug' => 'audio-soundtracks',
            'title' => 'Аудио & Саундтреки',
        ]);
    }

    public function test_admin_can_create_product_with_blocks(): void
    {
        $section = Section::firstOrFail();

        $blocks = [
            [
                'type' => 'heading',
                'level' => 'h2',
                'badge' => 'New Release',
                'content' => 'Революционная система звука',
            ],
            [
                'type' => 'text',
                'content' => '<p>Полная поддержка MetaSounds и пространственного аудио.</p>',
            ],
            [
                'type' => 'fab_button',
                'title' => 'Купить на Fab.com',
                'url' => 'https://www.fab.com/listings/audio-soundtracks',
                'price' => '$19.99',
            ],
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.products.store'), [
            'section_id' => $section->id,
            'title' => 'Adaptive Music Manager Pro',
            'slug' => 'adaptive-music-manager-pro',
            'tagline' => 'Система динамической смены саундтрека в зависимости от интенсивности боя',
            'fab_url' => 'https://www.fab.com/listings/audio-soundtracks',
            'price' => 19.99,
            'version_compatibility' => 'UE 5.3, 5.4, 5.5',
            'featured_image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=800',
            'blocks_json' => json_encode($blocks),
            'is_published' => true,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'slug' => 'adaptive-music-manager-pro',
            'price' => 19.99,
        ]);
    }

    public function test_admin_can_moderate_comments(): void
    {
        $comment = Comment::create([
            'commentable_type' => Section::class,
            'commentable_id' => 1,
            'author_name' => 'Moderation User',
            'author_email' => 'mod@test.com',
            'content' => 'Отзыв на модерации',
            'rating' => 4,
            'is_approved' => false,
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.comments.approve', $comment->id));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'is_approved' => true,
        ]);
    }
}
