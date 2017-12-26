<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
        {!! Html::script('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') !!}
        <script type="text/javascript">
        $.ajaxSetup({
            headers: {'X-CSRF-Token':'{{ csrf_token() }}'}
        });
        </script>

        @yield('javascript')
        <title>@yield('title')</title>

        <!-- Fonts -->
        {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
        {!! Html::style('https://fonts.googleapis.com/css?family=Raleway:100,600') !!}
        {!! Html::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') !!}
        {!! Html::style('https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css') !!}
        {!! Html::style('css/main.css') !!}
        <!-- Styles -->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/articles">Articles</a>
                    </li>
                    <li>
                        <a href="/articles/create">Add Article</a>
                    </li>
                    <li>
                        <a href="/articles/getArticles">Get new articles</a>
                    </li>
                </ul>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                </div>
            </div>
        </nav>
        <div class="content">
            @yield('content')
        </div>
    </body>
</html>
