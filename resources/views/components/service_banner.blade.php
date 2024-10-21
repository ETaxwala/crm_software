<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">@yield('page_name', 'Not Found')</h1>
        <ol class="breadcrumb justify-content-center text-white mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{route('index')}}" class="text-white">Home</a></li>
            <li class="breadcrumb-item active text-secondary">@yield('page_name', 'Not Found')</li>
        </ol>
    </div>
</div>
