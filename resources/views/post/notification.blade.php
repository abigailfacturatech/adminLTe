@extends('layouts.master')

@section('content')


<div>
    <div class="rw justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Unread Notifications</div>
                <div class="card-body">
                    @if (auth()->user())
                    @forelse ( $postNotifications as $notification )
                        <div class="alert alert-default-warning">
                            Post title: {{ $notification->data['title'] }}
                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                       <button type="submit"class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}">Mark as read</button>

                        </div>

                        @if ($loop->last)
                        <a href="#" id="mark-all">Mark all as read</a>

                        @endif

                    @empty
                        There are no notification
                    @endforelse

                    @endif

                      {{-- @foreach (auth()->user()->unreadNotifications as $notification)
                      <a href="#" class="dropdown-item">
                      <i class="fas fa-envelope mr-2"></i> {{ $notification->data['title'] }}
                      <div class=""></div> {{ $notification->data['description'] }}
                      <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                      @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        function sendMarkRequest(id = null){
            return $.ajax("{{ route('markNotification') }}",{
                method: 'POST',
                data:{
                    _token: "{{ csrf_token() }}",
                    id
                }
            });
        }

        $(function(){
            $('.mark-as-read').click(function(){
                let request = sendMarkRequest($(this).data('id'));

                request.done(() => {
                    $(this).parents('div.alert').remove();
                });
            });

            $('#mark-all').click(function(){
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                });
            });
        });

    </script>
@endsection
