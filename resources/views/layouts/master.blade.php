@include('admin.partials.header')

  @include('admin.partials.navbar')
 @if(Auth::user()->role_id == 3)
   @include('student.partials.sidebar')
@else
  @include('admin.partials.sidebar')
@endif  
<div class="page-wrapper">
@include('admin.partials.breadcrumb')

@yield('content')


@include('admin.partials.footer')

@yield('javascript')

