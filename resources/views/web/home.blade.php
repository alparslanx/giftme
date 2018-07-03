@extends('web.layouts.app')
@section('title','User Panel | Giftme.com')
@section('content')
    @include('web.include.menu',['selected' => 'dashboard'])
    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Last Week Most Popular</h6>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded box-shadow">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Score</th>
                </tr>
                </thead>
                <tbody id="most-popuplar-list">

                </tbody>
            </table>
        </div>


    </main>

    <script type="text/javascript">
        $(document).ready(function(){
            $.getJSON("{{ route('api.user.most_popular.last_week') }}?token={{ \Illuminate\Support\Facades\Auth::user()->token }}", function( data ) {
                var xhtml = '';
                $.each( data, function( key, data ) {
                    xhtml += '<tr>' +
                        '<td>'+(parseInt(key)+1)+'</td>' +
                        '<td>'+data.name+'</td>' +
                        '<td>'+data.score+'</td>' +
                        '</tr>';
                });
                $('#most-popuplar-list').html(xhtml);
            });
        })
    </script>
@endsection