@extends('layouts.master')
@section('title','Edit Feedback')
@section('content')
    
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Feedback</h4>
              </div>
              <div class="card-body">
                <form action="{{route('feedback.update',$feedback->id)}}" method="POST">
                  @csrf
                  @method('patch')
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label @error('ulasan')
                                              class="text-danger"
                                          @enderror>Feedback  @error('ulasan')
                                              | {{$message}}
                                          @enderror
                                </label>
                                <input type="text" class="form-control" name="user" value="{{$feedback->user->name}}" readonly>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label @error('ulasan')
                                              class="text-danger"
                                          @enderror>Feedback  @error('ulasan')
                                              | {{$message}}
                                          @enderror
                                </label>
                                <textarea class="form-control" name="ulasan" readonly>{{$feedback->ulasan}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label @error('status')
                                              class="text-danger"
                                          @enderror>Status @error('status')
                                              | {{$message}}
                                          @enderror
                                </label>
                                <select name="status" id="" class="form-control">
                                    <option value="{{Constant::FALSE_CONDITION}}" {{$feedback->status == Constant::FALSE_CONDITION ? 'selected' : ''}}> Jangan Publish </option>
                                    <option value="{{Constant::TRUE_CONDITION}}" {{$feedback->status == Constant::TRUE_CONDITION ? 'selected' : ''}}> Publish </option>
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="form-group">
                        <button class="btn btn-primary mr-1" type="submit">Submit </button>
                        <button class="btn btn-success" type="reset">Reset </button>
                    </div>
              </form>
      </div>
</div>
@endsection

@push('page-scripts')
    
@endpush