@extends('layouts.app')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 class="m-0 text-dark"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Insert News Category</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<section class="content">

<form action="{{ route('save_news_category') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
    <table class="table table-bordered">
        
        <tr>
            <td width="100">Title </td>
            <td><input type="text" name="titles" id="titles" class="form-control"></td>
        </tr>
        
        <tr>
            <td width="100">Detail</td>
            <td><input type="file" name="details" id="details" class="form-control" ></td>
        </tr>
        
    </table>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        <a href="{{ url('news_category')}}"><button type="button" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a>
    </div>
</form>
  </section>
  @endsection

@section('script')

<script>

</script>
@endsection
