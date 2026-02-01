<?php

use Livewire\Component;
use App\Models\Proposal;

new class extends Component {
    public $data = [];
    public function mount($slug)
    {
        $proposal = Proposal::where('slug', $slug)->firstOrFail();
        $this->data = [
            's' => $proposal->sender,
            'r' => $proposal->recipient,
            'm' => $proposal->message,
            'p' => $proposal->password,
        ];
    }
};
?>

<div x-data="{
        isLocked: false,
        userPass: '',
        correctPassword: '{{ $data['p'] }}',
        passwordError: false,
        accepted: false,
        index: 0,
        displayedText: '',
        fullText: `{{ $data['m'] }}`,
        isCapturing: false,
        rejectX: 0, rejectY: 0,
        audio: new Audio('https://www.soundjay.com/communication/typewriter-key-1.mp3'),

        checkPassword() {
            if (this.userPass.toLowerCase() === this.correctPassword.toLowerCase()) {
                this.isLocked = false;
            } else {
                this.passwordError = true;
                setTimeout(() => this.passwordError = false, 500);
                this.userPass = '';
            }
        },


        moveButton() {
            const pad = 100;
            this.rejectX = Math.random() * (window.innerWidth - pad * 2) - (window.innerWidth / 2 - pad);
            this.rejectY = Math.random() * (window.innerHeight - pad * 2) - (window.innerHeight / 2 - pad);
        },

        startTypewriter() {
            if (this.index < this.fullText.length) {
                this.displayedText += this.fullText.charAt(this.index);

                // Play sound every few characters to avoid audio overlap lag
                if (this.index % 2 === 0) {
                    this.audio.currentTime = 0;
                    this.audio.play().catch(() => {});
                }

                this.index++;
                setTimeout(() => this.startTypewriter(), 50);
            }
        },

        async share() {
            if (navigator.share) {
                await navigator.share({
                    title: 'A Secret Valentine',
                    text: '{{ $data['s'] }} sent you a vintage love proposal! ❤️',
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert('Link copied to clipboard!');
            }
        },

        capture() {
            this.isCapturing = true;
            const letter = document.getElementById('letter-content');

            setTimeout(() => {
                html2canvas(letter, {
                    backgroundColor: '#fcf8ef',
                    scale: 3,
                    useCORS: true,
                    height: letter.scrollHeight,
                    windowHeight: letter.scrollHeight
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'Our-Valentine-Memory.png';
                    link.href = canvas.toDataURL();
                    link.click();
                    this.isCapturing = false;
                });
            }, 400);
        }
    }" class="fixed inset-0 flex flex-col items-center justify-center p-4">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1518199266791-5375a83190b7?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover blur-xl brightness-[0.3]">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <template x-if="isLocked">
        <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-[#0a0505]">

            <div :class="!isLocked ? '-translate-x-full' : 'translate-x-0'"
                class="absolute left-0 top-0 w-1/2 h-full bg-[#1a0f0f] border-r-4 border-[#8b0000] transition-transform duration-[1500ms] ease-in-out z-20 flex items-center justify-end overflow-hidden">
                <div class="opacity-10 text-[20rem] absolute -right-20 pointer-events-none">❤</div>
            </div>

            <div :class="!isLocked ? 'translate-x-full' : 'translate-x-0'"
                class="absolute right-0 top-0 w-1/2 h-full bg-[#1a0f0f] border-l-4 border-[#8b0000] transition-transform duration-[1500ms] ease-in-out z-20 flex items-center justify-start overflow-hidden">
                <div class="opacity-10 text-[20rem] absolute -left-20 pointer-events-none">❤</div>
            </div>

            <div class="relative z-30 text-center px-6 max-w-sm w-full animate-fade-in">
                <div class="mb-8 relative flex justify-center">
                    <div
                        class="w-24 h-24 rounded-full border-2 border-[#8b0000] flex items-center justify-center text-[#8b0000] bg-[#1a0f0f] shadow-[0_0_30px_rgba(139,0,0,0.3)]">
                        <span class="text-4xl" :class="passwordError ? 'animate-bounce' : ''">🔒</span>
                    </div>
                    <svg class="absolute -inset-4 animate-spin-slow opacity-40" viewBox="0 0 100 100">
                        <path id="gatePath" d="M 50, 50 m -40, 0 a 40,40 0 1,1 80,0 a 40,40 0 1,1 -80,0" fill="none" />
                        <text font-size="7" fill="#8b0000" class="uppercase tracking-widest">
                            <textPath xlink:href="#gatePath">A Private Letter • For Your Eyes Only • </textPath>
                        </text>
                    </svg>
                </div>

                <h2 class="font-['Pinyon_Script'] text-5xl text-white mb-2 leading-tight">The Secret Word</h2>
                <p class="text-white/30 text-[10px] uppercase tracking-[0.4em] mb-10">Locked with Love</p>

                <div class="space-y-6">
                    <input type="password" x-model="userPass" @keyup.enter="checkPassword()" placeholder="••••••"
                        :class="passwordError ? 'animate-shake border-red-600' : 'border-white/20'"
                        class="bg-transparent border-b-2 text-center text-white text-3xl outline-none py-2 px-4 transition-all font-serif italic w-full focus:border-[#8b0000] placeholder:text-white/5">

                    <button @click="checkPassword()"
                        class="group relative w-full py-4 overflow-hidden border border-[#8b0000] text-white transition-all hover:bg-[#8b0000]">
                        <span class="relative z-10 font-bold uppercase tracking-[0.3em] text-[10px]">Unlock
                            Letter</span>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <div x-show="!isLocked && !accepted" x-transition.opacity.duration.1000ms class="relative z-10 text-center px-6">
        <h1 class="font-['Pinyon_Script'] text-7xl md:text-9xl text-white mb-6 drop-shadow-lg">For {{ $data['r'] }}</h1>
        <p class="text-white/60 uppercase tracking-[0.4em] text-xs mb-12">Will you be my Valentine?</p>
        <div class="flex flex-col md:flex-row items-center justify-center gap-6">
            <button @click="accepted = true; setTimeout(() => startTypewriter(), 1000)"
                class="px-16 py-4 bg-[#8b0000] text-white rounded-full text-xl font-bold shadow-[0_0_20px_rgba(139,0,0,0.5)] hover:scale-110 transition-all active:scale-95">YES!
                ❤️</button>
            <button @mouseover="moveButton()" @touchstart.prevent="moveButton()"
                :style="`transform: translate(${rejectX}px, ${rejectY}px)`"
                class="text-white/30 border border-white/10 px-8 py-3 rounded-full transition-all duration-200 cursor-default">No...</button>
        </div>
    </div>

    <div x-show="accepted" x-cloak class="relative z-20 w-full max-w-xl flex flex-col items-center">

        <div id="letter-content" :class="isCapturing ? 'max-h-none h-auto' : 'max-h-[65vh] h-full'"
            class="bg-[#fcf8ef] shadow-2xl relative border-b-[12px] border-[#6d0000] flex flex-col overflow-hidden animate-zoom-in">

            <div class="absolute inset-0 opacity-[0.06] pointer-events-none"
                style="background-image: url('https://www.transparenttextures.com/patterns/paper-fibers.png');"></div>

            <div class="p-8 md:p-12 overflow-y-auto vintage-scroll relative z-10">
                <header class="border-b border-[#6d0000]/10 pb-4 mb-6">
                    <h2 class="font-['Pinyon_Script'] text-5xl text-[#6d0000]">My Dearest {{ $data['r'] }},</h2>
                </header>

                <p class="text-[#2c1a1a] text-xl md:text-2xl italic leading-relaxed font-serif whitespace-pre-wrap">
                    <span x-text="displayedText"></span>
                    <span class="inline-block w-1 h-6 bg-[#6d0000] animate-pulse"
                        x-show="index < fullText.length">|</span>
                </p>

                <footer class="mt-8 text-right font-['Pinyon_Script'] text-4xl text-[#6d0000]">
                    — {{ $data['s'] }}
                </footer>
            </div>

            <div
                class="absolute -bottom-4 -right-4 w-20 h-20 bg-[#8b0000] rounded-full flex items-center justify-center border-4 border-[#a00000] shadow-lg transform rotate-12">
                <span class="text-white text-3xl">❤</span>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap justify-center gap-4 animate-fade-in" style="animation-delay: 2.5s;">
            <button @click="capture()"
                class="bg-white/10 border border-white/20 text-white px-6 py-2 rounded-full text-[10px] uppercase tracking-widest hover:bg-white/20 transition-all">📸
                Save Image</button>
            <button @click="share()"
                class="bg-[#8b0000] text-white px-8 py-2 rounded-full text-[10px] uppercase tracking-widest font-bold shadow-lg hover:bg-red-800 transition-all">🚀
                Share Proposal</button>
        </div>
    </div>
</div>
<style>
    [x-cloak] {
        display: none !important;
    }

    .vintage-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .vintage-scroll::-webkit-scrollbar-thumb {
        background: #6d0000;
        border-radius: 10px;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-8px);
        }

        75% {
            transform: translateX(8px);
        }
    }

    .animate-shake {
        animation: shake 0.2s ease-in-out 0s 2;
    }
</style>
