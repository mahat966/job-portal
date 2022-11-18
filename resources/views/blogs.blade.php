<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section style="padding-top:60px;">
        <div class="conatiner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 70rem">
                        <div class="card-header">
                            All Blog
                        </div>
                        <div class="card-body">
                            @if(Session::has('blog_deleted'))
                            <div class="alert alert-success" role="alert">
                             {{ Session::get('blog_deleted') }}    
                         </div>                                
                         @endif
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($blogs as $blog)
                                  <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->body }}</td>
                                    <td>
                                        <a href="/blogs/{{ $blog->id }}" class="btn btn-info">Details</a>
                                        <a href="/edit-blog/{{ $blog->id }}" class="btn btn-success">Update </a>
                                        <a href="/delete-blog/{{ $blog->id }}" class="btn btn-danger">Delete</a>
                                    </td>
                                  </tr>
                                  @endforeach

                                </tbody>
                            </table>
                            <div class="row">
                                {!! $blogs->appends(Request::all())->links() !!}

                            </div>


                            <a href="/add-blog" class="btn btn-success">Create New blog</a>
                        </div>
                        <a href="{{ route('logout') }}" class="btn btn-danger">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>