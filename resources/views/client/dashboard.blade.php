@extends('layouts.app')
@section('title', 'Client | My Dashboard')

@section('content')
<div class="row row-cols-md-3 row-cols-1 gy-4">
    <!-- Active Subscriptions -->


    <!-- Complaints Summary -->
    <div class="col">
        <div class="card shadow-sm border bg-light h-100">
            <div class="card-body">
                <h6 class="fw-bold text-primary">My Complaints Summary</h6>
                <p class="mb-1">Pending: <strong>{{ $pendingCount }}</strong></p>
                <p class="mb-1">Resolved: <strong>{{ $resolvedCount }}</strong></p>
                <p class="mb-0">Total Complaints: <strong>{{ $totalComplaints }}</strong></p>
            </div>
        </div>
    </div>

    
</div>

{{-- Optional Chart --}}
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title">Complaints by Category</h5>
    </div>
    <div class="card-body">
        <canvas id="complaintChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('complaintChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($complaintChartData)) !!},
            datasets: [{
                label: 'Complaints',
                data: {!! json_encode(array_values($complaintChartData)) !!},
                backgroundColor: '#3498db'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
