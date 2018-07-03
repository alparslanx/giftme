@extends('web.layouts.app')
@section('title','User Panel | Giftme.com')
@section('content')
    @include('web.include.menu',['selected' => 'send_gift'])
    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Send Gift</h6>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded box-shadow">
            <div class="form-group">
                <label for="inputlg">Email</label>
                <input class="form-control input-lg" id="inputlg" type="text" name="to">
            </div>

            <div class="form-group">
                <label for="inputlg">Gift</label>
                <select class="form-control" id="gift_list" name="id">

                </select>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-success" data-status="1">Send</button>
            </div>


        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function(){
            $.getJSON("{{ route('api.user.gift.list') }}?token={{ \Illuminate\Support\Facades\Auth::user()->token }}", function( data ) {
                var xhtml = '';
                $.each( data, function( key, data ) {
                    xhtml += '<option value="'+data.id+'">'+data.gift_name+'</option>';
                });
                $('#gift_list').html(xhtml);
            });

            $('html').on('click','button',function(){
                var _this = this;
                $.ajax({
                    type: "POST",
                    url: '{{ route('api.user.gift.send') }}?token={{ \Illuminate\Support\Facades\Auth::user()->token }}',
                    data: {to: $('input[name=to]').val(), id: $('#gift_list').val()},
                    dataType: 'json',
                    xhrFields: { withCredentials: true },
                    success: function(response){
                        $(_this).parents('tr').hide();
                        alert(response.message);
                    },
                    error: function(xhr){
                        response = jQuery.parseJSON(xhr.responseText);
                        alert(response.message);
                    }
                });
            });
        })
    </script>
@endsection