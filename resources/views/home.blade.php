<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    @extends('layout.navbar')
    @section('content')
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ $blog->title }}</h1>
                            <p>{{ $blog->body }}</p>
                        </div>
                        <br>
                        <div class="card-footer">
                            <a href="{{ route('home.view', [$blog->id]) }}" class="btn btn-primary"> Blog Details </a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="d-flex justify-content-center" style="margin-top: 30px">

                    {!! $blogs->appends(Request::all())->links() !!} 
                </div>
            </div>
        </div>
        <br>
        {{-- <div class="pagination" style="">{!! $blogs->appends(Request::all())->links() !!} </div> --}}

    </section>
    
    @endsection
</body>
</html>