<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>SIPINJAM - Login</title>
   <style>
   </style>
   
</head>
<body>

   <!-- source:https://codepen.io/owaiswiz/pen/jOPvEPB -->
<div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="flex-1 bg-blue-100 text-center hidden lg:flex">
            <div>
                <img src="./Sources/Img/LogoPolines.png">
            </div>
            <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat">
                <img src="./Sources/Img/gedungkuliah-terpadu.png">
            </div>
        </div>
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class="mt-12 flex flex-col items-center">
                <div class="w-full flex-1 mt-8">
                    <div class="my-12 border-b text-center">
                        <div class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
                            Sign In with E-mail
                        </div>
                    </div>

                    <div class="mx-auto max-w-xs">
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="email" placeholder="Email" />
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            type="password" placeholder="Password" />
                        <button
                            class="mt-5 tracking-wide font-semibold bg-yellow-400 text-white-500 w-full py-4 rounded-lg hover:bg-yellow-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <path d="M20 8v6M23 11h-6" />
                            </svg>
                            <span class="ml-">
                                Sign In
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>