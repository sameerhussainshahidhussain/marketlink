/**
 * MarketLink - Interactive Map Engine
 * Uses Leaflet.js (OpenStreetMap) with custom organic markers
 */

document.addEventListener('DOMContentLoaded', () => {
  initMarketLinkMap();
});

function initMarketLinkMap() {
  const mapElement = document.getElementById('marketLinkMap');
  if (!mapElement || typeof L === 'undefined') return;

  // Initialize Map centered around markets (e.g. green valley area 37.7749, -122.4194 default or similar)
  const map = L.map('marketLinkMap').setView([37.7749, -122.4194], 12);

  // Clean OpenStreetMap tiles
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors | MarketLink eGreen Basket',
    maxZoom: 18
  }).addTo(map);

  // Custom Green Marker Icon
  const greenIcon = L.divIcon({
    className: 'custom-map-marker',
    html: `<div style="background-color:#14351d; color:#ffffff; width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:3px solid #fff; box-shadow:0 4px 10px rgba(0,0,0,0.3); font-size:18px;">🌿</div>`,
    iconSize: [36, 36],
    iconAnchor: [18, 18],
    popupAnchor: [0, -18]
  });

  const locations = [
    {
      id: 'm1',
      name: 'Valley Green Community Market',
      lat: 37.7749,
      lng: -122.4194,
      address: '142 Orchard Way, Green Valley',
      day: 'Sat & Sun (8 AM - 2 PM)',
      farmers: '24 Verified Stalls',
      image: 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=300&auto=format&fit=crop&q=80'
    },
    {
      id: 'm2',
      name: 'Riverfront Organic Farmers Bazaar',
      lat: 37.7900,
      lng: -122.4000,
      address: '88 Waterfront Esplanade, Riverside',
      day: 'Wed & Sat (7:30 AM - 1 PM)',
      farmers: '32 Verified Stalls',
      image: 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=300&auto=format&fit=crop&q=80'
    },
    {
      id: 'm3',
      name: 'Highland Heritage Producers Fair',
      lat: 37.7550,
      lng: -122.4400,
      address: '500 Hilltop Ridge Rd, Highland Peak',
      day: 'Sun Morning (9 AM - 3 PM)',
      farmers: '18 Verified Stalls',
      image: 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=300&auto=format&fit=crop&q=80'
    },
    {
      id: 'm4',
      name: 'Sunnybrook Artisan Market',
      lat: 37.7600,
      lng: -122.3900,
      address: '210 Meadowlane Plaza, Sunnybrook',
      day: 'Fri Afternoon (2 PM - 7 PM)',
      farmers: '28 Verified Stalls',
      image: 'https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=300&auto=format&fit=crop&q=80'
    }
  ];

  locations.forEach(loc => {
    const marker = L.marker([loc.lat, loc.lng], { icon: greenIcon }).addTo(map);

    const popupContent = `
      <div style="max-width:240px; font-family:var(--font-body, sans-serif);">
        <img src="${loc.image}" style="width:100%; height:110px; object-fit:cover; border-radius:8px; margin-bottom:8px;">
        <h6 style="margin:0 0 4px; font-weight:700; color:#14351d; font-size:14px;">${loc.name}</h6>
        <p style="margin:0 0 6px; font-size:12px; color:#666;"><i class="bi bi-geo-alt me-1"></i>${loc.address}</p>
        <div style="font-size:11px; font-weight:600; color:#245e3f; margin-bottom:8px;">
          <i class="bi bi-clock me-1"></i>${loc.day}
        </div>
        <div style="display:flex; gap:6px;">
          <a href="market-details.html?id=${loc.id}" style="display:inline-block; padding:4px 10px; background:#14351d; color:#fff; border-radius:20px; font-size:11px; text-decoration:none; font-weight:600;">View Market</a>
          <a href="https://maps.google.com/?q=${loc.lat},${loc.lng}" target="_blank" style="display:inline-block; padding:4px 10px; background:#e8f5ed; color:#14351d; border-radius:20px; font-size:11px; text-decoration:none; font-weight:600;">Directions</a>
        </div>
      </div>
    `;

    marker.bindPopup(popupContent);
  });

  // Focus marker when clicking sidebar item
  document.querySelectorAll('.market-sidebar-item').forEach(item => {
    item.addEventListener('click', () => {
      const lat = parseFloat(item.getAttribute('data-lat'));
      const lng = parseFloat(item.getAttribute('data-lng'));
      if (lat && lng) {
        map.flyTo([lat, lng], 14, { animate: true, duration: 1.2 });
      }
    });
  });
}
