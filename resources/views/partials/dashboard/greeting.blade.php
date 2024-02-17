@if (count($greetings) > 0)
    <ul class="list-unstyled list-unstyled-border">
        @foreach ($greetings as $g_no => $g)
            <li class="media">
                <span class="btn-update-greeting btn btn-icon btn-outline-primary mr-3" data-toggle="tooltip" title="Tampilkan" data-url="{{route('greeting.update',[strtolower(Constant::CODE_WEDDING), $g->id])}}" data-status="{{Constant::TRUE_CONDITION}}"><i class="fas fa-check"></i></span>
                <div class="media-body">
                    <i class="btn-update-greeting fas fa-times float-right text-danger" style="cursor:pointer;" data-url="{{route('greeting.update',[strtolower(Constant::CODE_WEDDING), $g->id])}}" data-status="{{Constant::FALSE_CONDITION}}"></i>
                    <div id="greeting-date-{{$g->id}}" class="greeting-date" data-date="{{Carbon\Carbon::parse($g->date)->toIso8601String()}}"></div>
                    <div class="media-title">{{$g->guest->name}}</div>
                    <span class="text-small text-muted">{{$g->greeting}}</span>
                </div>
            </li>
            @if (++$g_no == Constant::MAX_GREETING_DISPLAYED_ON_DASHBOARD)
                @break
            @endif
        @endforeach
    </ul>
    @if (count($greetings) > Constant::MAX_GREETING_DISPLAYED_ON_DASHBOARD)
        <div class="text-center pt-1 pb-1">
            <a href="{{route('greeting.index',strtolower(Constant::CODE_WEDDING))}}" class="btn btn-primary btn-lg btn-round">
                Lihat semua
            </a>
        </div>
    @endif
@else
    <div class="text-center pt-1 pb-1">
        <p>Tidak ada</p>
    </div>
@endif
