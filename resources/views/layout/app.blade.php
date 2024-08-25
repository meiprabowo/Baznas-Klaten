@include('partials._header')
@if(auth()->check())
<body class="layout-light side-menu">
    <div class="mobile-search">
        <form action="/" class="search-form">
            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
            <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search..." aria-label="Search">
        </form>
    </div>
    <script>
  // Check if user has a preference set, if not, default to light mode
  let mode = localStorage.getItem("mode");
  if (!mode) {
    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
    mode = prefersDarkScheme.matches ? "dark" : "light";
  }

  // Function to toggle mode
  function toggleMode() {
    mode = mode === "dark" ? "light" : "dark";
    document.body.classList.toggle("layout-dark", mode === "dark");
    document.body.classList.toggle("layout-light", mode === "light");
    localStorage.setItem("mode", mode);
  }

  // Set initial mode
  document.body.classList.toggle("layout-dark", mode === "dark");
  document.body.classList.toggle("layout-light", mode === "light");
</script>


<script>
  // Check if user has a preference set, if not, default to side menu
  let menu = localStorage.getItem("menu");
  if (!menu) {
    const prefersTopScheme = window.matchMedia("(prefers-color-scheme: top)");
    menu = prefersTopScheme.matches ? "top" : "side";
  }

  // Function to toggle menu
  function topmenu() {
    menu = menu === "top" ? "side" : "top";
    document.body.classList.toggle("top-menu", menu === "top");
    document.body.classList.toggle("side-menu", menu === "side");
    localStorage.setItem("menu", menu);
  }

  // Set initial menu
  document.body.classList.toggle("top-menu", menu === "top");
  document.body.classList.toggle("side-menu", menu === "side");
</script>
@else
<body class="layout-light top-menu">
    <div class="mobile-search">
        <form action="/" class="search-form">
            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
            <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search..." aria-label="Search">
        </form>
    </div>
@endif



    <div class="mobile-author-actions"></div>
    <header class="header-top">
        @include('partials._top_nav')
    </header>
    <main class="main-content">
        <div class="sidebar-wrapper">
            <aside class="sidebar sidebar-collapse" id="sidebar">
                @include('partials._menu')
            </aside>
        </div>

     
   

        <div class="contents">
            @yield('content')
        </div>
       



        <footer class="footer-wrapper">
            @include('partials._footer')
        </footer>
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="dm-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-success"></span>
                <span class="spin-dot badge-dot dot-success"></span>
                <span class="spin-dot badge-dot dot-success"></span>
                <span class="spin-dot badge-dot dot-success"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>
    <div class="customizer-wrapper">
        @include('partials._customizer')
    </div>

    <script>
        var env = {
            iconLoaderUrl: "{{ asset('assets/js/json/icons.json') }}",
            googleMarkerUrl: "{{ asset('assets/img/markar-icon.png') }}",
            editorIconUrl: "{{ asset('assets/img/ui/icons.svg') }}",
            mapClockIcon: "{{ asset('assets/img/svg/clock-ticket1.sv') }}g"
        }
    </script>
    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
</body>
</html>
