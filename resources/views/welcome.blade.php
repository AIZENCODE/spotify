<!DOCTYPE html>
<html x-data :class="$store.darkMode.on && 'dark'" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icono de spotify --}}
    <link rel="shortcut icon" href="{{ asset('img/icons/spotify.ico') }}" type="image/x-icon">
    {{--  --}}

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--  --}}

    <title>Spotify - clone</title>


    <!-- Fontawesome -->

    <script src="https://kit.fontawesome.com/925f4b0807.js" crossorigin="anonymous"></script>
    <!-- Scripts -->

    <!-- Alpine Persist Plugin -->
    <script src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Code -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>



    <style>
        * {
            /* outline: 1px solid red; */
        }
    </style>
</head>

<body class="bg-white dark:bg-black relative justify-center items-center">


    <div x-data="data()" x-init="start()"
        @resize.window="open = window.outerWidth > 1280 ? true : false " class="spotify__container h-screen p-3">



        <nav x-show="open" x-on:click.away=""
            class="row-span-2  me-2 flex flex-col gap-2 fixed xl:relative z-50 bg-white dark:bg-black xl:bg-none h-full pe-3 xl:pe-0 ">

            <div class="nav__principal card__spotify font-medium tracking-wide">


                <ul class="grid gap-5 text-black dark:text-white">

                    <button x-on:click="isOpen()" type="button"
                        class=" grid xl:hidden  
                    items-end p-2  place-items-center rounded-full  md:ms-0 w-10 h-10 bg-black scale-[0.95] hover:scale-[1] hover:bg-black-spotify-500 text-white hover:text-mountain-meadow-500 transition-all duration-200 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <li>
                        <a class="flex gap-5 items-center " href="" aria-label="Inicio">
                            <svg class="nav__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path
                                    d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                <path
                                    d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                            </svg>
                            Inicio

                        </a>
                    </li>
                    <li>
                        <a class="flex gap-5 items-center" href="">
                            <svg class="nav__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                                    clip-rule="evenodd" />
                            </svg>

                            Buscar

                        </a>
                    </li>
                </ul>

            </div>

            <div class="nav__secondary card__spotify h-full flex flex-col gap-2 items-start">
                <div class="flex justify-between text-black-spotify-400 w-full">
                    <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                            clip-rule="evenodd" />
                    </svg>

                    <div class="flex justify-center">
                        <div x-data="{
                            open: false,
                            toggle() {
                                if (this.open) {
                                    return this.close()
                                }
                        
                                this.$refs.button.focus()
                        
                                this.open = true
                            },
                            close(focusAfter) {
                                if (!this.open) return
                        
                                this.open = false
                        
                                focusAfter && focusAfter.focus()
                            }
                        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['dropdown-button']" class="relative">
                            <!-- Button -->
                            <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                :aria-controls="$id('dropdown-button')" type="button"
                                class="flex items-center gap-2 text-sm  rounded-md font-medium ">
                                Options

                                <!-- Heroicon: chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Panel -->
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                style="display: none;"
                                class="absolute left-0 mt-2 w-56 rounded-md bg-black-spotify-800 shadow-md text-white font-medium">
                                <a href="#"
                                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-black-spotify-600 disabled:text-gray-500">
                                    <span class="text-mountain-meadow-500">Recientes </span>
                                </a>

                                <a href="#"
                                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-black-spotify-600 disabled:text-gray-500">
                                    Agregados recientemente
                                </a>

                                <a href="#"
                                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-black-spotify-600  disabled:text-gray-500">
                                    Alfabeticamente
                                </a>
                                <a href="#"
                                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-black-spotify-600  disabled:text-gray-500">
                                    Creador
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                                    out</a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="list__filtros h-full w-full text-black dark:text-white">



                    <div
                        class="list__filtro grid items-start w-full p-2  rounded-lg overflow-hidden hover:bg-zinc-200 dark:hover:bg-zinc-900 transition-colors duration-200 cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <figure class="w-12 h-12 rounded-lg overflow-hidden">
                                <img src="{{ asset('img/biblioteca/img2.png') }}" class="w-full object-cover"
                                    alt="">
                            </figure>

                            <div class="itemlist__text flex flex-col gap-1">
                                <h2 class="font-medium">Tus me gusta</h2>
                                <span class="flex text-sm gap-3">
                                    <i class="fa-solid fa-thumbtack rotate-45 text-mountain-meadow-400"></i>
                                    <p class="text-black-spotify-400 font-semibold ">Lista • 295 canciones</p>
                                </span>

                            </div>

                        </div>
                    </div>



                    <div
                        class="list__filtro grid items-start w-full p-2  rounded-lg overflow-hidden hover:bg-zinc-200 dark:hover:bg-zinc-900 transition-colors duration-200 cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <figure class="w-12 h-12 rounded-lg overflow-hidden">
                                <img src="{{ asset('img/biblioteca/img1.webp') }}" class="w-full object-cover"
                                    alt="">
                            </figure>

                            <div class="itemlist__text flex flex-col gap-1">
                                <h2 class="font-medium">Hola Beats</h2>
                                <span class="flex text-sm gap-3">

                                    <p class="text-black-spotify-400 font-semibold ">Artista</p>
                                </span>

                            </div>

                        </div>
                    </div>



                    <div
                        class="list__filtro grid items-start w-full p-2  rounded-lg overflow-hidden hover:bg-zinc-200 dark:hover:bg-zinc-900 transition-colors duration-200 cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <figure class="w-12 h-12 rounded-lg overflow-hidden">
                                <img src="{{ asset('img/biblioteca/img3.jpg') }}" class="w-full object-cover"
                                    alt="">
                            </figure>

                            <div class="itemlist__text flex flex-col gap-1">
                                <h2 class="font-medium text-mountain-meadow-400">Favoritas de la radio</h2>
                                <span class="flex text-sm gap-3">

                                    <p class="text-black-spotify-400 font-semibold ">Lista • Diego Saravia Sanchez</p>
                                </span>

                            </div>

                        </div>
                    </div>



                    <div
                        class="list__filtro grid items-start w-full p-2  rounded-lg overflow-hidden hover:bg-zinc-200 dark:hover:bg-zinc-900 transition-colors duration-200 cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <figure
                                class="w-12 h-12 rounded-lg grid place-content-center overflow-hidden text-white bg-black-spotify-200 dark:bg-black-spotify-700">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                                </svg>

                            </figure>

                            <div class="itemlist__text flex flex-col gap-1">
                                <h2 class="font-medium">Mi lista n.° 3</h2>
                                <span class="flex text-sm gap-3">

                                    <p class="text-black-spotify-400 font-semibold ">Lista • Diego Saravia Sanchez</p>
                                </span>

                            </div>

                        </div>
                    </div>





                    <div
                        class="list__filtro grid items-start w-full p-2  rounded-lg overflow-hidden hover:bg-zinc-200 dark:hover:bg-zinc-900 transition-colors duration-200 cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <figure
                                class="w-12 h-12 rounded-lg grid place-content-center overflow-hidden text-white bg-black-spotify-200 dark:bg-black-spotify-700">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                                </svg>

                            </figure>

                            <div class="itemlist__text flex flex-col gap-1">
                                <h2 class="font-medium">Mi lista n.° 4</h2>
                                <span class="flex text-sm gap-3">

                                    <p class="text-black-spotify-400 font-semibold ">Lista • Diego Saravia Sanchez</p>
                                </span>

                            </div>

                        </div>
                    </div>





                    <div
                        class="list__filtro grid items-start w-full p-2  rounded-lg overflow-hidden hover:bg-zinc-200 dark:hover:bg-zinc-900 transition-colors duration-200 cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <figure
                                class="w-12 h-12 rounded-lg grid place-content-center overflow-hidden text-white bg-black-spotify-200 dark:bg-black-spotify-700">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                                </svg>

                            </figure>

                            <div class="itemlist__text flex flex-col gap-1">
                                <h2 class="font-medium">Mi playlista n.° 2</h2>
                                <span class="flex text-sm gap-3">

                                    <p class="text-black-spotify-400 font-semibold ">Lista • Diego Saravia Sanchez</p>
                                </span>

                            </div>

                        </div>
                    </div>





                </div>



            </div>

        </nav>


        <div class="  flex  flex-col  row-span-2 ">
            <header
                class=" bg-black-spotify-200 dark:bg-port-gore-950 card__spotify--mainb  h-auto py-5  md:h-16 w-full flex flex-wrap gap-1 items-center justify-between md:justify-between sticky">


                <button x-on:click="isOpen()" type="button"
                    class=" grid xl:hidden order-1 md:order-1  p-2  place-items-center rounded-full  md:ms-0 w-10 h-10 bg-black scale-[0.95] hover:scale-[1] hover:bg-black-spotify-500 hover:text-mountain-meadow-500 transition-all duration-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>



                <div class="header__flechas hidden md:flex  gap-4 items-center order-3 md:order-1 me-auto ">
                    <div class=" p-1 bg-black grid place-content-center rounded-full cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                    <div class=" p-1 bg-black grid place-content-center rounded-full cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>

                    </div>



                </div>

                <div
                    class="header__info flex flex-row-reverse flex-wrap-reverse md:flex-row gap-3 items-center order-2 md:order-3 justify-end">
                    <div class="header__buttons flex flex-wrap gap-2 items-center flex-row-reverse md:flex-row">

                        <button x-data @click="$store.darkMode.toggle()">
                            <svg class="cursor-pointer w-6 h-6 hidden dark:block hover:text-yellow-400"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                            <svg class="w-6 h-6 text-black hover:text-blue-700 block dark:hidden"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                            </svg>
                        </button>



                        <button
                            class="bg-black-spotify-50 hover:bg-black-spotify-100 text-sm text-black font-bold py-2 px-5 rounded-full scale-[0.97] hover:scale-[1]">
                            Mejora tu cuenta
                        </button>
                        <button
                            class="bg-black text-white text-xs  font-bold py-2 px-4 rounded-full scale-[0.98] hover:scale-[1] flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            Instalar app
                        </button>
                    </div>

                    <div
                        class="header__perfil w-8 h-8 rounded-full overflow-hidden cursor-pointer scale-[0.98] hover:scale-[1]">
                        <img src="{{ asset('img/perfil/perfil.jpg') }}" class="w-full h-full " alt="">
                    </div>

                </div>


            </header>
            <main
                class=" bg-gradient-to-t from-black-spotify-50 dark:from-black-spotify-900 from-20% to-black-spotify-200 dark:to-port-gore-950 to-80%  dark:main__moon  card__spotify--maint  h-full overflow-auto">

                <div class="main__buenosdias">
                    <h2 class="font-bold text-3xl text-white">Buenos dias</h2>

                    {{-- Cards de buenos dias  --}}
                    <div
                        class="buenosdias__cards  py-5 grid grid-cols-[repeat(auto-fit,minmax(min(350px,100%),1fr))] gap-x-6 gap-y-4">

                        {{-- card de buenos dias  --}}
                        <div
                            class="buenosdias__card relative flex h-[4.8rem] w-full rounded overflow-hidden gap-4 items-center cursor-pointer">
                            <img class="h-full z-10" src="{{ asset('img/biblioteca/img2.png') }}" alt="">
                            <h2 class="buencard__title ">Canciones que te gustan</h2>
                            <div
                                class="buenosdias__play p-3 rounded-full bg-mountain-meadow-500 hover:bg-mountain-meadow-400 ms-auto me-4 z-20 hover:drop-shadow-2xl ">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-white dark:text-black">
                                    <path fill-rule="evenodd"
                                        d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                        clip-rule="evenodd" />
                                </svg>


                            </div>
                        </div>
                        {{--  --}}

                        {{-- card de buenos dias  --}}
                        <div
                            class="buenosdias__card relative flex h-[4.8rem] w-full rounded overflow-hidden gap-4 items-center cursor-pointer ">
                            <img class="h-full z-10" src="{{ asset('img/biblioteca/img3.jpg') }}" alt="">
                            <h2 class="buencard__title ">Favoritas de la radio</h2>
                            <div
                                class="buenosdias__play p-3 rounded-full bg-mountain-meadow-500 hover:bg-mountain-meadow-400 ms-auto me-4 z-20 hover:drop-shadow-2xl ">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-black">
                                    <path fill-rule="evenodd"
                                        d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                        clip-rule="evenodd" />
                                </svg>


                            </div>
                        </div>
                        {{--  --}}

                        {{-- card de buenos dias  --}}
                        <div
                            class="buenosdias__card relative flex h-[4.8rem] w-full rounded overflow-hidden gap-4 items-center cursor-pointer ">
                            <img class="h-full z-10" src="{{ asset('img/biblioteca/img4.jpg') }}" alt="">
                            <h2 class="buencard__title ">Mix diario 3</h2>
                            <div
                                class="buenosdias__play p-3 rounded-full bg-mountain-meadow-500 hover:bg-mountain-meadow-400 ms-auto me-4 z-20 hover:drop-shadow-2xl ">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-black">
                                    <path fill-rule="evenodd"
                                        d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                        clip-rule="evenodd" />
                                </svg>


                            </div>
                        </div>
                        {{--  --}}


                        {{-- card de buenos dias  --}}
                        <div
                            class="buenosdias__card relative flex h-[4.8rem] w-full rounded overflow-hidden gap-4 items-center cursor-pointer ">
                            <img class="h-full z-10" src="{{ asset('img/biblioteca/img5.jpg') }}" alt="">
                            <h2 class="buencard__title ">Mix diario 6</h2>
                            <div
                                class="buenosdias__play p-3 rounded-full bg-mountain-meadow-500 hover:bg-mountain-meadow-400 ms-auto me-4 z-20 hover:drop-shadow-2xl ">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-black">
                                    <path fill-rule="evenodd"
                                        d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                        clip-rule="evenodd" />
                                </svg>


                            </div>
                        </div>
                        {{--  --}}


                        {{-- card de buenos dias  --}}
                        <div
                            class="buenosdias__card relative flex h-[4.8rem] w-full rounded overflow-hidden gap-4 items-center cursor-pointer ">
                            <img class="h-full z-10" src="{{ asset('img/biblioteca/img6.jpg') }}" alt="">
                            <h2 class="buencard__title ">Mix de jazz</h2>
                            <div
                                class="buenosdias__play p-3 rounded-full bg-mountain-meadow-500 hover:bg-mountain-meadow-400 ms-auto me-4 z-20 hover:drop-shadow-2xl ">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-black">
                                    <path fill-rule="evenodd"
                                        d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                        clip-rule="evenodd" />
                                </svg>


                            </div>
                        </div>
                        {{--  --}}


                        {{-- card de buenos dias  --}}
                        <div
                            class="buenosdias__card relative flex h-[4.8rem] w-full rounded overflow-hidden gap-4 items-center cursor-pointer ">
                            <img class="h-full z-10" src="{{ asset('img/biblioteca/img7.jpg') }}" alt="">
                            <h2 class="buencard__title ">Freaks</h2>
                            <div
                                class="buenosdias__play p-3 rounded-full bg-mountain-meadow-500 hover:bg-mountain-meadow-400 ms-auto me-4 z-20 hover:drop-shadow-2xl ">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-black">
                                    <path fill-rule="evenodd"
                                        d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                        clip-rule="evenodd" />
                                </svg>


                            </div>
                        </div>
                        {{--  --}}

                    </div>

                    {{-- fin de Cards de buenos dias  --}}
                </div>
                {{-- segunda fila --}}
                <div class="main__hechos mt-3">
                    <div class=" flex justify-between items-center">
                        <h2 class="font-bold text-2xl">Hecho para Diego Saravia Sanchez</h2>
                        <a href="" class="text-sm font-bold text-black-spotify-400"> Mostrar todos</a>
                    </div>

                    <div
                        class="hechos__items grid grid-cols-[repeat(auto-fit,minmax(min(180px,100%),1fr))] gap-5 py-5">

                        {{-- card --}}
                        <div class="group  maincard__spotify">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img10.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 1</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Beatles, Eagle, Electric Light
                                Orchestra y mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img10.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 1</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Beatles, Eagle, Electric Light
                                Orchestra y mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img11.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 4</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Metallica, Motley Crue, Audioslave y
                                mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img12.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 5</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Michael Jackson, Red Hot Chili
                                Peppers, Edwin Starr...</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img13.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Descubrimiento sema..</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Tu combinacion semanal de música
                                fresca. Temas...</p>

                        </div>
                        {{--  --}}


                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img14.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Radar de Novedades</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Las novedades de los artistas que
                                sigues y nuev...</p>

                        </div>
                        {{--  --}}




                    </div>

                </div>
                {{-- fin segunda fila --}}

                {{-- tercera fila --}}
                <div class="main__hechos mt-3">
                    <div class=" flex justify-between items-center">
                        <h2 class="font-bold text-2xl">Tus mixes más escuchados</h2>
                        <a href="" class="text-sm font-bold text-black-spotify-400"> Mostrar todos</a>
                    </div>

                    <div
                        class="hechos__items grid grid-cols-[repeat(auto-fit,minmax(min(180px,100%),1fr))] gap-5 py-5">

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img15.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix de pop</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Harry Styles, WILLOW, Shawn Mendes y
                                mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img16.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 4</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Metallica, Motley Crue, Audioslave y
                                mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img17.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 5</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Michael Jackson, Red Hot Chili
                                Peppers, Edwin Starr...</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img18.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Descubrimiento sema..</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Tu combinacion semanal de música
                                fresca. Temas...</p>

                        </div>
                        {{--  --}}


                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img14.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Radar de Novedades</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Las novedades de los artistas que
                                sigues y nuev...</p>

                        </div>
                        {{--  --}}
                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img14.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Radar de Novedades</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Las novedades de los artistas que
                                sigues y nuev...</p>

                        </div>
                        {{--  --}}




                    </div>

                </div>
                {{-- fin tercera fila --}}
                {{-- cuarta fila --}}
                <div class="main__hechos mt-3">
                    <div class=" flex justify-between items-center">
                        <h2 class="font-bold text-2xl">Tus mixes más escuchados</h2>
                        <a href="" class="text-sm font-bold text-black-spotify-400"> Mostrar todos</a>
                    </div>

                    <div
                        class="hechos__items grid grid-cols-[repeat(auto-fit,minmax(min(180px,100%),1fr))] gap-5 py-5">

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img15.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix de pop</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Harry,WILLOW,Shaw Mendes y mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img16.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 4</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Metallica, Motley Crue, Audioslave y
                                mas</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img17.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Mix diario 5</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Michael Jackson, Red Hot Chili
                                Peppers, Edwin Starr...</p>

                        </div>
                        {{--  --}}

                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img18.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Descubrimiento sema..</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Tu combinacion semanal de música
                                fresca. Temas...</p>

                        </div>
                        {{--  --}}


                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img14.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Radar de Novedades</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Las novedades de los artistas que
                                sigues y nuev...</p>

                        </div>
                        {{--  --}}
                        {{-- card --}}
                        <div class="group  maincard__spotify grid gap-2 p-4 rounded-md">

                            <div class="rounded-md max-h-[11.5rem] w-full overflow-hidden relative">
                                <img class=" object-cover " src="{{ asset('img/biblioteca/img14.jpg') }}"
                                    alt="">
                                <div
                                    class="absolute bottom-2 right-2 rounded-full p-3  bg-mountain-meadow-500 hover:bg-mountain-meadow-400 z-20 hover:drop-shadow-2xl translate-y-3/4 transition duration-300 ease-out group-hover:translate-y-0 opacity-0 group-hover:opacity-100">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6 text-black">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>


                                </div>
                            </div>


                            <h3 class="title__hecho"> Radar de Novedades</h3>
                            <p class="text-sm text-black-spotify-400 font-medium">Las novedades de los artistas que
                                sigues y nuev...</p>

                        </div>
                        {{--  --}}




                    </div>

                </div>
                {{-- fin cuarta fila --}}


                <footer class="footer my-9 py-5  grid gap-5">

                    <div
                        class="footer__container border-solid border-b-2 border-black-spotify-800 flex flex-wrap gap-16 py-9 items-start">

                        {{-- primer columna footer --}}
                        <div
                            class="empresa grid gap-3 footer__list font-medium text-black-spotify-400 justify-start items-start">
                            <h2 class="font-bold text-white">Empresa</h2>
                            <ul class="grid gap-3 items-start">
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Acerca de </a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Empleo </a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">For the Record </a>
                                </li>
                            </ul>
                        </div>
                        {{-- fin primer columna footer --}}

                        {{-- segunda columna footer --}}
                        <div class="empresa grid gap-3 footer__list font-medium text-black-spotify-400">
                            <h2 class="font-bold text-white">Empresa</h2>

                            <ul class="grid gap-3">
                                <li>
                                    <a class="hover:text-white hover:underline" href=""> Para artistas </a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Desarrolladores </a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Publicidad</a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Inversores</a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Proveedores</a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Spotify for Work</a>
                                </li>
                            </ul>
                        </div>
                        {{-- fin segunda columna footer --}}

                        {{-- tercera columna footer --}}
                        <div
                            class="empresa grid gap-3 footer__list font-medium text-black-spotify-400 justify-start items-start">
                            <h2 class="font-bold text-white">Enlaces útiles</h2>




                            <ul class="grid gap-3 items-start">
                                <li>
                                    <a class="hover:text-white hover:underline" href="">Asistencia </a>
                                </li>
                                <li>
                                    <a class="hover:text-white hover:underline" href="">App gratis para móvil
                                    </a>
                                </li>

                            </ul>
                        </div>
                        {{-- fin tercera columna footer --}}

                        {{-- cuarta columna footer --}}
                        <div
                            class="empresa grid gap-3 footer__list font-medium text-black-spotify-400 justify-start items-start ms-auto">


                            <div class="footer__socials flex gap-4 text-white text-lg">

                                <a href="" class="footer__icon"><i class="fa-brands fa-instagram  "></i></a>
                                <a href="" class="footer__icon "><i class="fa-brands fa-twitter  "></i></a>
                                <a href="" class="footer__icon "><i class="fa-brands fa-facebook  "></i></a>
                            </div>




                        </div>
                        {{-- fin cuarta columna footer --}}



                    </div>

                    <div class="derechos flex flex-wrap gap-4 text-sm font-medium text-black-spotify-400 pt-5">

                        <a href="" class="hover:text-white">Legal</a>
                        <a href="" class="hover:text-white">Centro de Privacidad</a>
                        <a href="" class="hover:text-white">Política de Privacidad</a>
                        <a href="" class="hover:text-white">Cookies</a>
                        <a href="" class="hover:text-white">Información sobre los anuncios</a>
                        <a href="" class="hover:text-white">Accesibilidad</a>
                        <p class="ms-auto">© 2023 Spotify AB</p>






                    </div>
                </footer>

            </main>
        </div>

        <div class="reproductor col-span-1 xl:col-span-2 mt-auto bg-white dark:bg-black-spotify-950 text-black dark:text-white grid grid-cols-3 items-center  py-3 px-1  "
            id="reproductor">

            <div class="cancion flex  gap-4 items-center">
                <img src="{{ asset('img/album/DistantLight.jpg') }}" class="cancion__img w-14 h-14 rounded-lg"
                    alt="">
                <div class="cancion__text flex flex-col justify-center gap-1">
                    <h2 class="cancion__title text-sm">Long Coll Women (In Black Dress) - 1999 Remaster</h2>
                    <span class="cancion__artista text-xs font-medium text-black-spotify-400">The Hollies</span>
                </div>

                <div class="icons flex items-center gap-3">
                    <svg class="reproductor__icon " xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>

                    <svg class="reproductor__icon " xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                    </svg>

                </div>
            </div>

            <div class="cancion__tiempo grid  items-center gap-2">

                <div
                    class="cancion__botones text-black-spotify-200 flex w-full justify-center gap-5 text-lg font-normal items-center">
                    <i class="fa-solid fa-shuffle cursor-pointer"></i>
                    <i class="fa-solid fa-forward-step rotate-180  cursor-pointer"></i>
                    <div
                        class="play w-8 h-8  bg-mountain-meadow-400 text-white dark:bg-white grid place-items-center rounded-full dark:text-black  cursor-pointer">
                        <i class="fa-solid fa-pause p-0 m-0 block"></i>
                    </div>

                    <i class="fa-solid fa-forward-step cursor-pointer"></i>
                    <i class="fa-solid fa-retweet cursor-pointer"></i>

                </div>
                <div class="tiempo flex items-center gap-2 text-xs">
                    <span>2:30</span>
                    <input type="range" class="cursor-pointer " id="customRange1" />
                    <span>3:30</span>
                </div>

            </div>

            <div class="cancion__option flex items-center justify-end  gap-2 mt-3 xl:mt-0">
                <svg class="reproductor__icon " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                </svg>

                <svg class="reproductor__icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                </svg>

                <svg class="reproductor__icon me-auto xl:me-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                </svg>


                <div class="volumen flex items-center gap-2">

                    <svg class="reproductor__icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                    </svg>

                    <input type="range" class="" id="customRange1" />
                </div>
            </div>
        </div>

        <div class="grid place-items-center xl:hidden fixed bottom-10 right-10 p-4 bg-mountain-meadow-400 text-white rounded-full cursor-pointer shadow-lg scale-105 hover:scale-110 transition-all duration-300"
            id="boton_reproductor">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
            </svg>

        </div>


    </div>

    {{-- js --}}
    <script>
        function data() {
            return {
                open: null,
                pantalla: null,
                start() {
                    this.open = true;

                },

                isOpen() {
                    this.open = !this.open;
                },
                close() {
                    this.open = false;
                }
            }
        }
    </script>



    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.store('darkMode', {
                on: Alpine.$persist(false).as('darkMode_on'),
                toggle() {
                    this.on = !this.on;
                }
            })
        });



        const reproductor = document.getElementById('reproductor');
        const boton_reproductor = document.getElementById('boton_reproductor');


        boton_reproductor.addEventListener("click", function() {
            reproductor.classList.toggle("reproductor--open");
        });
    </script>
    {{--  --}}

</body>

</html>
