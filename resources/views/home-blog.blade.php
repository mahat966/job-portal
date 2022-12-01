<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .home{
            display: flex;
    justify-content: center;
    align-items: center;
    margin-right: -33px;
    position: relative;
    left: -225px;
    bottom: 20px;

        }
    </style>
</head>
<body>
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="home">

                    <a href="/home" class="btn btn-success">BLOGS</a>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-primary">{{ $blog->title }}</h1>
                            <p>{{ $blog->body }}</p>
                        </div>
                        <div class="comment-area mt-4">
                            @if (session('Status'))
                            <h6 class="alert alert-warning mb-3">{{ session('Status') }}</h6>
                                
                            @endif 
                            @if (session('status'))
                            <h6 class="alert alert-warning mb-3">{{ session('status') }}</h6>
                                
                            @endif                          
            </div>
        </div>
        <br>

        <small class="float-right">
            <span title="Likes" data-type="like" data-post="{{ $blog->id }}" class="mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold saveLike" >
                Like
                <span class="like-count">{{ $blog->likes() }}</span>
            </span>
            <span title="Dislikes" data-type="dislike" data-post="{{ $blog->id }}" class="mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold saveLike" >
                Dislike
                <span class="dislike-count">{{ $blog->dislikes() }}</span>
            </span>
        </small>

        <div class="car card-body">
            <h6 class="card-title py-3">Leave a Comment</h6>
            <form action="{{ url('comments') }}" method="POST">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                <textarea name="comment_body" rows="3" class="form-control" required></textarea>
                <button class="btn btn-primary mt-3" type="submit">Submit</button>
            </form>
        </div>
        
                            @forelse ($blog->comments as $comment)
                                <div class="card card-body shadow-sm mt-3 comment-container">
                                    <div class="detail-area">
                                        <h6 class="user-name mb-1 text-success">
                                            @if ($comment->user)
                                                {{ $comment->user->name }}
                                            @endif
                                        </h6>
                                        <p class="user-comment mb-1 pt-3">
                                            {!! $comment->comment_body !!}
                                        </p>
                                        <small class="text-primary" style="float: right">Commented on:{{ $comment->created_at->format('y-m-d') }}</small>
                                    </div>
                                    @if (Auth::check() && Auth::id() == $comment->user_id)
                                    <div>
                                        <button type="button" class="btn btn-primary editbtn" value="{{ $comment->id }}">Edit</button>
                                        <button type="button" value = "{{ $comment->id }}"class="btn btn-danger deleteComment">Delete</button>
                                    </div>
                                        
                                    @endif
                                </div>
                            @empty
                            <div class="card card-body shadow-sm mt-3">
                                <h6>No Comment Yet.</h6>
                            </div>
                            @endforelse

                            <div class="modal" id="editcmnt" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit Comment</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{ url('update-comment') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="cmt_id" id="cmt_id" value="{{ $comment->id }}">
                                        <textarea name="comment_body" id="CmntBody" rows="3" class="form-control" required></textarea>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
        </div>
    </section>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script>
       
        $(document).on('click','.editbtn',function(){
            var cmt_id =$(this).val();
            $('#editcmnt').modal('show');

            $.ajax({
                type: "GET",
                url: "/edit-comment/"+cmt_id,
                success:function(res){
                    $('#CmntBody').val(res.Comment.comment_body);
                    $('#cmt_id').val(re.Comment.cmt_id);
                }
            });
        });

        $(document).on('click','.deleteComment',function(){

            if(confirm('are you sure'))
            {
                var thisClicked = $(this);
                var comment_id = thisClicked.val();

                $.ajax({
                    type: "POST",
                    url:"/delete-comment",
                    data: {
                        'comment_id': comment_id,
                        _token:"{{ csrf_token() }}"
                    },
                    success: function(res){
                        if(res.status == 200){
                            thisClicked.closest('.comment-container').remove();
                            alert(res.message);
                        }
                    }
                })
            }

        });

        $(document).on('click','.saveLike',function(){
                var _post=$(this).data('post');
                var _type=$(this).data('type');
                var vm=$(this);

                $.ajax({
                    url:"{{ route('like') }}",
                    type:'post',
                    dataType:'json',
                    data:{
                        post:_post,
                        type:_type,
                        _token:"{{ csrf_token() }}"
                    },
                    beforeSend:function(){
                        vm.addClass('disabled');
                    },

                    success:function(res){
                        if(res.status){
                            vm.removeClass('disabled').addClass('active');
                            $("."+'like'+"-count").text(res.like);
                            $("."+'dislike'+"-count").text(res.dislike);

                        }
                        else
                        {
                            Swal.fire({
                            icon: 'error',
                            title: res.message,
                            showCancelButton: true,
                            text: 'Please login to Like',
                            confirmButtonText: "login",
                            cancelButtonText: 'Cancel',
                            cancelButtonColor: 'red',
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    window.location = '/auth/login'
                                }
                            });

                        }
                        
                        
                    }
                });
            });
</script>
    
</body>
</html>