@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Stats Row 1: Main Counts --}}
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Total Properties</div>
                        <div class="stat-value">{{ $stats['total_properties'] }}</div>
                        <small class="text-muted">
                            <span style="color: #166534;">{{ $stats['occupied_properties'] }} occupied</span> ·
                            <span style="color: #92400e;">{{ $stats['vacant_properties'] }} vacant</span>
                        </small>
                    </div>
                    <div class="stat-icon" style="background: #eef2ff; color: #4f46e5;">
                        <i class="bi bi-houses"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Active Tenants</div>
                        <div class="stat-value">{{ $stats['active_tenants'] }}</div>
                        <small class="text-muted">{{ $stats['total_tenants'] }} total registered</small>
                    </div>
                    <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Rent Collected</div>
                        <div class="stat-value">Rs. {{ number_format($stats['total_rent_collected']) }}</div>
                        <small class="text-muted">{{ $stats['rent_receipts'] }} receipts total</small>
                    </div>
                    <div class="stat-icon" style="background: #DCFCE7; color: #16A34A;">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Security Deposits Held</div>
                        <div class="stat-value">Rs. {{ number_format($stats['security_held']) }}</div>
                        <small class="text-muted">{{ $stats['total_owners'] }} owners registered</small>
                    </div>
                    <div class="stat-icon" style="background: #fee2e2; color: #991b1b;">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Stats Row 2: Bill Collections --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">This Month's Rent</div>
                        <div class="stat-value" style="color: #16A34A;">Rs. {{ number_format($stats['rent_this_month']) }}</div>
                        <small class="text-muted">{{ now()->format('F Y') }}</small>
                    </div>
                    <div class="stat-icon" style="background: #eef2ff; color: #4f46e5;">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Total Maintenance Collected</div>
                        <div class="stat-value" style="color: #eab308;">Rs. {{ number_format($stats['total_maintenance']) }}</div>
                        <small class="text-muted">{{ $stats['maintenance_receipts'] }} receipts</small>
                    </div>
                    <div class="stat-icon" style="background: #fefce8; color: #92400e;">
                        <i class="bi bi-tools"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Total Electricity Collected</div>
                        <div class="stat-value" style="color: #ef4444;">Rs. {{ number_format($stats['total_electricity']) }}</div>
                        <small class="text-muted">{{ $stats['electricity_receipts'] }} receipts</small>
                    </div>
                    <div class="stat-icon" style="background: #fee2e2; color: #991b1b;">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Receipts + Quick Actions --}}
<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2"></i>Recent Receipts</span>
                <span class="badge badge-info">Last 10</span>
            </div>
            <div class="card-body p-0">
                @if($recentReceipts->count() > 0)
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Month</th>
                            <th>Tenant</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentReceipts as $receipt)
                        <tr>
                            <td>
                                <i class="bi {{ $receipt['icon'] }} me-1" style="color: {{ $receipt['color'] }};"></i>
                                {{ $receipt['type'] }}
                            </td>
                            <td>{{ $receipt['month'] }}</td>
                            <td>{{ $receipt['tenant'] }}</td>
                            <td><strong>Rs. {{ number_format($receipt['amount']) }}</strong></td>
                            <td>{{ $receipt['date']->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ $receipt['url'] }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-receipt" style="font-size: 3rem; opacity: .3;"></i>
                    <p class="mt-2">No receipts generated yet.<br>Start by adding owners, tenants and properties.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        {{-- Quick Actions --}}
        <div class="card mb-4">
            <div class="card-header"><i class="bi bi-lightning me-2"></i>Quick Actions</div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('rent-receipts.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-plus-circle me-2"></i>New Rent Receipt
                </a>
                <a href="{{ route('maintenance-receipts.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-plus-circle me-2"></i>New Maintenance Bill
                </a>
                <a href="{{ route('electricity-receipts.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-plus-circle me-2"></i>New Electricity Bill
                </a>
                <hr class="my-1">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('owners.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-person-plus me-2"></i>Add Owner
                </a>
                <a href="{{ route('tenants.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-person-plus me-2"></i>Add Tenant
                </a>
                <a href="{{ route('properties.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-house-add me-2"></i>Add Property
                </a>
                @endif
                <a href="{{ route('security-deposits.create') }}" class="btn btn-outline-primary text-start">
                    <i class="bi bi-shield-plus me-2"></i>Record Security Deposit
                </a>
            </div>
        </div>

        {{-- Properties Overview --}}
        <div class="card">
            <div class="card-header"><i class="bi bi-houses me-2"></i>Properties</div>
            <div class="card-body p-0">
                @php
                $properties = \App\Models\Property::with(['owner', 'tenant'])->get();
                @endphp
                @forelse($properties as $property)
                <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center" style="font-size: .85rem;">
                    <div>
                        <strong>{{ Str::limit($property->address, 25) }}</strong>
                        <br>
                        <small class="text-muted">
                            {{ $property->tenant->name ?? 'Vacant' }} · Rs. {{ number_format($property->monthly_rent) }}
                        </small>
                    </div>
                    @if($property->status === 'occupied')
                    <span class="badge badge-success">Occupied</span>
                    @else
                    <span class="badge badge-warning">Vacant</span>
                    @endif
                </div>
                @empty
                <div class="text-center py-3 text-muted small">
                    No properties yet.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
