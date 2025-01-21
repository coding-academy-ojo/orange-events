<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Orange Events')</title>

    <script src="https://kit.fontawesome.com/b23f87e5ba.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="{{ asset('assets/brand/Small_Logo_RGB.svg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet"
        integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/preview.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js"
        integrity="sha384-3RoJImQ+Yz4jAyP6xW29kJhqJOE3rdjuu9wkNycjCuDnGAtC/crm79mLcwj1w2o/" crossorigin="anonymous">
    </script>


    <style>
        .image-shadow {
            position: relative;
            display: inline-block;
        }

        .image-shadow img {
            display: block;
        }

        .image-shadow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgb(0, 0, 0),rgba(0, 0, 0, 0.9), transparent);
            pointer-events: none;
        }
    </style>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 1000 1000">
            <path
                d="M729.667 250 396.333 583.333l-125-125L188 541.667l125 125L396.333 750l83.334-83.333L813 333.333z" />
        </symbol>
        <symbol id="ui-auto-mode" viewBox="0 0 1000 1000">
            <path
                d="M500 75C265.3 75 75 265.5 75 500.5S265.3 926 500 926s425-190.5 425-425.5S734.7 75 500 75m0 775V150c192.6.9 350 157.5 350 350.5S692.6 849.1 500 850" />
        </symbol>
        <symbol id="ui-dark-mode" viewBox="0 0 1000 1000">
            <path
                d="M675 649.88c-179.493 0-325-145.57-325-325.141A324.478 324.478 0 0 1 465.721 76C247.03 93.463 75 276.537 75 499.815 75 734.638 265.279 925 500 925c223.181 0 406.175-172.106 423.63-390.891A324.222 324.222 0 0 1 675 649.88Z" />
        </symbol>
        <symbol id="ui-light-mode" viewBox="0 0 1000 1000">
            <path
                d="M287.868 712.132a25.073 25.073 0 0 0-35.355 0l-53.033 53.033a25 25 0 0 0 35.355 35.355l53.033-53.033a25.073 25.073 0 0 0 0-35.355Zm424.264-424.264a25.073 25.073 0 0 0 35.355 0l53.033-53.033a25 25 0 0 0-35.355-35.355l-53.033 53.033a25.073 25.073 0 0 0 0 35.355Zm35.355 424.264a25.073 25.073 0 0 0-35.355 0 25.073 25.073 0 0 0 0 35.355l53.033 53.033a25 25 0 0 0 35.355-35.355ZM252.513 287.868a25.073 25.073 0 0 0 35.355 0 25.073 25.073 0 0 0 0-35.355l-53.033-53.033a25 25 0 0 0-35.355 35.355ZM200 500a25.073 25.073 0 0 0-25-25h-75a25 25 0 0 0 0 50h75a25.073 25.073 0 0 0 25-25Zm700-25h-75a25 25 0 0 0 0 50h75a25 25 0 0 0 0-50ZM500 800a25.073 25.073 0 0 0-25 25v75a25 25 0 0 0 50 0v-75a25.073 25.073 0 0 0-25-25Zm0-600a25.073 25.073 0 0 0 25-25v-75a25 25 0 0 0-50 0v75a25.073 25.073 0 0 0 25 25Zm0 50c-138.071 0-250 111.929-250 250s111.929 250 250 250 250-111.929 250-250-111.929-250-250-250Z" />
        </symbol>
    </svg>


    <header data-bs-theme="dark" class="bg-dark start-0 end-0" style="z-index: 999;">
        <nav class="navbar navbar-expand-lg p-0 " aria-label="Global navigation - With mode selector example">
            <div class="container-fluid d-flex justify-content-between header-width align-items-center">
                <!-- Orange brand logo -->
                <img src="{{ asset('assets/brand/orange-is-here-white.png') }}" alt="" style="width: 100px"
                    class="m-0" />
                <div id="navbarNav">
                    <div class="nav-item dropdown">
                        <button class="nav-link nav-icon dropdown-toggle" id="bd-theme"
                            aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static"
                            aria-label="Toggle mode (auto)">
                            <i class="fa-solid fa-circle-half-stroke"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mb-2"
                            aria-labelledby="bd-theme-text">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false"
                                    onclick="theme('light')">
                                    <svg class="me-2">
                                        <use href="#ui-light-mode"></use>
                                    </svg>
                                    Light
                                    <svg class="ms-auto d-none">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false"
                                    onclick="theme('dark')">
                                    <svg class="me-2">
                                        <use href="#ui-dark-mode"></use>
                                    </svg>
                                    Dark
                                    <svg class="ms-auto d-none">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </nav>
    </header>

    @yield('content')


    <footer class="footer navbar bg-dark text-white mt-5" data-bs-theme="dark">
        <h2 class="visually-hidden">Sitemap & Information</h2>
        <div class="container-xxl d-flex justify-content-center align-items-center" style="height: 150px;">
            <ul class="navbar-nav gap-2 d-flex flex-row justify-content-center align-items-center m-0">
                <li><a href="#" class="btn btn-icon btn-social btn-twitter"><span
                            class="visually-hidden">Twitter</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-facebook"><span
                            class="visually-hidden">Facebook</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-instagram"><span
                            class="visually-hidden">Instagram</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-whatsapp"><span
                            class="visually-hidden">WhatsApp</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-linkedin"><span
                            class="visually-hidden">LinkedIn</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-youtube"><span
                            class="visually-hidden">YouTube</span></a></li>
            </ul>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.min.js"
        integrity="sha384-TfjOlWccrKKSEc/hJqxs6Tofoh4+tlm//VJYb92Ow7aPNtgfaKuuLsnFqObi3xmp" crossorigin="anonymous">
    </script>


    <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>

</html>