@extends('layouts.master')
@section('title','Create Feedback')
@section('content')
    
<div class="section-body">
  @if (session('message')) 
  <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        {{session('message')}}
      </div>
    </div>
  @endif
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Create Feedback</h4>
              </div>
              <div class="card-body">
                <form action="{{route('feedback.store')}}" method="POST">
                  @csrf
                     
                                <div class="form-group">
                                      <label @error('ulasan')
                                              class="text-danger"
                                          @enderror>Feedback  @error('ulasan')
                                              | {{$message}}
                                          @enderror
                                        </label>
                                      <textarea class="form-control" name="ulasan" required></textarea>
                                  </div>
                          
                    <div class="form-group float-right">
                        <button class="btn btn-outline-secondary mr-1" type="reset">Reset </button>
                        <button class="btn btn-primary" type="submit">Submit </button>
                    </div>
              </form>
      </div>
</div>
@endsection

@push('page-scripts')
    
@endpush