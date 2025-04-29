@extends('layouts.app')
@section('title', 'Service Providers')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-end flex-wrap gap-3 justify-content-end">
        <a href="{{ route('providers.bookings.create') }}"
            class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Add Booking
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table id="providersTable" class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Service Booked</th>
                        <th scope="col">Date Booked</th>
                        <th scope="col">Transaction Code</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>
                                 {{ $booking->client_name }}

                            </td>
                            <td>{{ $booking->service_title }} <br>
                                Ksh ( {{ $booking->min_price }} - {{ $booking->max_price }} )
                            </td>
                            <td>{{ $booking->booking_date }} at {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</td>
                            <td>{{ $booking->transaction_code }}</td>
                            <td>{{ $booking->notes }}</td>
                            <td class="text-center">
                                @if ($booking->status == 'confirmed')
                                    <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                                @elseif($booking->status == 'blocked')
                                    <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-2 justify-content-center">
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('providers.bookings.confirm', $booking->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this payment?')">
                                                Confirm
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#providersTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excelHtml5', text: 'Export to Excel', className: 'btn btn-success' },
                    { extend: 'csvHtml5', text: 'Export to CSV', className: 'btn btn-primary' },
                    { extend: 'pdfHtml5', text: 'Export to PDF', className: 'btn btn-danger' }
                ]
            });
        });
    </script>
@endsection
