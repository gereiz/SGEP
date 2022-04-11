
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)

        toastr['error']('{!! $error !!}', '', {
            positionClass:     'toast-top-center',
            closeButton:       false,
            progressBar:       false
        });

    @endforeach
@endif

@if ($message = Session::get('success'))
    @if(is_array($message))
        @foreach ($message as $msg)

            toastr['success']('{!! $msg !!}', '', {
                positionClass:     'toast-top-center',
                closeButton:       false,
                progressBar:       false
            });   
        
        @endforeach
    @else

        toastr['success']('{!! $message !!}', '', {
            positionClass:     'toast-top-center',
            closeButton:       false,
            progressBar:       false
        });        

    @endif
@endif

@if ($message = Session::get('error'))
    @if(is_array($message))
        @foreach ($message as $msg)

            toastr['error']('{!! $msg !!}', '', {
                positionClass:     'toast-top-center',
                closeButton:       false,
                progressBar:       false
            });        

        @endforeach
    @else

        toastr['error']('{!! $message !!}', '', {
            positionClass:     'toast-top-center',
            closeButton:       false,
            progressBar:       false
        });    

    @endif
@endif

@if ($message = Session::get('warning'))
    @if(is_array($message))
        @foreach ($message as $msg)

            toastr['warning']('{!! $msg !!}', '', {
                positionClass:     'toast-top-center',
                closeButton:       false,
                progressBar:       false
            });           

        @endforeach
    @else

        toastr['warning']('{!! $message !!}', '', {
            positionClass:     'toast-top-center',
            closeButton:       false,
            progressBar:       false
        });        

    @endif
@endif

@if ($message = Session::get('info'))
    @if(is_array($message))
        @foreach ($message as $msg)

            toastr['info']('{!! $msg !!}', '', {
            positionClass:     'toast-top-center',
            closeButton:       false,
            progressBar:       false
            });           

        @endforeach
    @else

        toastr['info']('{!! $message !!}', '', {
            positionClass:     'toast-top-center',
            closeButton:       false,
            progressBar:       false
        });        

    @endif
@endif

