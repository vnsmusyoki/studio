@extends('layouts.app')
@section('title', 'Payments')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Payments</h4>
        </div>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table id="providersTable" class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th scope="col">Service Booked</th>
                        <th scope="col">Date Scheduled</th>
                        <th scope="col">Provided By</th>
                        <th scope="col">Booked By</th>
                        <th scope="col">Status</th>
                        {{-- <th scope="col" class="text-center">Action</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($payments as $booking)
                        <tr>
                            <td>
                                {{ $booking->booking->servicebooking->title }}

                            </td>
                            <td>{{ $booking->booking->booking_date }} at {{ \Carbon\Carbon::parse($booking->booking->booking_time)->format('h:i A') }}</td>
                            <td>{{ $booking->booking->provider->name }}</td>
                            <td>{{ $booking->client->name }}</td>
                            <td class="text-center">
                                @if ($booking->booking->payment_status == 'approved')
                                    <span class="badge bg-success">{{ ucfirst($booking->booking->payment_status) }}</span>
                                @elseif($booking->payment_status == 'blocked')
                                    <span class="badge bg-danger">{{ ucfirst($booking->booking->payment_status) }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($booking->booking->payment_status) }}</span>
                                @endif
                            </td>
                            {{-- <td class="text-center">
                                <div class="d-flex align-items-center gap-2 justify-content-center">

                                    <a href="{{ route('admin.providers.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.providers.destroy', $booking->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this provider?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td> --}}
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
