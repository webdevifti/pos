@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>    
        {{-- <a class="btn btn-success mb-4" href="{{ route('users.create') }}"></a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add A New Product
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add a new products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" placeholder="Product Name" name="product_name" class="form-control" required>
                        </div>
                        <div class="mb-4">
                           <textarea name="product_description"  cols="30" rows="5" placeholder="Product Decsription" class="form-control"></textarea>
                        </div>
                        <div class="mb-4">
                           <input type="text" name="quantity" placeholder="Quantity" class="form-control">
                        </div>
                        <div class="mb-4">
                            <input type="text" name="price" placeholder="Price" class="form-control">
                         </div>
                         <div class="mb-4">
                            <input type="text" name="brand" placeholder="Brand Name" class="form-control">
                         </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
            </div>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                 Product List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>In Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>In Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $item)
                            
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>
                                @if($item->alert_stock >= $item->quantity)
                                    <span class="text-danger">Low Stock</span>
                                @else 
                                {{ $item->alert_stock }}
                                @endif
                            </td>
                            <td>
                                @if($item->status == 1)
                                    <a href="" class="btn btn-success">Active</a>
                                @else
                                    <a href="" class="btn btn-warning">Deactive</a>
                                 @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editation_{{ $item->id }}"><i class="fa fa-pencil"></i></button>
                                <div class="modal fade" id="editation_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editationLabel">Update Employee Info</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('products.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Product Name" name="product_name" value="{{ $item->product_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-4">
                                                       <textarea name="product_description"  cols="30" rows="5" placeholder="Product Decsription" class="form-control">{{ $item->product_description }} </textarea>
                                                    </div>
                                                    <div class="mb-4">
                                                       <input type="text" name="quantity" placeholder="Quantity" value="{{ $item->quantity }}"  class="form-control">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="text" name="price" placeholder="Price" value="{{ $item->price }}"  class="form-control">
                                                     </div>
                                                     <div class="mb-4">
                                                        <input type="text" name="brand" placeholder="Brand Name" value="{{ $item->brand }}"  class="form-control">
                                                     </div>
                                                     <div class="mb-4">
                                                        <input type="text" name="stock" placeholder="Stock" value="{{ $item->alert_stock }}"  class="form-control">
                                                     </div>
                                                     <div class="mb-4">
                                                        <select name="status" class="form-control">
                                                            <option {{ ($item->status == 1) ? 'selected': '' }} value="1">Active</option>
                                                            <option {{ ($item->status == 0) ? 'selected': '' }} value="0">Deactive</option>
                                                        </select>
                                                     </div>
                                                   
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </form>
                                                </div>
                                                  
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmation_{{ $item->id }}" ><i class="fa fa-trash"></i></button>
                                 <!-- Modal -->
                                <div class="modal fade" id="deleteConfirmation_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationLabel">Delete Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Are Your Sure!? Your Action can not be undone</h4>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger" href="{{ route('products.destroy',$item->id) }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('delete-form').submit();">
                                            {{ __('Confirm') }}
                                        </a>

                                        <form id="delete-form" action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('footer_script')
@if(Session::has('success'))
    <script>
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ session('error') }}");
    </script>
@endif
@error('product_name')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('product_description')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('quantity')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('price')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('brand')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('stock')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@endsection