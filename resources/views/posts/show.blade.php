@extends('layout.app')

@section('title') View @endsection

@section('content')
<div class="card bg-light mt-5" >
  <div class="card-header">Post Info</div>
  <div class="card-body">

    <h5 class="card-title" style="font-size:18px;display:inline;">Title:-</h5>
    <p class="card-text" style="display:inline;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <h5 class="card-title mt-4" style="font-size:18px">Description:-</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
<div class="card bg-light mt-5" style="max-width: 18rem,text-align:center;">

  <div class="card-header">Post Creator Info</div>

  <div class="card-body">
      <div class="p-2">
       <h5 class="card-title" style="font-size:18px;display:inline;">Title:-</h5>
       <p class="card-text" style="display:inline;">{{$post->title}}</p>
      </div>
      <div class="p-2">
      <h5 class="card-title" style="font-size:18px;display:inline;">posted By:-</h5>
      <p class="card-text" style="display:inline;">{{$post->description}}</p>
      </div>
      <div class="p-2">
      <h5 class="card-title" style="font-size:18px;display:inline;">Created At:-</h5>
    <p class="card-text" style="display:inline;">{{$post->created_at->format('l jS \of F Y h:i:s A')}}</p>
      </div>
     <!-- Comments -->
<div class="card my-4">
    <div class="card-header fw-bold fs-1">
        Comments
    </div>
    <div class="card-body ">
        @if(isset($post->comments) && count($post->comments) > 0)
            @foreach ($post->comments as $comment)
                <div class='my-4 border p-4 rounded-lg'>
                    <h2 class='text-lg fw-bold'>{{$comment->user->name}}</h2>
                    <p class='text-lg my-2 fs-2'>{{$comment->body}}</p>
                    <span class='text-sm'>Last Updated At: {{$comment->updated_at->toDayDateTimeString()}}</span>
                    <div class="mt-4  flex">
                        <form class="text-center d-inline" method='POST' action="{{route('comments.delete', ['postId' => $post['id'], 'commentId' => $comment->id])}}">
                            @csrf
                            @method('DELETE')
                            <button type="sumbit" class='btn btn-lg btn-primary'>Delete</button>
                        </form>
                        <a class='btn btn-lg btn-success ml-4' href="{{route('comments.view', ['postId' => $post['id'], 'commentId' => $comment->id])}}">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

<div class="d-flex justify-content-center " style="width: 100%">
    <form action="{{route('comments.create',['postId' => $post['id']])}}" method="POST" style="width: 100%">
        <input type="text" name="comment" class="form-control mr-2" placeholder="Add comment" style="margin: 10px 0;">

        @csrf
        <button type="submit" class="btn btn-success">Add Comment</button>
    </form>
</div>

@endsection
