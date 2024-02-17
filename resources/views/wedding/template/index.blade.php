@extends('layouts.master')
@section('title','Template')
@push('pages-style')
<style>
  .shadow-image {
    box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    -webkit-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
    -moz-box-shadow: 6px 6px 13px -9px rgba(103,119,239,1);
  }
  .shadow-inv-icon {
    box-shadow: 0px 0px 15px 0px rgba(255,255,255,0.75);
    -webkit-box-shadow: 0px 0px 15px 0px rgba(255,255,255,0.75);
    -moz-box-shadow: 0px 0px 15px 0px rgba(255,255,255,0.75);
    -o-box-shadow: 0px 0px 15px 0px rgba(255,255,255,0.75);
    border-radius:100px;
  }
</style>
@endpush
@section('content')
    @include('layouts.alert')

          <div class="section-body">
            {{-- <h2 class="section-title">Articles</h2>
            <p class="section-lead">This article component is based on card and flexbox.</p> --}}
            
            <div class="row">
              @foreach ($template as $no => $t)
              <div class="col-12 col-sm-6 col-md-6 col-lg-3">
              <form action="/dashboard/wedding/template/{{$t->id}}" method="POST">
              @csrf
              @method('patch')
                <article class="article">
                  <div class="article-header" style="padding: 10px;">
                    <div class="article-image shadow-image" data-background="{{asset('assets/img/wedding/template')}}/{{$t->photo}}" style="background-image: url(&quot;{{asset('assets/img/wedding/template')}}/{{$t->photo}}&quot;);">
                    </div>
                    <div class="article-badge" style="padding: 5px;">
                      @if ($wedding_info[0]->template_id == $t->id)
                      <div class="article-badge-item bg-warning"><i class="fas fa-check"></i> Dipilih</div>
                      @else
                      {{-- <img class="shadow-inv-icon" data-toggle="tooltip" data-placement="top" title="Require '{{$t->invoice_type->invoice_level->name}}' Package" alt="{{$t->invoice_type->invoice_level->name}}" width="26px" src="{{asset('assets/img/levels/'.$t->invoice_type->invoice_level->image)}}"> --}}
                      @endif
                    </div>
                    <!-- <div class="article-title">
                      <h2><a href="#">Title</a></h2>
                    </div> -->
                  </div>
                  <div class="article-details">
                    <div class="article-title" style="margin-bottom: 20px; text-align: center;">
                      <h5><a href="">{{$t->name}}</a> <img class="shadow-inv-icon" data-toggle="tooltip" data-placement="top" title="Require '{{$t->invoice_type->invoice_level->name}}' Package" alt="{{$t->invoice_type->invoice_level->name}}" width="22px" src="{{asset('assets/img/levels/'.$t->invoice_type->invoice_level->image)}}"></h5>
                    </div>
                    <div class="article-cta">
                      @if ($wedding_info[0]->template_id != $t->id)
                      <a href="{{route('invitation.preview', [$t->template_category->name,$template_user->user_url,$t->id])}}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-search"></i> Preview</a>
                      <button class="btn btn-primary" type="submit"><i class="fas fa-check"></i> Pilih</button>
                      @else
                      <a href="{{route('invitation.index', [$t->template_category->name,$template_user->user_url])}}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-search"></i> View</a>
                      @endif
                    </div>
                  </div>
                </article>
              </form>
              </div>
              @endforeach
            </div>
          </div>
@endsection
@section('modal')
  @if (session('buypackage'))
    <div class="modal fade" id="modalBuyPackage" tabindex="-1" role="dialog" aria-labelledby="modalBuyPackageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalBuyPackageLabel">Upgrade Package</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><span class="text-danger">Oops! Kamu tidak bisa memilih Template {{session('buypackage')->name}}.</span> <span class="text-primary">Beli Paket <b>{{session('buypackage')->invoice_type->name}}</b></span> agar Kamu bisa pakai Template {{session('buypackage')->name}}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a href="{{route('subscribe.index.package_id',session('buypackage')->invoice_type->id)}}" class="btn btn-primary">Beli <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection

@push('page-script')
<script>
  @if (session('buypackage'))
    $('#modalBuyPackage').modal('show');
  @endif
</script>

<!-- <script src="{{asset('assets/stisla/chart.js/dist/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/page/modules-chartjs.js')}}"></script> -->
@endpush