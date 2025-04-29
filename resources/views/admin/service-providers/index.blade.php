@extends('layouts.app')
@section('title', 'Service Providers')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-end flex-wrap gap-3 justify-content-end">
        <a href="{{ route('admin.providers.create') }}"
            class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Add Service Provider
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table id="providersTable" class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th scope="col">Profile Picture</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($providers as $provider)
                        <tr>
                            <td>
                                @if($provider->profile_picture)
                                    <img src="{{ asset('storage/' . $provider->profile_picture) }}" alt="Profile Picture" style="height: 48px; width: 48px;border-radius: 50%;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $provider->name }}" alt="Profile Picture" class="rounded-circle" width="32" height="32">
                                @endif
                            </td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>{{ $provider->phone_number }}</td>
                            <td class="text-center">
                                @if ($provider->status == 'approved')
                                    <span class="badge bg-success">{{ ucfirst($provider->status) }}</span>
                                @elseif($provider->status == 'blocked')
                                    <span class="badge bg-danger">{{ ucfirst($provider->status) }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($provider->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-2 justify-content-center">
                                    @if($provider->status == 'pending')
                                        <form action="{{ route('admin.providers.confirm', $provider->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this provider?')">
                                                Confirm
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.providers.edit', $provider->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.providers.destroy', $provider->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this provider?')">
                                            Delete
                                        </button>
                                    </form>
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
