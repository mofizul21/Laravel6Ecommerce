
    <div class="list-group">
        @foreach (App\Category::orderBy('name', 'ASC')->get() as $parent)

        <a href="{{URL::to('products/category', $parent->id)}}" class="list-group-item list-group-item-action"><img src="{{asset('public/images/categories/'.$parent->image)}}" width="50" height="50"> {{$parent->name}}</a>
        @endforeach

        {{-- @foreach (App\Category::orderBy('name', 'ASC')->where('parent_id', NULL)->get() as $parent)
            <a href="#main-{{$parent->id}}" class="list-group-item list-group-item-action" data-toggle="collapse"><img
                    src="{{asset('public/images/categories/'.$parent->image)}}" width="50" height="50"> {{$parent->name}}</a>
            
            <div class="collapse" id="main-{{$parent->id}}">
                <div class="child_rows">
                    @foreach (App\Category::orderBy('name', 'ASC')->where('parent_id', $parent->id)->get() as $child)
                    <a href="{{URL::to('products/category', $child->id)}}" class="list-group-item list-group-item-action"><img
                            src="{{asset('public/images/categories/'.$child->image)}}" width="50" height="50"> {{$child->name}}</a>
                    @endforeach
                </div>
            </div>
        @endforeach --}}
    </div>

    <style>
        .child_rows{
            padding-left: 20px;
        }
    </style>
