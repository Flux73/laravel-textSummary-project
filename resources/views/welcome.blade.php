<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="flex items-center justify-center h-screen text-lg  font-medium" >
    <div class="bg-emerald-50 shadow-xl p-10 rounded-lg max-w-4xl">
        <h1 class=" text-3xl font-black text-emerald-900  text-center mb-12">You have the option to use the tool in two ways :</h1>
        <div class="container flex flex-col gap-4 mb-7">
            <div class="flex gap-2">
                <div class="container flex items-center justify-center rounded-full w-10 h-10 bg-fuchsia-200 text-fuchsia-900" >
                    <span class="font-bold text-xl">1</span>
                </div>
                <p>
                    Use the text summarizing tool without creating an account. Note that access to other app features requires an account.
                    
                </p>
            </div> 
            <div class="flex gap-2 items-center">
                <div class="container flex items-center justify-center rounded-full w-10 h-10 bg-blue-200 text-blue-900 "  >
                    <span class="font-bold text-xl">2</span>
                </div>
                <p>
                    Create a complete free account to access all features besides the tool.
                </p>
            </div>
        </div>
        <div class="container flex flex-col gap-4 font-bold">
            <a class="border-2 border-fuchsia-600 text-fuchsia-600 hover:bg-fuchsia-200 transition-all text-center rounded-md py-5" href="{{ route('home') }}">Continue Without An Account</a>
            <a class="bg-blue-600 text-gray-50 hover:bg-blue-700 transition-all text-center rounded-md py-5" href="{{ route('register') }}">Create My Account</a>
            <p class="text-center font-medium text-gray-500">Already have one! simply log in.</p>
            <a class="border-2 border-blue-600 hover:bg-blue-200 transition-all text-blue-600 text-center rounded-md py-5" href="{{ route('login') }}">Log In</a>
        </div>
    </div>
</body>
</html>