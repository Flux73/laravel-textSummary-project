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
    <body class="text-slate-900">
        <form action={{ route('text.summarizeText') }} method="post">
            @csrf
            <textarea class="border-emerald-700 border-2 rounded-lg focus:outline-none px-4 py-3 text-lg max-w-lg" name="inputed_text" cols="30" rows="10"></textarea>
            <button class="bg-emerald-900 text-emerald-50">Submit</button>
        </form>
        @if (isset($result))
        <input type="hidden" id="result" value="{{ $result }}">
        @endif
        <h1 id="te"></h1>
    </body>
</html>