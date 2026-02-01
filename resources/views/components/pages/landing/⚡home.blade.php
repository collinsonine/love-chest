<?php

use Livewire\Component;
use App\Models\Proposal;
use Illuminate\Support\Str;

new class extends Component {
    public $sender, $recipient, $message, $gender, $password;
    public $generatedUrl;

    protected $rules = [
        'sender' => 'required|string|max:50',
        'recipient' => 'required|string|max:50',
        'message' => 'required|string|max:500',
        'password' => 'nullable|string|max:20',
    ];

    public function generate()
    {
        $this->validate();

        $slug = Str::random(6);

        Proposal::create([
            'slug' => $slug,
            'sender' => $this->sender,
            'recipient' => $this->recipient,
            'message' => $this->message,
            'gender' => $this->gender,
            'password' => $this->password,
        ]);

        $this->generatedUrl = route('valentine.show', $slug);
    }
};
?>

<div>
    <div class="min-h-screen bg-[#1a0f0f] flex items-center justify-center p-4 relative overflow-hidden font-serif"
        style="background: radial-gradient(circle, #2c1a1a 0%, #0a0505 100%);">

        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1518199266791-5375a83190b7?q=80&w=2070&auto=format&fit=crop"
                class="w-full h-full object-cover scale-110 blur-xl brightness-[0.4]" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black opacity-60"></div>
        </div>

        <div class="relative max-w-2xl w-full">
            @if(!$generatedUrl)
                <div class="bg-[#f2e8cf] p-10 shadow-2xl transform -rotate-1 relative group transition-transform hover:rotate-0 duration-500"
                    style="box-shadow: 5px 5px 20px rgba(0,0,0,0.5), inset 0 0 100px rgba(139,0,0,0.05);">

                    <div class="absolute inset-0 border-[12px] border-transparent"
                        style="border-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2250%22 height=%2250%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.7%22/></filter><rect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23n)%22 opacity=%220.2%22/></svg>') 30 stretch;">
                    </div>

                    <h1 class="font-['Pinyon_Script'] text-6xl text-[#5d0000] text-center mb-8">Dearest Valentine...</h1>

                    <form wire:submit.prevent="generate" class="space-y-6 relative z-10">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="border-b-2 border-[#8b0000]/30 py-2">
                                <label class="uppercase text-[10px] tracking-widest text-gray-500 block">From the desk
                                    of</label>
                                <input wire:model="sender" type="text" placeholder="Your Name"
                                    class="bg-transparent w-full font-serif text-lg outline-none text-[#2c1a1a] placeholder-[#8b0000]/20">
                            </div>
                            <div class="border-b-2 border-[#8b0000]/30 py-2">
                                <label class="uppercase text-[10px] tracking-widest text-gray-500 block">Intended
                                    for</label>
                                <input wire:model="recipient" type="text" placeholder="Their Name"
                                    class="bg-transparent w-full font-serif text-lg outline-none text-[#2c1a1a] placeholder-[#8b0000]/20">
                            </div>
                        </div>

                        <div class="border-b-2 border-[#8b0000]/30 py-2">
                            <label class="uppercase text-[10px] tracking-widest text-gray-500 block">A confession of
                                love</label>
                            <textarea wire:model="message" rows="4" placeholder="My heart beats only for..."
                                class="bg-transparent w-full font-serif text-lg outline-none text-[#2c1a1a] resize-none placeholder-[#8b0000]/20"></textarea>
                        </div>

                        <div class="pt-4 border-t border-[#6d0000]/10">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 block mb-2">Protect with a
                                Secret Word (Optional)</label>
                            <input wire:model="password" type="text" placeholder="e.g. OurAnniversary"
                                class="bg-transparent border-b border-[#6d0000]/20 py-1 outline-none focus:border-[#6d0000] text-sm w-full">
                        </div>

                        <div class="flex justify-center pt-4">
                            <button type="submit" class="relative group cursor-pointer">
                                <div
                                    class="w-20 h-20 bg-[#8b0000] rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-white text-3xl">❤</span>
                                    <svg class="absolute inset-0 animate-spin-slow opacity-20" viewBox="0 0 100 100">
                                        <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"
                                            fill="none" />
                                        <text font-size="8" fill="white" font-family="serif">
                                            <textPath xlink:href="#circlePath">SEAL WITH LOVE • SEAL WITH LOVE • </textPath>
                                        </text>
                                    </svg>
                                </div>
                                <span
                                    class="block mt-2 text-[10px] tracking-[0.3em] uppercase text-[#8b0000] font-bold text-center">Seal
                                    & Encode</span>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-[#f2e8cf] p-10 text-center shadow-2xl border-2 border-[#8b0000]/20 animate-fade-in" x-data="{
                                        shareData: {
                                            title: 'A Secret Letter for {{ $recipient }}',
                                            text: 'Hey {{ $recipient }}, {{ $sender }} sent you a vintage love proposal! ❤️\n\nLink: {{ $generatedUrl }}' +
                                                  ('{{ $password }}' ? '\nSecret Word: {{ $password }}' : ''),
                                            url: '{{ $generatedUrl }}'
                                        }
                                     }">

                    <div
                        class="w-16 h-16 bg-[#8b0000] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-white text-3xl">✉</span>
                    </div>

                    <h2 class="italic font-serif text-2xl text-[#2c1a1a] mb-2">The letter has been sealed...</h2>
                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-8 font-sans">Ready to be sent to your
                        beloved.</p>

                    <div class="space-y-4">
                        <button
                            @click="if(navigator.share) { navigator.share(shareData) } else { copyFormatted('{{ $generatedUrl }}', '{{ $recipient }}', '{{ $password }}') }"
                            class="w-full bg-[#8b0000] text-white py-4 font-bold tracking-[0.2em] uppercase text-sm hover:bg-black transition-colors flex items-center justify-center gap-2">
                            <span>🚀</span> Direct Share
                        </button>

                        <button onclick="copyFormatted('{{ $generatedUrl }}', '{{ $recipient }}', '{{ $password }}')"
                            class="w-full border-2 border-[#8b0000] text-[#8b0000] py-4 font-bold tracking-[0.2em] uppercase text-sm hover:bg-[#8b0000] hover:text-white transition-all">
                            📋 Copy Message & Password
                        </button>
                    </div>

                    <button wire:click="$set('generatedUrl', null)"
                        class="mt-12 text-[#8b0000] opacity-50 hover:opacity-100 hover:underline uppercase text-[10px] tracking-[0.3em] font-bold block mx-auto">
                        Draft another letter
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function copyFormatted(url, recipient, password) {
        let message = `Hey ${recipient}, I've sent you a secret message! ❤️\n\nLink: ${url}`;
        if (password) {
            message += `\nSecret Word: ${password}`;
        }

        navigator.clipboard.writeText(message).then(() => {
            alert("The sweet message and password have been copied to your clipboard!");
        });
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

    .animate-spin-slow {
        animation: spin 10s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
