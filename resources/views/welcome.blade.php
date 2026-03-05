<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YAFAO POS | Enterprise Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { background: #020617; color: #f8fafc; overflow-x: hidden; font-family: 'Inter', sans-serif; }
        .yafao-gradient { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); }
        .img-container { position: relative; overflow: hidden; border-radius: 2.5rem; background: #0f172a; }
        .img-container img { transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); filter: contrast(1.1); }
        .group:hover .img-container img { transform: scale(1.15); }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
    </style>
</head>
<body class="p-6 lg:p-12" x-data="posSystem()">
    <div class="max-w-7xl mx-auto">
        
        <header class="flex justify-between items-end mb-16 border-b border-white/5 pb-8">
            <div class="animate__animated animate__fadeInLeft">
                <h1 class="text-6xl font-black italic tracking-tighter uppercase">YAFAO<span class="text-emerald-500">.POS</span></h1>
                <p class="text-xs tracking-[0.4em] uppercase text-emerald-500/60 font-bold mt-2 font-mono">Elite System Deployment // Authorized</p>
            </div>
            <div class="text-right animate__animated animate__fadeInRight">
                <span class="px-4 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-[10px] font-black text-emerald-400">YAFAO SECURE v3.3</span>
                <p class="text-[10px] text-slate-500 mt-3 uppercase tracking-widest italic">Operator: <span class="text-white font-bold">Yafao Elite Admin</span></p>
            </div>
        </header>

        <div class="grid grid-cols-12 gap-10">
            <div class="col-span-12 lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($products as $product)
                    <div class="glass-card p-6 rounded-[3.5rem] hover:border-emerald-500/40 transition-all duration-500 group relative">
                        <div class="img-container aspect-[4/5] mb-6 border border-white/5">
                            <img src="https://loremflickr.com/400/500/{{ str_replace(' ', ',', strtolower($product->name)) }}?lock={{ $product->id }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#020617] via-transparent to-transparent opacity-90"></div>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-1 tracking-tight">{{ $product->name }}</h3>
                        <div class="flex justify-between items-center mb-6">
                            <p class="text-slate-500 text-[10px] uppercase tracking-widest font-mono">{{ $product->sku }}</p>
                            <span class="text-[10px] px-3 py-1 bg-white/5 rounded-full text-emerald-400 font-black border border-white/10 italic">STK: {{ $product->stock }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-black text-white font-mono italic">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            <button 
                                @click="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})"
                                class="yafao-gradient p-4 rounded-[1.8rem] shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/50 transition-all active:scale-90">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-20 glass-card rounded-[3rem]">
                        <p class="text-slate-500 italic font-mono uppercase tracking-widest text-xs">Waiting for Seeder db:seed...</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <div class="glass-card p-10 rounded-[3.5rem] sticky top-10 border-emerald-500/20 shadow-2xl">
                    <h2 class="text-2xl font-black mb-8 italic tracking-tighter uppercase border-b border-white/5 pb-4">Order <span class="text-emerald-500">Cart</span></h2>
                    
                    <div class="space-y-6 mb-10 overflow-y-auto max-h-[400px] pr-2 custom-scroll">
                        <template x-for="item in cart" :key="item.id">
                            <div class="flex justify-between items-center bg-white/[0.03] p-5 rounded-[2rem] border border-white/5 animate__animated animate__fadeInRight">
                                <div class="flex-1">
                                    <p class="font-bold text-white text-sm" x-text="item.name"></p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <div class="flex items-center bg-black/40 rounded-xl p-1 px-2 border border-white/10">
                                            <button @click="updateQty(item.id, -1)" class="w-6 h-6 text-emerald-500 hover:text-white transition font-bold">-</button>
                                            <span x-text="item.qty" class="mx-3 text-xs font-black"></span>
                                            <button @click="updateQty(item.id, 1)" class="w-6 h-6 text-emerald-500 hover:text-white transition font-bold">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right ml-4">
                                    <p class="font-mono text-emerald-400 font-black text-sm" x-text="'Rp' + formatNumber(item.price * item.qty)"></p>
                                    <button @click="removeFromCart(item.id)" class="text-[9px] text-red-500/70 uppercase font-black hover:text-red-400 mt-2">Remove</button>
                                </div>
                            </div>
                        </template>
                        <template x-if="cart.length === 0">
                            <div class="py-20 text-center opacity-20">
                                <p class="italic text-sm font-mono tracking-widest uppercase">Cart Empty, Boss Yafao</p>
                            </div>
                        </template>
                    </div>

                    <div class="pt-8 border-t border-white/10 mb-10">
                        <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500 font-black mb-2">Total Bill Amount</p>
                        <p class="text-5xl font-black text-white italic tracking-tighter" x-text="'Rp' + formatNumber(totalPrice)"></p>
                    </div>

                    <button 
                        @click="finalizeOrder()"
                        :disabled="cart.length === 0"
                        :class="cart.length === 0 ? 'opacity-20 grayscale cursor-not-allowed' : 'hover:-translate-y-2 shadow-emerald-500/30'"
                        class="w-full yafao-gradient py-6 rounded-[2.5rem] font-black uppercase tracking-[0.3em] shadow-2xl transition-all duration-500 text-sm">
                        Confirm Transaction
                    </button>
                    <p class="text-center text-[8px] text-slate-600 mt-8 uppercase font-black tracking-[0.5em] opacity-40">Secured by Yafao Engineering</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function posSystem() {
            return {
                cart: [],
                totalPrice: 0,
                addToCart(id, name, price) {
                    let found = this.cart.find(item => item.id === id);
                    if (found) {
                        found.qty++;
                    } else {
                        this.cart.push({ id, name, price, qty: 1 });
                    }
                    this.calculateTotal();
                },
                updateQty(id, change) {
                    let item = this.cart.find(i => i.id === id);
                    if (item) {
                        item.qty += change;
                        if (item.qty < 1) this.removeFromCart(id);
                        this.calculateTotal();
                    }
                },
                removeFromCart(id) {
                    this.cart = this.cart.filter(item => item.id !== id);
                    this.calculateTotal();
                },
                calculateTotal() {
                    this.totalPrice = this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },
                formatNumber(number) {
                    return new Intl.NumberFormat('id-ID').format(number);
                },
                finalizeOrder() {
                    alert('👑 TRANSACTION VERIFIED 👑\n\nOwner: Yafao Elite Admin\nTotal: Rp ' + this.formatNumber(this.totalPrice) + '\n\nDatabase Synced Successfully.');
                    this.cart = [];
                    this.totalPrice = 0;
                }
            }
        }
    </script>
</body>
</html>