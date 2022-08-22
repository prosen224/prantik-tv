<!doctype html>
  <html lang="en">
      <head>
        @include('Frontend.Frontend_partials.head')
        @yield('css')
      </head>
      <body>
        <!--Header Section Starts -->
        <header class="site_header">
          @include('Frontend.Frontend_partials.top_nav')
        </header>
        <!-- Header Section End --> 
        
        <!-- Banner Section Starts -->

        <!-- Banner Section Ends -->
        @yield('main_content')

          {{-- footer --}}
          @include('Frontend.Frontend_partials.footer')
          {{-- footer ends --}}
          {{-- push script here --}}
          @stack('scripts')
    
        {{-- push script here --}}
    </body>
  </html>