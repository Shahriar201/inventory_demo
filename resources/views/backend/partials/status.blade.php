<!-- error/success messages -->
@if (isset($errors) && count($errors))
    @push('js')
        <script>
            toastr['error']("{{$errors->first()}}", '', {
                positionClass: 'toast-top-right'
            })
        </script>
    @endpush
@endif

@if(session()->has('success'))
    @push('js')
        <script>
            toastr['success']("{{session()->get('success')}}", '', {
                positionClass: 'toast-top-right'
            });
        </script>
    @endpush
@endif

@if(session()->has('error'))
    @push('js')
        <script>
            toastr['error']("{{session()->get('error')}}", '', {
                positionClass: 'toast-top-right'
            })
        </script>
    @endpush
@endif
<!-- END -->
