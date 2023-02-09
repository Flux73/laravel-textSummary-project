<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <title>Text - Summary</title>
    </head>
    <body class="text-slate-900 text-lg">
        <x-nav-bar></x-nav-bar>
        <section class="py-28">
            <header class="max-w-6xl mx-auto">
                <h1 class=" text-emerald-900 font-black text-5xl text-center leading-tight"><span class="block">AI-Powered Text Summarization Tool :</span>  Simplify Your Reading Experience</h1>
            </header>
        </section>
        <main>

            <section class="py-28">
                <div class="max-w-6xl mx-auto">
                    <form id="textForm" class="container flex flex-col gap-3 mb-10" action={{ route('home.summarizeText') }} method="post">
                        @csrf
                        <label for="inputed_text" class="text-emerald-900 font-bold text-xl ml-2">Text</label>
                        <textarea id="inputed_text" class="mb-5 tracking-wide font-medium ring-2 border-none ring-emerald-900 focus:ring-2 focus:ring-emerald-900 focus:outline focus:outline-8 focus:outline-emerald-200/60 transition-all rounded-lg px-8 py-4 text-lg max-h-72 placeholder:opacity-80" name="inputed_text" cols="30" rows="10" placeholder="Text, Paragraph, Blog ...">{{ app('request')->input('original') ? app('request')->input('original') : "" }}</textarea>
                        <div class="flex gap-3 self-center items-center">
                            <button id="summarizeBtn" class="bg-emerald-800 hover:bg-emerald-900 transition-all text-emerald-50 py-4 px-14 font-extrabold tracking-wide rounded-lg">
                                Summarize
                            </button>
                            <a class="ring-2 ring-inset ring-slate-700 text-slate-700 bg-slate-200 hover:bg-slate-300 transition-all py-4 px-14 font-extrabold tracking-wide rounded-lg" href="{{ route('home') }}">Reset</a>
                        </div>                   
                </form>
                @if (app('request')->input('result'))
                <input type="hidden" id="result" value="{{ app('request')->input('result') }}">
                @else
                <input type="hidden" id="result" value="">
                @endif
                <div>
                    <p class="text-emerald-900 font-bold text-xl mb-4 ml-2">Summary</p>
                    <div id="summary" class="ring-2 tracking-wide ring-emerald-900 h-72 rounded-lg px-8 py-4 overscroll-auto bg-emerald-50/70 font-medium"></div>
                </div>
            </div>
        </section>
    </main>
    <x-footer></x-footer>
    </body>
    </html>