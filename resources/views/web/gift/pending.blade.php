@extends('web.layouts.app')
@section('title','User Panel | Giftme.com')
@section('content')
    @include('web.include.menu',['selected' => 'pending_gift'])
    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Pending Gift List</h6>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded box-shadow">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Date</th>
                    <th scope="col">Operation</th>
                </tr>
                </thead>
                <tbody id="pending-list">

                </tbody>
            </table>
        </div>


    </main>

    <script type="text/javascript">
        $(document).ready(function(){
            $.getJSON("{{ route('api.user.gift.pending_list') }}?token={{ \Illuminate\Support\Facades\Auth::user()->token }}", function( data ) {
                var xhtml = '';
                $.each( data, function( key, data ) {
                    xhtml += '<tr data-id="'+data.id+'">' +
                        '<td>'+(parseInt(key)+1)+'</td>' +
                        '<td>'+data.gift_name+'</td>' +
                        '<td>'+data.sender_name+'</td>' +
                        '<td>'+data.updated_at+'</td>' +
                        '<td><button type="button" class="btn btn-success btn-sm" data-status="1">Accept</button><button type="button" class="btn btn-danger btn-sm" data-status="2">Reject</button></td>' +
                        '</tr>';
                });
                $('#pending-list').html(xhtml);
            });

            $('html').on('click','button',function(){
                var _this = this;
                $.ajax({
                    type: "POST",
                    url: '{{ route('api.user.gift.change_status') }}?token={{ \Illuminate\Support\Facades\Auth::user()->token }}',
                    data: {id: $(this).parents('tr').data('id'), status: $(this).data('status')},
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