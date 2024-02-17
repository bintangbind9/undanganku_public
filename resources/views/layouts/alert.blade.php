@if (session()->has('success') || session()->has('warning') || session()->has('error'))
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible show fade">
    @elseif (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible show fade">
    @elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible show fade">
    @endif
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>x</span>
            </button>
            @if (session('success'))
                {{ session('success') }}
            @elseif (session('warning'))
                {{ session('warning') }}
            @elseif (session('error'))
                {{ session('error') }}
            @endif
        </div>
    </div>
@endif

@if (!empty($success) || !empty($warning) || !empty($error))
    @if (!empty($success))
    <div class="alert alert-success alert-dismissible show fade">
    @elseif (!empty($warning))
    <div class="alert alert-warning alert-dismissible show fade">
    @elseif (!empty($error))
    <div class="alert alert-danger alert-dismissible show fade">
    @endif
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>x</span>
            </button>
            @if (!empty($success))
                {{ $success }}
            @elseif (!empty($warning))
                {{ $warning }}
            @elseif (!empty($error))
                {{ $error }}
            @endif
        </div>
    </div>
@endif