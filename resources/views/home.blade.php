@extends('adminlte::page')

@section('title', 'Panel Star Destiny')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Time Line de Noticias!</p>
                    @if (session('success'))

                    <div id="alerta-time" class="alert alert-success p-2">
                        {!! session('success') !!}
                    </div>
                    @endif
                    @if (session('error'))

                        <div id="alerta-time" class="alert alert-danger p-2">
                            {!! session('error') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-sm-center flex-wrap row">
            @foreach ($news as $News)
            
                <!-- Main node for this component -->
                <div class="timeline">
                    <!-- Timeline time label -->
                    <div class="time-label">
                        <span class="bg-blue">{{date("d/m/Y", strtotime($News->date))}}</span>
                    </div>
                    <div>
                        <!-- Before each timeline item corresponds to one icon on the left scale -->
                        <i class="fas fa-comments bg-blue"></i>
                        <!-- Timeline item -->
                        <div class="timeline-item">
                        <!-- Time -->
                            <span class="time"><i class="fas fa-clock"></i> {{$News->hour}}</span>
                            <!-- Header. Optional -->
                            <h3 class="timeline-header">{{$News->title}}</h3>
                            <!-- Body -->
                            <div class="timeline-body width-380">
                                {{$News->news}}
                            </div>
                            <!-- Placement of additional controls. Optional -->
                            {{-- <div class="timeline-footer">
                                <p class="timeline-header">{{$News->autor}}</p>
                            </div> --}}
                        </div>
                    </div>
                    <!-- The last icon means the story is complete -->
                    <div>
                        <i class="fas fa-user bg-grey btn-left"></i>

                        <div class="autor btn-left ">{{$News->autor}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@section('footer')
     @include('layouts.footer')
@stop
