@extends('layouts.app')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-1">
        <div class="col-sm-10">
          <h1 class="m-0 text-dark"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;News</h1>
        </div>
        <div class="col-sm-2">
            <a href="{{ url('insert_news/'.$cat_id.'') }}">
                <button type="button" class="btn btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Insert</button>
            </a>
            <a href="{{ url('news_category') }}">
                <button type="button" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></i>&nbsp;Back</button>
            </a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<section class="content">
@if(Session::has('success'))
<div class="alert alert-success" style="text-align: center">{{Session::get('success')}}
<button type="button" class="close" data-dismiss="alert">×</button>
</div>
@endif
<div class="work-pane on-simple-bar">

    <br>
    <div class="work-con">
        <div class="tab-content" id="master-tabContent">
            <div id="con_1" aria-labelledby="tab_1" role="tabpanel" class="tab-pane fade show active">
                <table class="table table-bordered data-table" id="list_news" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Images</th>
                            <th>Titles</th>
                            <th>Details</th>
                            <th width="300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="cat_id" id="cat_id" class = "form-control " value="{{ $cat_id }}">

</section>
@endsection

@section('script')

<script type="text/javascript">


    var token = $('meta[name="csrf-token"]').attr('content');
     var cat_id = document.getElementById("cat_id").value;
         $('#list_news').DataTable({
             scrollY: true,
             scrollCollapse: true,
             searching: true,
             "ajax": {
              "url": '{{url("news_data")}}',
              "type": 'GET',
              "data": {
                "cat_id": cat_id,
                "_token": token,
              },
              },
             columns : [
            { data : 'no' },
            { data : 'date' },
            { data : 'images' },
            { data : 'titles' },
            { data : 'details' },
            { data : 'active' }
             ],
         }); 
    
</script>



<script type="text/javascript">
  function ConfirmDelete(id,image){
    if(confirm("ConfirmDelete?"))
    {
     $.ajax({
        url:"{{ route('delete_news')}}",
        method:"POST",
        data:{
        "_token": "{{ csrf_token() }}",
        id:id,
        image:image
    },
    success:function(data){
      // Swal.fire({
      //   title: data,
      //   type: 'success',
      //   timer: 70000,
      //   showCloseButton: true
      // })
      window.location.reload();
    },
    error:function(data){
        // Swal.fire({
        //   title: "Error",
        //   type: 'error',
        //   timer: 3000,
        //   showCloseButton: true
        // })
    }
    });
    }
    }
</script>

@endsection
