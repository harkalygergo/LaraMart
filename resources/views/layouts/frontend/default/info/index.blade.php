@extends(env('LAYOUT').'.base')

@section('main')
    @include(env('LAYOUT').'.components.header-forms')

    <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-4 g-4 py-4">
        @foreach ($blogs as $blog)

            <div class="col p-0">
                <div class="card m-0 p-0 p-md-2 shadow mx-2 h-100">
                    <div class="card-body">
                        <p class="card-text">
                            <span class="source-sans-pro-black">
                                <a class="text-black text-decoration-none" href="/info/{{ $blog['slug'] }}">
                                    {{ $blog['title'] }}
                                </a>
                            </span>
                            <br>{{ $blog['excerpt'] }}
                        </p>
                    </div>
                    <div class="card-footer text-center bg-white d-grid">
                        <a href="{{ route('info.show', $blog['slug']) }}" class="btn btn-primary btn-fluid text-capitalize px-sm-5 py-sm-2">
                            <i class="bi bi-eye"></i> megnézem
                        </a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>



@endsection
