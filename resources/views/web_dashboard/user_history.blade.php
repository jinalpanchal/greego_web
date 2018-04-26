@extends('layouts.web.dashboard')

@section('content')

<div class="row p-3">
    <div class="col-12">
        <center><h4 class="green-color mt-4"><b>History</b></h4></center>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <!--<input type="hidden" id="token" name="_token" value=""/>-->

        <table id="user_history_table" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</div>


@endsection

@section('js')
<script>
    $(document).ready(function () {
        var dataTable = $('#user_history_table').DataTable({
            "ajax": "{{ route('user_history.datatable') }}",
//            "paging": false,
            "ordering": false,
//            "info": false,
            "searching": false,
            "language": {
                "emptyTable": "No trips available"
            }
        });
    });
    function collasping(id) {
//        var token = $('#token').val();
        $.ajax({
            url: '{{ route("user_history.trip_details") }}',
            type: 'GET',
            data: {trip_id: id},
            success: function (result) {
//                $('#total_price').html('$' + result.total_trip_amount);
//                $('#from_add').html(result.from_add);
//                $('#to_add').html(result.to_add);
//                $('#start_time').html(result.pickup_time);
//                $('#end_time').html(result.reach_time);
//                $('#greego_miles_time').html('Greego fare (1.41mi, 6m 49s)');
//                $('#greego_fare').html('$' + result.actual_trip_amount);
//                $('#promotion_price').html('$' + result.tip_amount);
//                $('#total_fare').html('$' + result.total_trip_amount);
//                var html = $('#collapse_div');
//                console.log(html);
               // $('#detail_' + id).html($('#collapse_div'));
                $('#detail_' + id).html(result);
                $('#collapse_div').show();
            }
        });
    }
</script>
@endsection