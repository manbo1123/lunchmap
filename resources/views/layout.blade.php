<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <!-- BootStrapを導入 -->
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>body {padding-top: 80px;}</style>  <!-- 設置位置の調節  -->
    <title>Lunchmap</title>
  </head>
  <body>
    <!-- Bootstrap でナビバー導入 -->
    <nav class='navbar navbar-expand-md navbar-dark bg-dark fixed-top'>
      <a class='navbar-brand' href='{{ route("shop.list") }}'>Lunchmap</a>
    </nav>

    <div class = 'container'>
      @yield('content')
    </div>
  </body>
</html>