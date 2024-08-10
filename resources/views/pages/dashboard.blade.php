@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if (Auth::user()->roleId == 4)
        @include('components.userDashboard')
    @else
        @include('components.adminDashboard')
    @endif
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('myChart');
        const santri = document.getElementById('santriStat');

        const data = {
            labels: @json($chartData['labels']),
            datasets: [{
                    label: 'Sekolah',
                    data: @json($chartData['sekolah']),
                    borderColor: '#36A2EB',
                    backgroundColor: '#9BD0F5',
                },
                {
                    label: 'Madin',
                    data: @json($chartData['madin']),
                    borderColor: '#FF6384',
                    backgroundColor: '#FFB1C1',
                },
                {
                    label: 'Mandiri',
                    data: @json($chartData['mandiri']),
                    borderColor: '#FFCE56',
                    backgroundColor: '#FFDAA4',
                }
            ]
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(santri, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
