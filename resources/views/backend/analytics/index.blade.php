@extends('backend.layouts.master')
@section('title','SOTUMA || TABLEAU DE BORD ANALYTIQUE')
@section('main-content')
<div class="container-fluid">
    @include('backend.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('admin.dashboard') }} Analytique</h1>
        <div class="d-flex">
            <button onclick="initializeAnalytics()" class="btn btn-warning mr-2">
                <i class="fas fa-redo"></i> Réinitialiser les Analyses
            </button>
            <select id="chartPeriod" class="form-control mr-2">
                <option value="7days">7 Derniers Jours</option>
                <option value="30days">30 Derniers Jours</option>
                <option value="1year">Dernière Année</option>
                <option value="5years">5 Dernières Années</option>
                <option value="10years">10 Dernières Années</option>
            </select>
            <button onclick="refreshStats()" class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> Actualiser
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Today's Visitors -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Visites Aujourd'hui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="todayVisitors">{{ $today_visits }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unique Visitors Today -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Visiteurs Uniques Aujourd'hui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="uniqueVisitors">{{ $today_unique_visitors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Week -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Cette Semaine</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="weekVisitors">{{ $this_week_visitors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Ce Mois</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthVisitors">{{ $this_month_visitors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- All-Time Statistics Row -->
    <div class="row">
        <!-- All-Time Unique Visitors -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Visiteurs Uniques (Tous Temps)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="allTimeUnique">{{ $all_time_unique_visitors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All-Time Total Visits -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Total Visites (Tous Temps)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="allTimeTotal">{{ $all_time_total_visits }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Visitors Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aperçu des Visiteurs</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="visitorsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Device & Browser Stats -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques des Appareils</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="deviceChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @foreach($device_stats as $device)
                        <span class="mr-2">
                            <i class="fas fa-circle text-{{ $loop->index == 0 ? 'primary' : ($loop->index == 1 ? 'success' : 'info') }}"></i> {{ $device->device_type }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics -->
    <div class="row">
        <!-- Top Visited Pages -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pages les Plus Visitées</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th>Visites</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top_pages as $page)
                                <tr>
                                    <td>{{ $page->page_visited }}</td>
                                    <td>{{ $page->visit_count }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Browser Statistics -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques des Navigateurs</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="browserChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @foreach($browser_stats as $browser)
                        <span class="mr-2">
                            <i class="fas fa-circle text-{{ $loop->index == 0 ? 'primary' : ($loop->index == 1 ? 'success' : ($loop->index == 2 ? 'info' : 'warning')) }}"></i> {{ $browser->browser }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Visitors Chart
let visitorsChart;
let deviceChart;
let browserChart;

function initCharts() {
    // Visitors Chart
    const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
    visitorsChart = new Chart(visitorsCtx, {
        type: 'line',
        data: {
            labels: @json(array_column($last_7_days, 'date')),
            datasets: [{
                label: 'Visiteurs',
                data: @json(array_column($last_7_days, 'visitors')),
                borderColor: 'rgb(78, 115, 223)',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Device Chart
    const deviceCtx = document.getElementById('deviceChart').getContext('2d');
    deviceChart = new Chart(deviceCtx, {
        type: 'doughnut',
        data: {
            labels: @json($device_stats->pluck('device_type')),
            datasets: [{
                data: @json($device_stats->pluck('count')),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Browser Chart
    const browserCtx = document.getElementById('browserChart').getContext('2d');
    browserChart = new Chart(browserCtx, {
        type: 'doughnut',
        data: {
            labels: @json($browser_stats->pluck('browser')),
            datasets: [{
                data: @json($browser_stats->pluck('count')),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f4b619', '#e02e1c'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

// Reset analytics system
function initializeAnalytics() {
    if (confirm('⚠️ ATTENTION : Ceci va SUPPRIMER TOUTES les données analytiques existantes et recommencer à zéro. Cette action ne peut pas être annulée. Continuer ?')) {
        fetch('{{ route("admin.analytics.initialize") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ Système analytique réinitialisé avec succès ! Toutes les données ont été effacées. Les nouvelles visites seront suivies à partir de maintenant.');
                location.reload();
            } else {
                alert('❌ Erreur : ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Erreur lors de la réinitialisation du système analytique');
        });
    }
}

// Update chart data
function updateChartData(period) {
    fetch(`{{ route('admin.analytics.chart-data') }}?period=${period}`)
        .then(response => response.json())
        .then(data => {
            visitorsChart.data.labels = data.map(item => item.date);
            visitorsChart.data.datasets[0].data = data.map(item => item.visitors);
            visitorsChart.update();
        });
}

// Refresh statistics
function refreshStats() {
    fetch('{{ route('admin.analytics.stats') }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('todayVisitors').textContent = data.today.total;
            document.getElementById('uniqueVisitors').textContent = data.today.unique;
            document.getElementById('weekVisitors').textContent = data.week.total;
            document.getElementById('monthVisitors').textContent = data.month.total;
        });
}

// Event listeners
document.getElementById('chartPeriod').addEventListener('change', function() {
    updateChartData(this.value);
});

// Initialize charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
});
</script>
@endpush 