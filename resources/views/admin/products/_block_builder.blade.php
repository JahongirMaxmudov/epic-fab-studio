<!-- Visual Modular Page Builder (Widget / Block Designer) -->
<div x-data="blockBuilder(@js($initialBlocks ?? []))" class="space-y-6">
    
    <!-- Header of the Builder -->
    <div class="p-6 rounded-2xl bg-[#0a0c12] border border-blue-500/20 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-500/20 text-cyan-300 border border-blue-500/30 font-tech mb-1">
                <i class="fa-solid fa-cubes-stacked"></i> Визуальный конструктор блоков
            </div>
            <h3 class="text-lg font-bold text-white font-tech uppercase">КОНСТРУКТОР СТРАНИЦЫ АССЕТА / ПЛАГИНА</h3>
            <p class="text-xs text-slate-400">Добавляйте, перемещайте и настраивайте модульные блоки контента (виджеты).</p>
        </div>

        <!-- Add Widget Dropdown / Buttons -->
        <div class="flex flex-wrap items-center gap-2">
            <button type="button" @click="addBlock('heading')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-heading text-blue-400"></i> + Заголовок
            </button>
            <button type="button" @click="addBlock('text')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-paragraph text-cyan-400"></i> + Текст
            </button>
            <button type="button" @click="addBlock('image')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-image text-emerald-400"></i> + Картинка
            </button>
            <button type="button" @click="addBlock('gallery')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-images text-purple-400"></i> + Галерея
            </button>
            <button type="button" @click="addBlock('video')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-video text-red-400"></i> + Видео
            </button>
            <button type="button" @click="addBlock('fab_button')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-store text-amber-400"></i> + Кнопка Fab
            </button>
            <button type="button" @click="addBlock('specs')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-table-list text-indigo-400"></i> + Спецификации
            </button>
            <button type="button" @click="addBlock('code')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/5 hover:bg-blue-600 text-slate-200 hover:text-white transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-code text-teal-400"></i> + Код
            </button>
        </div>
    </div>

    <!-- Hidden input to store JSON output -->
    <input type="hidden" name="blocks_json" :value="JSON.stringify(blocks)">

    <!-- List of active blocks -->
    <div class="space-y-4">
        
        <template x-for="(block, bIndex) in blocks" :key="bIndex">
            <div class="rounded-2xl bg-[#0a0c12] border border-white/10 p-5 shadow-lg relative group transition-all">
                
                <!-- Block Header Bar -->
                <div class="flex items-center justify-between pb-3 mb-4 border-b border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded bg-white/5 flex items-center justify-center text-xs font-bold text-slate-400 font-mono" x-text="bIndex + 1"></span>
                        
                        <!-- Block Type Badge -->
                        <span class="px-2.5 py-0.5 rounded text-[11px] font-bold font-tech uppercase tracking-wider bg-white/10 text-white flex items-center gap-1.5">
                            <span x-show="block.type === 'heading'"><i class="fa-solid fa-heading text-blue-400"></i> Заголовок</span>
                            <span x-show="block.type === 'text'"><i class="fa-solid fa-paragraph text-cyan-400"></i> Текстовый блок</span>
                            <span x-show="block.type === 'image'"><i class="fa-solid fa-image text-emerald-400"></i> Картинка</span>
                            <span x-show="block.type === 'gallery'"><i class="fa-solid fa-images text-purple-400"></i> Галерея скриншотов</span>
                            <span x-show="block.type === 'video'"><i class="fa-solid fa-video text-red-400"></i> Видео плеер</span>
                            <span x-show="block.type === 'fab_button'"><i class="fa-solid fa-store text-amber-400"></i> Кнопка действия Fab.com</span>
                            <span x-show="block.type === 'specs'"><i class="fa-solid fa-table-list text-indigo-400"></i> Таблица характеристик</span>
                            <span x-show="block.type === 'code'"><i class="fa-solid fa-code text-teal-400"></i> Код / Blueprints</span>
                        </span>
                    </div>

                    <!-- Controls: Move Up, Move Down, Delete -->
                    <div class="flex items-center gap-1">
                        <button type="button" @click="moveUp(bIndex)" :disabled="bIndex === 0" class="p-1.5 rounded hover:bg-white/10 text-slate-400 hover:text-white disabled:opacity-30 disabled:pointer-events-none" title="Поднять вверх">
                            <i class="fa-solid fa-arrow-up text-xs"></i>
                        </button>
                        <button type="button" @click="moveDown(bIndex)" :disabled="bIndex === blocks.length - 1" class="p-1.5 rounded hover:bg-white/10 text-slate-400 hover:text-white disabled:opacity-30 disabled:pointer-events-none" title="Опустить вниз">
                            <i class="fa-solid fa-arrow-down text-xs"></i>
                        </button>
                        <button type="button" @click="removeBlock(bIndex)" class="p-1.5 rounded hover:bg-red-500/20 text-red-400 hover:text-red-300 ml-2" title="Удалить блок">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- 1. Heading Block Fields -->
                <div x-show="block.type === 'heading'" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                    <div class="sm:col-span-3">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Уровень</label>
                        <select x-model="block.level" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                            <option value="h2">H2 (Главный раздел)</option>
                            <option value="h3">H3 (Подраздел)</option>
                            <option value="h4">H4 (Мелкий)</option>
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Бейдж (опция)</label>
                        <input type="text" x-model="block.badge" placeholder="Core Feature" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div class="sm:col-span-6">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Текст заголовка</label>
                        <input type="text" x-model="block.content" placeholder="Название блока..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                </div>

                <!-- 2. Text Block Fields -->
                <div x-show="block.type === 'text'" class="space-y-2">
                    <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Форматированный текст (HTML поддерживается)</label>
                    <textarea x-model="block.content" rows="4" placeholder="Введите текст с описанием возможностей, преимуществ и архитектуры..." class="w-full bg-[#07080b] border border-white/10 rounded-xl p-3 text-xs text-slate-200 font-mono leading-relaxed"></textarea>
                </div>

                <!-- 3. Image Block Fields -->
                <div x-show="block.type === 'image'" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-3">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">URL изображения</label>
                        <input type="text" x-model="block.url" placeholder="https://..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Заголовок к картинке</label>
                        <input type="text" x-model="block.title" placeholder="Интерфейс редактора..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Подпись (caption)</label>
                        <input type="text" x-model="block.caption" placeholder="Вид из UE5 Viewport" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                </div>

                <!-- 4. Gallery Block Fields -->
                <div x-show="block.type === 'gallery'" class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech">Галерея скриншотов</label>
                        <button type="button" @click="addGalleryItem(bIndex)" class="text-[11px] font-bold text-purple-400 hover:text-purple-300 font-tech uppercase">
                            + Добавить скриншот
                        </button>
                    </div>

                    <div class="space-y-2">
                        <template x-for="(img, gIndex) in block.images" :key="gIndex">
                            <div class="flex items-center gap-2">
                                <input type="text" x-model="img.url" placeholder="URL скриншота..." class="flex-grow bg-[#07080b] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-slate-200">
                                <input type="text" x-model="img.title" placeholder="Подпись..." class="w-1/3 bg-[#07080b] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-slate-200">
                                <button type="button" @click="removeGalleryItem(bIndex, gIndex)" class="p-1.5 text-red-400 hover:text-red-300">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 5. Video Block Fields -->
                <div x-show="block.type === 'video'" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Ссылка на YouTube или видео</label>
                        <input type="text" x-model="block.url" placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Название ролика</label>
                        <input type="text" x-model="block.title" placeholder="Видеообзор возможностей..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                </div>

                <!-- 6. Fab Action Button Block Fields -->
                <div x-show="block.type === 'fab_button'" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                    <div class="sm:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Заголовок кнопки</label>
                        <input type="text" x-model="block.title" placeholder="Открыть на Fab.com" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">URL адрес Fab</label>
                        <input type="text" x-model="block.url" placeholder="https://www.fab.com/listings/..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Цена / Подпись цены</label>
                        <input type="text" x-model="block.price" placeholder="$49.99" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Бейдж над кнопкой</label>
                        <input type="text" x-model="block.badge" placeholder="Official Fab Link" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                    </div>
                </div>

                <!-- 7. Specs Table Block Fields -->
                <div x-show="block.type === 'specs'" class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech">Характеристики / Спецификации</label>
                        <button type="button" @click="addSpecRow(bIndex)" class="text-[11px] font-bold text-cyan-400 hover:text-cyan-300 font-tech uppercase">
                            + Добавить строку
                        </button>
                    </div>

                    <div class="space-y-2">
                        <template x-for="(item, sIndex) in block.items" :key="sIndex">
                            <div class="flex items-center gap-2">
                                <input type="text" x-model="item.label" placeholder="Параметр (напр: Платформы)" class="w-1/3 bg-[#07080b] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-slate-200">
                                <input type="text" x-model="item.value" placeholder="Значение (напр: Windows, PS5, Xbox)" class="flex-grow bg-[#07080b] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-slate-200">
                                <button type="button" @click="removeSpecRow(bIndex, sIndex)" class="p-1.5 text-red-400 hover:text-red-300">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 8. Code Snippet Block Fields -->
                <div x-show="block.type === 'code'" class="space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Язык</label>
                            <input type="text" x-model="block.language" placeholder="cpp, csharp, blueprint" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Заголовок окна кода</label>
                            <input type="text" x-model="block.title" placeholder="MyPlugin.h" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase font-tech mb-1">Исходный код</label>
                        <textarea x-model="block.code" rows="4" placeholder="// C++ snippet..." class="w-full bg-[#07080b] border border-white/10 rounded-xl p-3 text-xs font-mono text-cyan-300 leading-relaxed"></textarea>
                    </div>
                </div>

            </div>
        </template>

        <div x-show="blocks.length === 0" class="text-center py-10 rounded-2xl border border-dashed border-white/10 p-6 text-slate-500 text-xs">
            Блоки еще не добавлены. Нажмите на кнопки выше, чтобы добавить первый виджет.
        </div>

    </div>

</div>

<script>
    function blockBuilder(initial) {
        return {
            blocks: Array.isArray(initial) ? initial : [],

            addBlock(type) {
                let newBlock = { type: type };

                if (type === 'heading') {
                    newBlock.level = 'h2';
                    newBlock.badge = '';
                    newBlock.content = 'Новый заголовок';
                } else if (type === 'text') {
                    newBlock.content = '<p>Введите текст описания...</p>';
                } else if (type === 'image') {
                    newBlock.url = '';
                    newBlock.title = '';
                    newBlock.caption = '';
                } else if (type === 'gallery') {
                    newBlock.title = 'Галерея скриншотов';
                    newBlock.images = [{ url: '', title: '' }];
                } else if (type === 'video') {
                    newBlock.url = '';
                    newBlock.title = '';
                } else if (type === 'fab_button') {
                    newBlock.title = 'Приобрести на Fab.com';
                    newBlock.url = '';
                    newBlock.price = '';
                    newBlock.badge = 'Fab Marketplace';
                } else if (type === 'specs') {
                    newBlock.items = [
                        { label: 'Версии движка', value: 'Unreal Engine 5.3 - 5.5' },
                        { label: 'Платформы', value: 'Windows, Mac, Consoles' }
                    ];
                } else if (type === 'code') {
                    newBlock.language = 'cpp';
                    newBlock.title = 'Example.cpp';
                    newBlock.code = '';
                }

                this.blocks.push(newBlock);
            },

            removeBlock(index) {
                if (confirm('Удалить этот блок?')) {
                    this.blocks.splice(index, 1);
                }
            },

            moveUp(index) {
                if (index > 0) {
                    const temp = this.blocks[index];
                    this.blocks[index] = this.blocks[index - 1];
                    this.blocks[index - 1] = temp;
                }
            },

            moveDown(index) {
                if (index < this.blocks.length - 1) {
                    const temp = this.blocks[index];
                    this.blocks[index] = this.blocks[index + 1];
                    this.blocks[index + 1] = temp;
                }
            },

            addSpecRow(blockIndex) {
                if (!this.blocks[blockIndex].items) {
                    this.blocks[blockIndex].items = [];
                }
                this.blocks[blockIndex].items.push({ label: '', value: '' });
            },

            removeSpecRow(blockIndex, rowIndex) {
                this.blocks[blockIndex].items.splice(rowIndex, 1);
            },

            addGalleryItem(blockIndex) {
                if (!this.blocks[blockIndex].images) {
                    this.blocks[blockIndex].images = [];
                }
                this.blocks[blockIndex].images.push({ url: '', title: '' });
            },

            removeGalleryItem(blockIndex, imgIndex) {
                this.blocks[blockIndex].images.splice(imgIndex, 1);
            }
        };
    }
</script>
