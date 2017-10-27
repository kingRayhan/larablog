            @foreach($posts as $post)
                <div class="panel panel-default">
                        <div class="panel-heading blog-list-title">
                            <a href="{{ route('blog.single' , $post->slug) }}">{{ $post->title }}</a>
                        </div>
                    <div class="panel-body">
                        <div class="post">
                            
                            <div>
                                <strong>Published: </strong> {{ $post->created_at }} 
                                |  <strong>Posted in:</strong> 
                                @if($post->category_id != NULL)
                                    <a href="{{ route('blog.archive' , $post->category->name) }}">
                                        {{ $post->category->name }}
                                    </a>
                                @else
                                    Uncategorized
                                @endif
                            </div>
                            <hr>
                            <p>{{ substr($post->body, 0 , 200) }}{{ strlen($post->body) > 200 ?  '[...]' : NULL }}</p>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <a href="{{ route('blog.single' , $post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            @endforeach