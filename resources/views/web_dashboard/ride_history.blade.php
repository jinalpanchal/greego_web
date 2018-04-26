@extends('layouts.web.dashboard')

@section('content')

<div class="row p-3">
    <div class="col-12">
        <center><h4 class="green-color mt-4"><b>{{ $year }}</b></h4></center>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <input type="hidden" id="year" value="{{ $year }}"/>
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
        var year_data = $('#year').val();
        var dataTable = $('#user_history_table').DataTable({
            "ajax": "{{ route('driver.ride_history_detail','" + year_data + "') }}",
//            "paging": false,
            "ordering": false,
//            "info": false,
            "searching": false,
            "language": {
                "emptyTable": "No trips available"
            }
        });
    });

</script>
@endsection