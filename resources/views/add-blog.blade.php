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
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Add Blog
                        </div>
                        <div class="card-body">
                            @if(Session::has('blog_created'))
                               <div class="alert alert-success" role="alert">
                                {{ Session::get('blog_created') }}    
                            </div>                                
                            @endif
                            <form action="{{ Route('blog.create') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Blog Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Blog Title"/>

                                </div>

                                <div class="form-group">
                                    <label for="body">Blog Description</label>
                                    <textarea name="body" class="form-control" cols="30" rows="3"></textarea>
                                </div> <br>
                                <button type="submit" class="btn btn-success">Add Blog</button>
                                <a href="/blogs" class="btn btn-dark">Go back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>