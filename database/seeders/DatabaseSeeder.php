<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Product;
use App\Models\Section;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Fab & Unreal Engine Master',
                'password' => Hash::make('password123'),
                'is_admin' => true,
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=200&q=80',
            ]
        );

        // 2. Sections
        $sectionsData = [
            [
                'title' => 'Плагины на Fab.com',
                'slug' => 'fab-plugins',
                'icon' => 'plug',
                'badge' => 'C++ & Blueprint',
                'description' => 'Высокопроизводительные C++ и модульные плагины для Unreal Engine 5. Ускоряйте разработку ваших игр и симуляций.',
                'banner_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1600&q=80',
                'accent_color' => '#007dfc',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'VFX & Шейдеры',
                'slug' => 'vfx-shaders',
                'icon' => 'wand-magic-sparkles',
                'badge' => 'Niagara & Shaders',
                'description' => 'Передовые эффекты частиц Niagara, кинематографические шейдеры постобработки и процедурные материалы.',
                'banner_image' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=1600&q=80',
                'accent_color' => '#00dfa2',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => '3D Ассеты & Окружение',
                'slug' => '3d-assets',
                'icon' => 'cubes',
                'badge' => 'Nanite & Lumen',
                'description' => 'Оптимизированные модульные окружения, киберпанк и фантастические интерьеры с PBR текстурами 4K.',
                'banner_image' => 'https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=1600&q=80',
                'accent_color' => '#8b5cf6',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Blueprints & Системы',
                'slug' => 'blueprints',
                'icon' => 'network-wired',
                'badge' => 'Turnkey Frameworks',
                'description' => 'Готовые игровые механики, инвентарь, боевые системы и ИИ поведение боссов без единой строчки кода.',
                'banner_image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=1600&q=80',
                'accent_color' => '#f59e0b',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        $sections = [];
        foreach ($sectionsData as $sData) {
            $sections[$sData['slug']] = Section::create($sData);
        }

        // 3. Products
        $p1 = Product::create([
            'section_id' => $sections['fab-plugins']->id,
            'title' => 'OmniDialogue Pro: Node Narrative & Voice AI System',
            'slug' => 'omnidialogue-pro-ue5',
            'tagline' => 'Комплексная система диалогов с визуальным редактором графов Slate и интеграцией MetaHuman для UE 5.3-5.5',
            'fab_url' => 'https://www.fab.com/listings/omnidialogue-pro-ue5',
            'price' => 49.99,
            'version_compatibility' => 'UE 5.3, 5.4, 5.5',
            'featured_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1200&q=80',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=1200&q=80',
            ],
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Визуальное дерево сценариев нового поколения',
                    'level' => 'h2',
                    'badge' => 'Core Feature',
                ],
                [
                    'type' => 'text',
                    'content' => '<p><strong>OmniDialogue Pro</strong> разработан специально для масштабных RPG и кинематографичных приключений. Построен на кастомном графовом движке Unreal Slate с поддержкой древовидных развилок, динамической проверки условий, локализации и метаданных для лицевой анимации MetaHuman.</p><p>Плагин не нагружает CPU, работает в асинхронном режиме и полностью поддерживает сетевую репликацию для мультиплеерных сессий.</p>',
                ],
                [
                    'type' => 'video',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'title' => 'Видеообзор интеграции в Unreal Engine 5.4',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Открыть страницу на Fab.com Marketplace',
                    'url' => 'https://www.fab.com/listings/omnidialogue-pro-ue5',
                    'price' => '$49.99',
                    'badge' => 'Official Fab Release',
                ],
                [
                    'type' => 'heading',
                    'content' => 'Технические спецификации и архитектура',
                    'level' => 'h3',
                    'badge' => 'Specifications',
                ],
                [
                    'type' => 'specs',
                    'items' => [
                        ['label' => 'Версии движка', 'value' => 'Unreal Engine 5.3, 5.4, 5.5'],
                        ['label' => 'Платформы', 'value' => 'Windows, Mac, Linux, PS5, Xbox Series X/S'],
                        ['label' => 'Модули C++', 'value' => 'OmniDialogueEditor (Editor), OmniDialogueRuntime (Runtime)'],
                        ['label' => 'Сетевая репликация', 'value' => 'Да, полная синхронизация мультиплеера'],
                        ['label' => 'Исходный код', 'value' => 'Включен 100% C++ и Blueprint исходник'],
                    ],
                ],
                [
                    'type' => 'gallery',
                    'images' => [
                        ['url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80', 'title' => 'Редактор Slate графов'],
                        ['url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80', 'title' => 'Инспектор условий и переменных'],
                        ['url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80', 'title' => 'MetaHuman синхронизация губ'],
                    ],
                ],
            ],
            'is_published' => true,
            'is_featured' => true,
            'views_count' => 1420,
        ]);

        $p2 = Product::create([
            'section_id' => $sections['fab-plugins']->id,
            'title' => 'Chaos Advanced Vehicle & Destruction Framework',
            'slug' => 'chaos-advanced-vehicle-physics',
            'tagline' => 'Модульный физический фреймворк для симуляции колесной техники с процедурными повреждениями Chaos Physics',
            'fab_url' => 'https://www.fab.com/listings/chaos-vehicle-physics',
            'price' => 69.99,
            'version_compatibility' => 'UE 5.2, 5.3, 5.4, 5.5',
            'featured_image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1200&q=80',
            ],
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Реалистичная физика колес и подвески',
                    'level' => 'h2',
                    'badge' => 'Chaos Engine',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>Полностью настраиваемая физика автотранспорта с реалистичным сцеплением шин (Pacejka formula), блокировкой дифференциала, деформацией кузова и отрывом деталей при столкновениях.</p>',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Купить на Fab.com',
                    'url' => 'https://www.fab.com/listings/chaos-vehicle-physics',
                    'price' => '$69.99',
                    'badge' => 'Fab Exclusive',
                ],
                [
                    'type' => 'specs',
                    'items' => [
                        ['label' => 'Версии движка', 'value' => 'UE 5.2 - 5.5'],
                        ['label' => 'Платформы', 'value' => 'Windows, Xbox, PlayStation'],
                        ['label' => 'Деформация', 'value' => 'Chaos Flesh & Geometry Collection'],
                    ],
                ],
            ],
            'is_published' => true,
            'is_featured' => true,
            'views_count' => 890,
        ]);

        $p3 = Product::create([
            'section_id' => $sections['vfx-shaders']->id,
            'title' => 'Cyberpunk Holograms & Volumetric Glitch FX Pack',
            'slug' => 'cyberpunk-holograms-volumetric-glitch',
            'tagline' => 'Пакет из 45+ процедурных голографических шейдеров и Niagara систем с интерактивной деформацией',
            'fab_url' => 'https://www.fab.com/listings/cyberpunk-holograms',
            'price' => 29.99,
            'version_compatibility' => 'UE 5.1 - 5.5',
            'featured_image' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=1200&q=80',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=1200&q=80',
            ],
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Кинематографичные эффекты для Sci-Fi и Cyberpunk миров',
                    'level' => 'h2',
                    'badge' => 'Niagara VFX',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>Полный набор шейдеров с эмиссионным свечением Lumen, настраиваемыми глитчами сканирования, шумом Перлина и аудиореактивностью.</p>',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Смотреть на Fab.com',
                    'url' => 'https://www.fab.com/listings/cyberpunk-holograms',
                    'price' => '$29.99',
                    'badge' => 'Instant Download',
                ],
            ],
            'is_published' => true,
            'is_featured' => true,
            'views_count' => 1120,
        ]);

        $p4 = Product::create([
            'section_id' => $sections['3d-assets']->id,
            'title' => 'Neo-Tokyo Sci-Fi Megacity (Nanite Modular Pack)',
            'slug' => 'neo-tokyo-scifi-megacity-nanite',
            'tagline' => 'Свыше 250 модульных высокодетализированных мешей Nanite с настроенным освещением Lumen и PBR 4K',
            'fab_url' => 'https://www.fab.com/listings/neo-tokyo-megacity',
            'price' => 89.99,
            'version_compatibility' => 'UE 5.3, 5.4, 5.5',
            'featured_image' => 'https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=1200&q=80',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1514565131-fce0801e5785?auto=format&fit=crop&w=1200&q=80',
            ],
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Полноценный мегаполис за считанные минуты',
                    'level' => 'h2',
                    'badge' => 'Nanite Ready',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>Модульная архитектура небоскребов, уличной инфраструктуры, неоновых вывесок и кондиционеров. Полностью оптимизировано под 60 FPS на консолях текущего поколения благодаря Nanite и виртуальным теневым картам (VSM).</p>',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Приобрести на Fab.com',
                    'url' => 'https://www.fab.com/listings/neo-tokyo-megacity',
                    'price' => '$89.99',
                    'badge' => 'Nanite + Lumen',
                ],
            ],
            'is_published' => true,
            'is_featured' => true,
            'views_count' => 2400,
        ]);

        $p5 = Product::create([
            'section_id' => $sections['blueprints']->id,
            'title' => 'Soulslike Dynamic Combat & Boss AI System',
            'slug' => 'soulslike-combat-system',
            'tagline' => 'Механика ближнего боя с таргетингом, перекатами, парированием и деревом поведения боссов Behavior Tree',
            'fab_url' => 'https://www.fab.com/listings/soulslike-combat',
            'price' => 59.99,
            'version_compatibility' => 'UE 5.0 - 5.5',
            'featured_image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=1200&q=80',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=1200&q=80',
            ],
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Боевая система ААА-уровня',
                    'level' => 'h2',
                    'badge' => 'Blueprint Only',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>Система стамины, тайминги парирования, смена стоек, инверсная кинематика ног и модульный ИИ боссов с фазами сражения.</p>',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Купить на Fab.com',
                    'url' => 'https://www.fab.com/listings/soulslike-combat',
                    'price' => '$59.99',
                    'badge' => 'Turnkey Solution',
                ],
            ],
            'is_published' => true,
            'is_featured' => true,
            'views_count' => 1750,
        ]);

        // 4. Comments
        $p1->allComments()->create([
            'author_name' => 'Alexey (Senior UE Technical Artist)',
            'author_email' => 'alexey@gamedev.org',
            'content' => 'OmniDialogue Pro — лучший диалоговый плагин в нашем продакшене. Интеграция с MetaHuman сэкономила недели работы аниматорам. Однозначно стоит каждого цента!',
            'rating' => 5,
            'is_approved' => true,
        ]);

        $p1->allComments()->create([
            'author_name' => 'Michael Chen',
            'author_email' => 'michael@indiehub.io',
            'content' => 'Works flawlessly on UE 5.5 preview as well. Very clean Slate UI and intuitive node graph. Keep it up!',
            'rating' => 5,
            'is_approved' => true,
        ]);

        $p4->allComments()->create([
            'author_name' => 'Dmitry VFX',
            'author_email' => 'dmitry@renderbox.ru',
            'content' => 'Качество моделей запредельное, сетка Nanite сделана профессионально. Сцена грузится моментально.',
            'rating' => 5,
            'is_approved' => true,
        ]);

        // 5. News / DevLog
        News::create([
            'user_id' => $admin->id,
            'title' => 'Выпущен патч OmniDialogue Pro 2.1: Полная поддержка Unreal Engine 5.5',
            'slug' => 'omnidialogue-pro-2-1-released-ue-5-5',
            'excerpt' => 'Мы обновили наш флагманский плагин диалогов до версии 2.1 с поддержкой нового рендерера Slate в UE 5.5 и оптимизацией асинхронных вызовов.',
            'featured_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1200&q=80',
            'category' => 'Обновления плагинов',
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Что нового в версии 2.1',
                    'level' => 'h2',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>В этом обновлении мы уделили внимание обратной связи от студий разработчиков. Полная совместимость с релизом Unreal Engine 5.5, ускорение сборки C++ модулей на 35% и новый инспектор звуковых дорожек.</p>',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Обновиться на Fab.com',
                    'url' => 'https://www.fab.com/listings/omnidialogue-pro-ue5',
                    'price' => 'Бесплатный апдейт',
                    'badge' => 'Fab Library',
                ],
            ],
            'is_published' => true,
            'views_count' => 560,
            'published_at' => now()->subDays(2),
        ]);

        News::create([
            'user_id' => $admin->id,
            'title' => 'Как мы оптимизировали Nanite геометрию в Neo-Tokyo для 60 FPS',
            'slug' => 'how-we-optimized-nanite-geometry-neotokyo-60fps',
            'excerpt' => 'Глубокий технический разбор настройки виртуальных текстур и теневых карт VSM для городских окружений с миллионами полигонов.',
            'featured_image' => 'https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=1200&q=80',
            'category' => 'Технический блог',
            'blocks' => [
                [
                    'type' => 'heading',
                    'content' => 'Nanite и Lumen без просадок фреймрейта',
                    'level' => 'h2',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>При разработке ассетов Neo-Tokyo мы стремились к идеальному балансу детализации и производительности. В этой статье мы подробно описываем пайплайн создания материалов и атласов текстур.</p>',
                ],
            ],
            'is_published' => true,
            'views_count' => 930,
            'published_at' => now()->subDays(5),
        ]);

        // 6. Settings & Creator Business Card Profile
        $settings = [
            'site_name' => 'JAHONGIR DEV | FAB STUDIO',
            'site_tagline' => 'Личный сайт-визитка & Портфолио плагинов для Unreal Engine 5 на Fab.com',
            'author_name' => 'Jahongir Maxmudov',
            'author_status' => 'Unreal Engine 5 C++ Developer & Technical Artist',
            'hero_badge' => 'GameDev & C++ Creator',
            'author_avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=300&q=80',
            'author_bio' => 'Привет! Я разработчик игровых механик, C++ плагинов и шейдеров для Unreal Engine 5. Здесь я делюсь своими проектами, официальными продуктами на Fab.com, обучающими роликами на YouTube и новостями разработки в Telegram-канале.',
            'telegram_url' => 'https://t.me/epicfabstudio',
            'youtube_url' => 'https://youtube.com/@epicfabstudio',
            'fab_store_url' => 'https://www.fab.com/sellers/EpicFabStudio',
            'discord_url' => 'https://discord.gg/epicfab',
            'github_url' => 'https://github.com/JahongirMaxmudov',
            'contact_email' => 'support@epicfabstudio.dev',
            'home_blocks' => json_encode([
                [
                    'type' => 'heading',
                    'level' => 'h2',
                    'badge' => 'YouTube & DevLog',
                    'content' => 'Свежие видеоуроки и разборы на моем YouTube-канале',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>Регулярно выпускаю подробные видеоуроки по C++ архитектуре в Unreal Engine 5, созданию кастомных графов Slate, шейдеров в Niagara и оптимизации Nanite для AAA-проектов. Подписывайтесь, чтобы первыми получать новые туториалы!</p>',
                ],
                [
                    'type' => 'video',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'title' => 'Видеообзор: Интеграция C++ плагина диалогов в Unreal Engine 5.4',
                ],
                [
                    'type' => 'heading',
                    'level' => 'h2',
                    'badge' => 'Telegram Community',
                    'content' => 'Мой Telegram-канал — новости и закулисье разработки',
                ],
                [
                    'type' => 'text',
                    'content' => '<p>В Telegram я публикую анонсы новых плагинов до релиза на Fab.com, делюсь скриншотами текущих экспериментов (WIP), провожу опросы по фичам и лично отвечаю на вопросы разработчиков.</p>',
                ],
                [
                    'type' => 'fab_button',
                    'title' => 'Перейти в Telegram-канал @epicfabstudio',
                    'url' => 'https://t.me/epicfabstudio',
                    'price' => 'Бесплатный канал',
                    'badge' => 'Live Updates',
                ],
            ]),
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
