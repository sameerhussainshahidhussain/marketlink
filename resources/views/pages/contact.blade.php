@extends('layouts.app')

@section('title', 'Contact Us | MarketLink – eGreen Basket')
@section('meta_description', 'Get in touch with MarketLink market coordinators, submit vendor questions, or visit our central pavilion.')

@section('content')
  
  <section class="py-5 bg-sage-subtle border-bottom border-subtle">
    <div class="container text-center py-4">
      <span class="badge bg-forest text-gold rounded-pill px-3 py-2 mb-3">
        <i class="bi bi-chat-heart me-1"></i> We're Here For You
      </span>
      <h1 class="display-5 font-serif text-forest mb-2">Contact MarketLink</h1>
      <p class="text-muted lead max-w-700 mx-auto">
        Have questions about attending our farmers markets, vendor onboarding, or pickup logistics? Connect with our dedicated coordination team.
      </p>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4 mb-5">
        
        <div class="col-lg-5 d-flex flex-column gap-3">
          <div class="card p-4 rounded-24 border-subtle bg-white shadow-xs">
            <div class="d-flex align-items-center gap-3">
              <div class="rounded-circle bg-forest-subtle p-3 text-forest fs-4">
                <i class="bi bi-envelope-heart-fill"></i>
              </div>
              <div>
                <h6 class="mb-1 text-forest fw-bold">Email Support</h6>
                <p class="small text-muted mb-0">support@marketlink.pk</p>
              </div>
            </div>
          </div>

          <div class="card p-4 rounded-24 border-subtle bg-white shadow-xs">
            <div class="d-flex align-items-center gap-3">
              <div class="rounded-circle bg-gold-subtle p-3 text-gold fs-4">
                <i class="bi bi-telephone-fill"></i>
              </div>
              <div>
                <h6 class="mb-1 text-forest fw-bold">Phone & WhatsApp Help</h6>
                <p class="small text-muted mb-0">0300-1234567 (Mon – Sat, 8:00 AM – 6:00 PM)</p>
              </div>
            </div>
          </div>

          <div class="card p-4 rounded-24 border-subtle bg-white shadow-xs">
            <div class="d-flex align-items-center gap-3">
              <div class="rounded-circle bg-sage p-3 text-forest fs-4">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <div>
                <h6 class="mb-1 text-forest fw-bold">Market Information Desk</h6>
                <p class="small text-muted mb-0">Liberty Market, Gulberg III, Lahore</p>
              </div>
            </div>
          </div>

          <div class="p-4 bg-sage rounded-24 border-subtle text-forest mt-2">
            <h6 class="font-serif fw-bold mb-2"><i class="bi bi-patch-check-fill text-forest me-1"></i> Are you a local grower?</h6>
            <p class="small mb-3">Learn how easy it is to list your weekly harvest, manage customer pre-orders, and welcome local neighbors at your stall.</p>
            <a href="{{ route('register.farmer') }}" class="btn btn-sm btn-forest rounded-pill px-4">Register As A Farmer</a>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="card p-4 p-md-5 rounded-32 border-subtle shadow-md bg-white h-100">
            <h4 class="font-serif text-forest mb-2">Send Us a Direct Message</h4>
            <p class="small text-muted mb-4">Please fill in the inquiry form below. We typically respond within 24 business hours.</p>

            <form onsubmit="event.preventDefault(); alert('Thank you! Your message has been sent to our coordinating team.'); this.reset();">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-forest">Full Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control rounded-12" placeholder="e.g. Ayesha Tariq" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-forest">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control rounded-12" placeholder="ayesha@example.com" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-forest">Inquiry Topic <span class="text-danger">*</span></label>
                <select class="form-select rounded-12" required>
                  <option value="">Choose a topic...</option>
                  <option>Customer Pre-Order Inquiry</option>
                  <option>Farmer / Vendor Stall Registration</option>
                  <option>New Market Location Suggestion</option>
                  <option>Pay-at-Pickup Questions</option>
                  <option>Technical / General Feedback</option>
                </select>
              </div>

              <div class="mb-4">
                <label class="form-label small fw-bold text-forest">Your Message <span class="text-danger">*</span></label>
                <textarea class="form-control rounded-12" rows="4" placeholder="How can we assist you with local market shopping or stall coordination?" required></textarea>
              </div>

              <button type="submit" class="btn btn-forest rounded-pill py-3 px-5 fw-bold shadow-xs">
                <i class="bi bi-send-fill me-2"></i> Submit Inquiry
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="card rounded-32 border-subtle shadow-xs bg-white overflow-hidden p-3 p-md-4">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
          <div>
            <h5 class="font-serif text-forest mb-0 fw-bold">
              <i class="bi bi-map-fill text-gold me-2"></i> Central Market Headquarters & Pavilion Location
            </h5>
            <small class="text-muted">Liberty Market Pavilion, Gulberg III, Lahore, Pakistan</small>
          </div>
          <a href="{{ route('map') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
            <i class="bi bi-geo-alt me-1"></i> View All Farmers Markets on Interactive Map
          </a>
        </div>
        <div class="rounded-24 overflow-hidden shadow-xs border" style="height: 380px;">
          <iframe 
            title="MarketLink Coordinating Center Location"
            width="100%" 
            height="100%" 
            frameborder="0" 
            scrolling="no" 
            marginheight="0" 
            marginwidth="0" 
            src="https://www.openstreetmap.org/export/embed.html?bbox=74.3400%2C31.5100%2C74.3750%2C31.5300&amp;layer=mapnik&amp;marker=31.5204%2C74.3587" 
            style="border: 0;">
          </iframe>
        </div>
      </div>
    </div>
  </section>
@endsection
