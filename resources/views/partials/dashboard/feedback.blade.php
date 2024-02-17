@if (count($feedbacks) > 0)
    <ul class="list-unstyled list-unstyled-border">
        @foreach ($feedbacks as $f_no => $f)
            <li class="media">
                <span class="btn-update-feedback btn btn-icon btn-outline-primary mr-3" data-toggle="tooltip" title="Publish" data-url="{{route('feedback.update_status',$f->id)}}" data-status="{{Constant::TRUE_CONDITION}}"><i class="fas fa-check"></i></span>
                <div class="media-body">
                    <i class="btn-update-feedback fas fa-times float-right text-danger" style="cursor:pointer;" data-url="{{route('feedback.update_status',$f->id)}}" data-status="{{Constant::FALSE_CONDITION}}"></i>
                    <div id="feedback-date-{{$f->id}}" class="feedback-date" data-date="{{Carbon\Carbon::parse($f->created_at)->toIso8601String()}}"></div>
                    <div class="media-title">{{$f->user->name}}</div>
                    <span class="text-small text-muted">{{$f->ulasan}}</span>
                </div>
            </li>
            @if (++$f_no == Constant::MAX_FEEDBACK_DISPLAYED_ON_DASHBOARD)
                @break
            @endif
        @endforeach
    </ul>
    @if (count($feedbacks) > Constant::MAX_FEEDBACK_DISPLAYED_ON_DASHBOARD)
        <div class="text-center pt-1 pb-1">
            <a href="{{route('feedback.index')}}" class="btn btn-primary btn-lg btn-round">
                Lihat semua
            </a>
        </div>
    @endif
@else
    <div class="text-center pt-1 pb-1">
        <p>Tidak ada</p>
    </div>
@endif
