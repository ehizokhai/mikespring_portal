@include('admin.partials.header')
@include('admin.partials.navbar')
@include('admin.partials.sidebar')

<div class="page-wrapper">
@include('admin.partials.breadcrumb')

@yield('content')


@include('admin.partials.footer')

@yield('javascript')

