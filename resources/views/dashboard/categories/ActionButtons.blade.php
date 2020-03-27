@canany(["category-edit", "category-delete", "category-list"])
    <div class="actions-td">
            @can("category-edit")
                <a href="{{ route("categories.edit", $id) }} " style="color: #1AB394"><i class="fa fa-edit fa-2x"></i></a>
            @endcan

            @can("category-delete")
                <form method="POST" action='{{ route("categories.destroy", $id) }}'  style='display: inline' id="{{'category'.$id}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <a href="#" id="deleteButton" style="color: red"
                           onclick="return confirm('Are you sure you want to delete this item?'),
                           document.getElementById('{{"category".$id}}').submit(); ">
                            <i class="fa fa-trash fa-2x"></i></a>
                    </div>
                </form>
            @endcan
    </div>
@endcanany
