@extends('layouts.dashboard')

@section('title', 'Moderate Reviews | MarketLink Admin')
@section('page_title', 'Customer Review Moderation')
@section('page_subtitle', $reviews->total() . ' product & farm reviews submitted by shoppers')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-speedometer2 me-1"></i> Dashboard
  </a>
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Platform Reviews Feed</h5>
        <span class="small text-muted">Approve, flag, or moderate community reviews</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-star me-1"></i> {{ $reviews->total() }} Reviews
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Farmer / Produce</th>
            <th>Rating</th>
            <th>Review Comments</th>
            <th>Status</th>
            <th class="text-end">Moderation</th>
          </tr>
        </thead>
        <tbody>
          @forelse($reviews as $r)
            <tr>
              <td><strong class="text-forest">{{ $r->customer->name }}</strong></td>
              <td>{{ $r->farmer->name ?? 'Producer' }}</td>
              <td>
                <div class="text-gold d-inline-flex gap-1">
                  @for($i=1; $i<=5; $i++)
                    <i class="bi bi-star{{ $i <= $r->rating ? '-fill' : '' }}"></i>
                  @endfor
                </div>
              </td>
              <td>
                <span class="small">{{ Str::limit($r->comment, 90) }}</span>
                <span class="text-muted d-block small mt-1">{{ $r->created_at->format('M d, Y') }}</span>
              </td>
              <td>
                <span class="badge-status {{ $r->status === 'approved' ? 'ready' : ($r->status === 'pending' ? 'pending' : 'cancelled') }}">
                  <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                  {{ ucfirst($r->status) }}
                </span>
              </td>
              <td class="text-end">
                <div class="d-flex gap-1 justify-content-end">
                  @if($r->status !== 'approved')
                    <form method="POST" action="{{ route('admin.reviews.approve', $r) }}">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-forest rounded-pill px-3" title="Approve Review">
                        <i class="bi bi-check-lg me-1"></i> Approve
                      </button>
                    </form>
                  @endif
                  @if($r->status !== 'rejected')
                    <form method="POST" action="{{ route('admin.reviews.reject', $r) }}">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-outline-warning rounded-pill px-2" title="Reject Review">
                        Reject
                      </button>
                    </form>
                  @endif
                  <form method="POST" action="{{ route('admin.reviews.destroy', $r) }}" onsubmit="return confirm('Permanently remove review?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-star fs-2 text-muted mb-2 d-block"></i>
                No shopper reviews submitted yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($reviews->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $reviews->links() }}
      </div>
    @endif
  </div>

@endsection
