@extends('layouts.app')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 class="m-0 text-dark"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit News</h1>
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

          <form action="{{ route('update_news') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table class="table table-bordered">
              <tr>
                <td width="100">Date :</td>
                <td><input type="date" name="date" id="date" format="YYYY-MM-DD" value="{{ date($news->date) }}"></td>
              </tr>
              <tr>
                <td width="100">Images</td>
                <td><img src="{{ asset('asset/images_1/'.$news->images.'') }}" width="200"></td>
              </tr>
              <tr>
                <td width="100">File</td>
                <td><input type="file" name="images" id="images" class="form-control"></td>
              </tr>
              <tr>
                <td width="100">Title</td>
                <td><input type="text" name="titles" id="titles" class="form-control" value="{{ $news->titles }}"></td>
              </tr>
             
              <tr>
                <td width="100">Detail</td>
                <td><textarea name="details" id="details" class="form-control"  rows="6" cols="50">{!! $news->details !!}</textarea></td>
              </tr>
              
            </table>
            <input type = "hidden" name="id" id="id" value="{{ $news->id }}">
              <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</button>
              <a href="{{ url('news/'.$news->cat_id.'') }}"><button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a>
            </div>
            </form>
  </section>
  @endsection

@section('script')
<script>

</script>
@endsection
