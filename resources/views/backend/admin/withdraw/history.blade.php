@extends('layouts.backend')
@section('title')
    Payout History
@endsection
@section('content')

<div class="card">

    <!-- Column Search -->
    <div class="">
        <table class="table yajra-datatable" id="result2">
            <thead>
                <tr>
                    <th>user</th>
                    <th>amount</th>
                    <th>Purpose</th>
                    <th>type</th>
                    <th>date</th>
                    <th>status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!--/ Column Search -->

    @include('backend.admin.components.models.payoutShow')

</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {

        var table = $('#result2').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('getTPayoutHistory') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'user', name: 'user'},
                {data: 'amount', name: 'amount'},
                {data: 'purpose', name: 'purpose'},
                {data: 'type', name: 'type'},
                {data: 'date', name: 'date'},
                {
                    data: 'status', 
                    name: 'status', 
                    orderable: true, 
                    searchable: true,
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true,
                }
            ],
            dom: 'Bfrtip'
        });

        // open modal

        $('body').on('click', '.show-detailss', function () {

            var userURL = $(this).data('url');

            // $.get(userURL, function (data) {

            //     var url = "{{route('admin.debit.payout.approve', '')}}"+"/"+data.id;
            //     console.log(url);
            //     $('#payoutShowModal').modal('show');

            //     $('#data-iban').text(data.user.payoutdata.iban);
            //     $('#data-type').text(data.transactionType);
            //     $('#data-amount').text(data.transactionAmount);
            //     $('#data-purpose').text(data.purpose);
            //     $('#data-note').text(data.note);
            //     $('#data-country').text(data.user.payoutdata.country);
            //     // admin.debit.payout.approve
            //     $('#withdrawAccept').addClass('disaple');
            //     if (data.status == 1) {
            //         $('#withdrawAccept').addClass('disaple');
            //     } else {
            //         $('#withdrawAccept').removeClass('disaple');
            //         $('#withdrawAccept').attr('href',url);
            //     }
            //     if (data.transaction_id === null) {
            //         $('#transaction_id').hide();
            //     } else {
            //         $('#transaction_id').show();
            //         $('#data-transaction_id').text(data.transaction_id);
            //     }
            // })

            $.ajax({
                url: userURL,
                type: 'GET',
                success: function(data){ 
                    var url = "{{route('admin.debit.payout.approve', '')}}"+"/"+data.id;
                    console.log(url);
                    $('#payoutShowModal').modal('show');

                    $('#data-iban').text(data.user.payoutdata.iban);
                    $('#data-type').text(data.transactionType);
                    $('#data-amount').text(data.transactionAmount);
                    $('#data-purpose').text(data.purpose);
                    $('#data-note').text(data.note);
                    $('#data-country').text(data.user.payoutdata.country);
                    // admin.debit.payout.approve
                    $('#withdrawAccept').addClass('disaple');
                    if (data.status == 1) {
                        $('#withdrawAccept').addClass('disaple');
                    } else {
                        $('#withdrawAccept').removeClass('disaple');
                        $('#withdrawAccept').attr('href',url);
                    }
                    if (data.transaction_id === null) {
                        $('#transaction_id').hide();
                    } else {
                        $('#transaction_id').show();
                        $('#data-transaction_id').text(data.transaction_id);
                    }
                },
                error: function(data) {
                    alert('woops!'); //or whatever
                }
            }).done(function() {
                setTimeout(function(){
                    $(".page-loading").fadeOut(300);
                },500);
            });
        });

    });


</script>
@endsection