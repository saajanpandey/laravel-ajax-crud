@extends('header')
@section('title','Ajax CRUD')
@section('inputs')



{{-- Navbar Section --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Ajax Crud In Laravel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item mr-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Product
              </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Products List in Tables --}}

  <table class="table table-striped">
    <thead>
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @php $no=1;@endphp
          @foreach ($products as $product)
          <tr>

          <th scope="row">{{$no++}}</th>
          <td>{{$product->name}}</td>
          <td>{{$product->price}}</td>
          <td>
            <button type="button" id="infoBttn"  data-id="{{ $product->id }}" data-bs-toggle="" data-bs-target="" class="btn btn-info">Product Info</button>
         <button type="button" id="updateBttn" data-id="{{ $product->id }}" class="btn btn-secondary">Update</button>
          <button type="button" data-id="{{ $product->id }}" id ="deleteBttn" class="btn btn-danger">Delete</button></td>
        </tr>
          @endforeach

      </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {!! $products->links() !!}
</div>



  {{-- Modal Section --}}
  <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="postForm" name="postForm" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                 <div class="form-group">
                     <label for="title" class="col-sm-6 control-label">Product Name</label>
                     <div class="col-sm-12">
                         <input type="text" class="name form-control" id="name" name="name" placeholder="Enter Product Name" value="" required>
                     </div>
                 </div>

                 <div class="form-group">
                    <label for="title" class="col-sm-6 control-label">Product Price</label>
                    <div class="col-sm-12">
                        <input type="text" class="price form-control" id="price" name="price" placeholder="Enter Product Price" value="" required>
                    </div>
                </div>

                 <div class="form-group">
                     <label class="col-sm-2 control-label">Description</label>
                     <div class="col-sm-12">
                         <textarea  class="description" name="description" required placeholder="Enter Description" class="form-control"></textarea>
                     </div>
                 </div>

             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveBttn">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Show Modal --}}
  <div class="modal fade infoModal" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="title" class="col-sm-6 control-label">Product Name</label>
                <div class="col-sm-12">
                    <input type="text" readonly class="name form-control" id="name" name="name" placeholder="Enter Product Name" value="" required>
                </div>
            </div>

            <div class="form-group">
               <label for="title" class="col-sm-6 control-label">Product Price</label>
               <div class="col-sm-12">
                   <input type="text" class="price form-control" id="price" readonly name="price" placeholder="Enter Product Price" value="" required>
               </div>
           </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                    <textarea  class="description" name="description" id="description" readonly required placeholder="Enter Description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Update Modal --}}

  <div class="modal fade updateModal" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="updateForm" name="postForm" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                 <div class="form-group">
                     <label for="title" class="col-sm-6 control-label">Product Name</label>
                     <div class="col-sm-12">
                         <input type="text" class="name form-control" id="name" name="name" placeholder="Enter Product Name" value="" required>
                     </div>
                 </div>

                 <div class="form-group">
                    <label for="title" class="col-sm-6 control-label">Product Price</label>
                    <div class="col-sm-12">
                        <input type="text" class="price form-control" id="price" name="price" placeholder="Enter Product Price" value="" required>
                    </div>
                </div>

                 <div class="form-group">
                     <label class="col-sm-2 control-label">Description</label>
                     <div class="col-sm-12">
                         <textarea  class="description" name="description" id="description" required placeholder="Enter Description" class="form-control"></textarea>
                     </div>
                 </div>

             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="updateSaveBttn">Save Changes</button>
        </div>
      </div>
    </div>
  </div>




@endsection

@section('scripts')
<script type="text/javascript">



//  Insertion ajax is from here:

        $(document).on('click','#saveBttn' ,function (e) {
                e.preventDefault(e);
            var data = {
                'name': $('.name').val(),
                'price':$('.price').val(),
                'description':$('.description').val(),
            }


            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

            $.ajax({
                type: "POST",
                url: "product/store",
                data: data,
                dataType: "json",
                success: function (response) {
                        if(response.status==200){
                            location.reload();
                            $('#addModal').modal('hide');
                            $('#addModal').find('.name').val("");
                            $('#addModal').find('.price').val("");
                            $('#addModal').find('.description').val("");
                        }

                }
            });
        });

        // Delete of record section

        $(document).on('click','#deleteBttn', function (e) {
            e.preventDefault(e);


            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
           var id = $(this).data("id");

           console.log(id);

            $.ajax({
                type: "POST",
                url: "product/delete/"+id,
                data:{
                    "id":id,
                },
                dataType: "JSON",
                success: function (response) {
                    location.reload();
                }
            });


        });


//    Show info of product

            $(document).on('click','#infoBttn',function(){

            var id = $(this).data("id");

            $.ajax({
                type: "GET",
                url: "product/show/"+id,
                data:{
                    "id":id,
                },
                success: function (data) {
                        $("#infoModal").modal("show");
                        $(".infoModal #name").val(data.name);
                        $(".infoModal #price").val(data.price);
                        $(".infoModal #description").val(data.description);

                }
            });

            })

            // Update Product


              $(document).on('click','#updateBttn', function () {

                var id = $(this).data("id");

                $.ajax({
                type: "GET",
                url: "product/show/"+id,
                data:{
                    "id":id,
                },
                success: function (data) {
                        $(".updateModal").modal("show");
                        $(".updateModal #id").val(data.id);
                        $(".updateModal #name").val(data.name);
                        $(".updateModal #price").val(data.price);
                        $(".updateModal #description").val(data.description);

                }
            });

              });

              $(document).on('click','#updateSaveBttn', function (e) {
                    e.preventDefault(e);



            $.ajaxSetup({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

                var id = $(".updateModal #id").val();

                var data = {
                    'name': $(".updateModal #name").val(),
                    'price': $(".updateModal #price").val(),
                    'description':$(".updateModal #description").val(),
                }

                    console.log(data);
              $.ajax({
                type: "POST",
                url: "/product/update/"+id,
                data: data,
                dataType: "JSON",
                success: function (response) {
                            location.reload();

                }
              });
        });



  </script>
@endsection
