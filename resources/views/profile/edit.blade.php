<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/profile.js')
    <title>Document</title>
</head>
<body class="text-slate-900 text-lg">
    <x-nav-bar></x-nav-bar>
    <main>
        <section class="py-16 mb-12">
            <div class="max-w-5xl mx-auto">
                <h2 class="mb-12 font-extrabold text-emerald-900 text-3xl">My Texts</h2>
                <div class="mb-8 px-2 py-2 flex items-center border-b-2 border-gray-300">
                    <div class="flex items-center gap-4">
                        <p class=" font-medium">Results :
                            <span class=" text-3xl font-semibold text-emerald-900">
                                @if (count($texts) > 0)
                                {{ count($texts) }}
                                @else
                                {{ 0 }}
                                @endif
                            </span>
                        </p>
                        <a class=" self-end text-emerald-700 hover:text-emerald-600" href="{{ route('profile.edit') }}">Reset Sort</a>
                    </div>
                    <div class="ml-auto flex gap-5 items-center">
                        <a href="{{ URL::current() }}?sort=starred"><ion-icon class="h-7 w-7 hover:scale-110 active:scale-90 transition-all delay-150 fill-amber-400" name="star"></ion-icon></a>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-6 py-3 border border-transparent leading-4 font-medium rounded-md text-emerald-50 bg-emerald-700 hover:bg-emerald-800  focus:outline-none transition ease-in-out duration-150">
                                    <div>Sort By</div>
            
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                            <a class="block w-full px-4 py-2 text-left text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out font-semibold" href="{{ URL::current() }}?sort=newest">Newest To Oldest</a>
                            <a class="block w-full px-4 py-2 text-left text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out font-semibold" href="{{ URL::current() }}?sort=oldest">Oldest To Newest</a>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    @if(count($texts) == 0)
                        <p class="font-black text-4xl text-center text-gray-400/60">No Results Were Found</p>
                    @else
                        @foreach ($texts as $text)
                        <div class="hover:bg-slate-200 transition-all delay-150 hover:scale-105 flex items-center bg-slate-100 py-5 px-5 rounded-lg gap-2 shadow cursor-pointer textContainer" style="backface-visibility: hidden">
                            <span class="font-bold text-3xl text-emerald-900">{{ $loop->index + 1 }}</span>
                            <p class=" self-end mb-0.5">{{ Str::of($text->text)->words(10) }}</p>
                            <div class="flex gap-2 ml-auto">
                                <form action="{{ route('profile.edit.starred', ['id' => $text->id]) }}" method="POST">
                                    @csrf
                                    @method("PATCH")
                                    <button >
                                        @if($text->is_starred) 
                                        <ion-icon id="starBtn" class="h-7 w-7 hover:scale-110 active:scale-90 transition-all delay-150 {{ $text->is_starred ? 'fill-amber-400 stroke-none' : '' }}" name="star"></ion-icon>
                                        @else
                                        <ion-icon id="starBtn" class="h-7 w-7 hover:scale-110 active:scale-90 transition-all delay-150" name="star-outline"></ion-icon>
                                        @endif
                                    </button>
                                </form>
                                
                                <form action="{{ route('profile.delete.text', ['id' => $text->id]) }}" method="POST">
                                        @csrf
                                    @method("DELETE")
                                    <button >
                                        <ion-icon id="trashBtn" class="h-7 w-7 hover:scale-110 active:scale-90 transition-all delay-150 text-red-500" name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    @endempty
                </div>
            </div>
        </section>
        {{-- Delete Account --}}
        <section class="py-16">
            <div class="max-w-5xl mx-auto">
                <h2 class="mb-12 font-extrabold text-rose-700 text-3xl">Danger Zone</h2>
                    <div class="p-4 sm:p-8 bg-gradient-to-r from-red-500 to-rose-500 shadow rounded-xl text-white">
                        @include('profile.partials.delete-user-form')
                    </div>
        </section>
    </main>
     @if(count($texts) > 0)
            @foreach ($texts as $text)
                <div id="modal-{{ $loop->index }}" class=" p-8 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 bg-white w-2/3 rounded-2xl shadow-lg hidden">
                    <div class="flex gap-2 mb-10">
                        <span class="font-bold text-3xl text-emerald-900">{{ $loop->index + 1 }}</span>
                        <p class=" self-end mb-0.5">{{ Str::of($text->text)->words(10) }}</p>
                        <div class="ml-auto flex items-center gap-4">
                            <p class=" text-emerald-900 font-semibold">{{ $text->created_at->diffForHumans() }}</p>
                            <button id="close-{{ $loop->index }}">Close</button>
                        </div>
                    </div>
                    <div>
                        <div class=" mb-8">
                            <p class="text-emerald-900 font-bold text-xl mb-4 ml-2">Original Text</p>
                            <div id="original-{{$loop->index}}" class="ring-2 tracking-wide ring-emerald-900 h-72 rounded-lg px-8 py-4 overscroll-auto bg-emerald-50/20 font-medium">{{ $text->text }}</div>
                        </div> 
                        <div>
                            <p class="text-emerald-900 font-bold text-xl mb-4 ml-2">Summary</p>
                            <div id="summary-{{$loop->index}}" class="ring-2 tracking-wide ring-emerald-900 h-72 rounded-lg px-8 py-4 overscroll-auto bg-emerald-50/20 font-medium">{{$text->text_summary}}</div>
                        </div> 
                    </div>
                </div>
            @endforeach
        @endif
        <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-emerald-900/50 backdrop-blur z-10 hidden"></div>
    <x-footer></x-footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>


