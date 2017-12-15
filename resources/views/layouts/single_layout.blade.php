<!DOCTYPE html>
<html lang="en">
<head>
  @include('components.layout._head')
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      @include('components.layout._aside')
    </div>

    <div class="col-sm-9">
      
      @yield('content')      

      <!-- comments -->
      @include('comments._comments_body')
      
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
