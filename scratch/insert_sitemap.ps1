$file = 'c:\Users\AM BUSINESS 99\Desktop\techwiz sameer\MarketLink_Documentation_With_Logo.doc'
$lines = Get-Content -Path $file -Encoding Unicode

# The site map section HTML to insert
# Insert after line 2159 (blank line after </ol> TOC, before Section 1 comment)
# So we insert after index 2158 (0-based) = after line 2159 (1-based)

$siteMapHtml = @'

<!-- ================= SITE MAP SECTION ================= -->

<div style='mso-element:para-border-div;border:none;border-bottom:solid #2E7D32 2.25pt;
padding:0in 0in 6.0pt 0in'>

<h1><span style='font-family:"Calibri",sans-serif;mso-fareast-font-family:"Times New Roman"'>Platform Site Map &amp; Role-Based Page Structure<o:p></o:p></span></h1>

</div>

<p><span style='font-size:11.5pt;font-family:"Calibri",sans-serif;color:#2D3748'>The following site map documents every page in the MarketLink platform, organized by which user role can access it. The platform uses strict Role-Based Access Control (RBAC) so that customers, farmers, and administrators each see only their dedicated portal pages.<o:p></o:p></span></p>

<!-- PUBLIC / GUEST PAGES -->

<h2><span style='font-family:"Calibri",sans-serif;color:#1B5E20'>A. Public Pages (No Login Required)<o:p></o:p></span></h2>

<p><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:#2D3748'>These pages are accessible to any visitor without an account.<o:p></o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #CBD5E0 .75pt;
 mso-yfti-tbllook:1184'>
 <tr style='background:#2E7D32'>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page / URL</span></strong></p></td>
  <td width="30%" valign=top style='width:30%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page Name</span></strong></p></td>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Description</span></strong></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Home Page</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Hero section with market search, featured farmers markets, seasonal produce showcase, farmer cards, how-it-works guide, and CTA for grower registration</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/markets</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Markets Directory</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Browse all active weekend farmers markets by city, with operating hours and attending grower count</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/markets/{id}</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Single Market Detail</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Single market page with stall list, address, operating schedule, and Leaflet map location pin</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmers</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Farmers Directory</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Browse all verified organic growers with farm profiles, certifications, and produce categories</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmers/{id}</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Farmer Stall Profile</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Individual farmer public profile, farm story, available produce, customer reviews, and weekend market schedule</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/products</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Produce Catalog</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Full seasonal product listing with stock status, price per unit, category filters, and farm attribution</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/products/{id}</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Product Detail Page</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Single produce item with full description, stock count, unit price, grower info, and Add to Basket button</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/map</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Interactive Market Map</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Leaflet.js / OpenStreetMap interactive map with dynamic GPS pins for all registered market venues</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/about</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>About &amp; User Guide</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Mission statement, step-by-step ordering guide, portal role explanations, FAQ accordion, and team member cards</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/contact</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Contact Page</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Contact form, email support, phone number, and market information desk address</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/login</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Login Page</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Email and password login form — works for customer, farmer, and admin accounts. Auto-redirects each role to their dedicated dashboard</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/register/customer</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Customer Registration</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>New customer signup — name, email, phone, password</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E8F5E9;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/register/farmer</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Farmer Registration</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>New farmer/vendor signup with farm name, city, produce specialty, address, and organic certification details. Account requires admin approval before going live</span></p></td>
 </tr>
</table>

<p><o:p>&nbsp;</o:p></p>

<!-- CUSTOMER PORTAL PAGES -->

<h2><span style='font-family:"Calibri",sans-serif;color:#1565C0'>B. Customer Portal Pages (/customer/...) — Requires Login as Customer<o:p></o:p></span></h2>

<p><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:#2D3748'>Accessible only after logging in with a customer account (role = customer).<o:p></o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #CBD5E0 .75pt;
 mso-yfti-tbllook:1184'>
 <tr style='background:#1565C0'>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page / URL</span></strong></p></td>
  <td width="30%" valign=top style='width:30%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page Name</span></strong></p></td>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>What the Customer Can Do</span></strong></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/dashboard</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Customer Dashboard</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Overview stats (total pre-orders, active orders, completed collections, saved favorite farms), recent order table, and marketplace quick-action buttons</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/cart</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Pickup Basket</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View and manage items from multiple farmers, update quantities, remove items, clear cart, and proceed to checkout</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/checkout</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Pre-Order Checkout</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Select pickup time slots per farmer group, review order summary, add notes, confirm reservation (no payment taken online)</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/orders</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>My Pre-Orders List</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View all placed pre-orders with status, farmer name, pickup date, and market location. Filter by status (placed, accepted, ready, completed, cancelled)</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/orders/{id}</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Order Detail Page</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Full order summary with item list, pickup code/number, cancellation option, order timeline, and link to leave a review after collection</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/favorites</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Saved Favorites</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View and manage bookmarked farmers and saved produce items for quick re-ordering each week</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/reviews</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>My Reviews</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View submitted ratings and feedback for completed orders, and read farmer responses</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/orders/{id}/review</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Submit Review Form</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Rate order (1-5 stars), write comments about produce quality, and submit verified review for completed order</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/notifications</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Notifications Center</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Real-time order status update alerts (accepted, ready for pickup, completed). One-click mark as read, mark all as read</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#E3F2FD;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/customer/profile</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Account Profile</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Update personal name, phone, pickup address, profile photo, and change password</span></p></td>
 </tr>
</table>

<p><o:p>&nbsp;</o:p></p>

<!-- FARMER/VENDOR PORTAL PAGES -->

<h2><span style='font-family:"Calibri",sans-serif;color:#E65100'>C. Farmer / Vendor Portal Pages (/farmer/...) — Requires Login as Farmer<o:p></o:p></span></h2>

<p><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:#2D3748'>Accessible only after logging in with an approved farmer account (role = farmer). Farmer accounts require admin approval before product listing and pickup slot creation are unlocked.<o:p></o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #CBD5E0 .75pt;
 mso-yfti-tbllook:1184'>
 <tr style='background:#E65100'>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page / URL</span></strong></p></td>
  <td width="30%" valign=top style='width:30%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page Name</span></strong></p></td>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>What the Farmer Can Do</span></strong></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/dashboard</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Vendor Dashboard</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Live stats (total revenue, pending orders, active produce count, stall rating), recent pre-orders table, low-stock alerts, and quick action buttons</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/products</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Manage Produce Inventory</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Full list of listed produce items with search and category/status filters. Toggle availability on/off instantly</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/products/create</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Add New Produce Item</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Form to add a new harvest item with name, price, unit (kg/bunch/litre/jar/pot), stock quantity, category, description, and photo upload</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/products/{id}/edit</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Edit Produce Item</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Update stock, price, description, and photo for an existing item. Mark as out-of-season to hide from catalog</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/orders</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Pre-Orders Queue</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View all incoming customer pre-orders with customer name, ordered items, pickup date, market location, and current status</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/orders/{id}</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Single Order Detail</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View order items, quantities, customer notes, and advance through status lifecycle: Accept &rarr; Ready for Pickup &rarr; Complete</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/pickup-slots</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Market Pickup Slots</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View all scheduled pickup windows per market, see current booking count vs. capacity, and delete upcoming slots</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/pickup-slots/create</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Create Pickup Slot</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Schedule a new market attendance window — select market, set date, start/end time, order capacity, and cutoff deadline</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/stock-templates</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Stock Templates</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Create reusable weekly stock bundles to quickly update inventory levels each market weekend without re-entering all data</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/reviews</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Customer Reviews</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View ratings and written feedback from customers. Write and publish public reply responses directly on the stall review page</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/insights</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Sales &amp; Analytics Insights</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Chart.js monthly revenue breakdown and order trend graphs. Top-selling produce ranking and total earnings summary</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFF3E0;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/farmer/profile</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Farm Profile &amp; Stall Bio</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Edit farm name, bio description, physical address, city/region, GPS coordinates, contact phone, organic certification details, and profile photo</span></p></td>
 </tr>
</table>

<p><o:p>&nbsp;</o:p></p>

<!-- ADMIN PORTAL PAGES -->

<h2><span style='font-family:"Calibri",sans-serif;color:#B71C1C'>D. Administrator Portal Pages (/admin/...) — Requires Login as Admin<o:p></o:p></span></h2>

<p><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:#2D3748'>Accessible only after logging in with the administrator account (role = admin).<o:p></o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #CBD5E0 .75pt;
 mso-yfti-tbllook:1184'>
 <tr style='background:#B71C1C'>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page / URL</span></strong></p></td>
  <td width="30%" valign=top style='width:30%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Page Name</span></strong></p></td>
  <td width="35%" valign=top style='width:35%;border:solid #CBD5E0 .75pt;padding:8.0pt 10.0pt'><p><strong><span style='font-size:10.5pt;font-family:"Calibri",sans-serif;color:white'>Admin Actions Available</span></strong></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/dashboard</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Admin HQ Dashboard</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform-wide KPIs: total registered users, pending farmer approvals, total revenue, active orders, top-selling products, and recent activity feed</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/farmers</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Farmers Management</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>View all registered farmers, filter by approval status, search by name/city. Approve, suspend, or reactivate grower accounts</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/farmers/pending</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Pending Approvals</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Queue of new farmer registrations awaiting verification. Review farm details, certifications, and approve or reject with one click</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/farmers/{id}</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Farmer Detail View</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Full farmer profile, listed products, order history, average rating, and admin action buttons (approve/suspend/activate)</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/customers</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Customer Accounts</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Browse all registered shoppers, view their order count, toggle account status (active/inactive)</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/markets</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Markets Management</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Create, edit, and deactivate farmers market venues. Set address, GPS coordinates, operating days, and opening/closing hours</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/categories</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Produce Categories</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Add, edit, or deactivate produce taxonomy categories (Vegetables, Fruits, Dairy, Honey, Herbs, Flowers, etc.)</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/products</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform Products</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform-wide produce inventory oversight with search, category filter, and stock status monitoring across all farmers</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/orders</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>All Orders Audit</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform-wide order history with order number, customer, farmer, market, amount, date, and current status across all roles</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/reviews</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Review Moderation</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Browse all customer reviews and farmer replies. Delete inappropriate content, monitor overall platform ratings</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/announcements</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Announcements</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Create and publish platform announcements for customers (weather alerts, seasonal produce notices, festival market dates)</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/reports</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform Analytics &amp; Reports</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Exportable platform reports including monthly revenue by farmer, top produce categories, order volume trends, and customer retention metrics</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/users</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform Users</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Manage all registered accounts across all roles (admin, farmer, customer). Toggle account status and view full user profiles</span></p></td>
 </tr>
 <tr>
  <td valign=top style='border:solid #CBD5E0 .75pt;background:#FFEBEE;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>/admin/settings</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform Settings</span></p></td>
  <td valign=top style='border:solid #CBD5E0 .75pt;padding:6.0pt 10.0pt'><p><span style='font-size:10.0pt;font-family:"Calibri",sans-serif;color:#2D3748'>Platform-level configuration settings for branding, maintenance mode, and operational preferences</span></p></td>
 </tr>
</table>

<p><o:p>&nbsp;</o:p></p>
'@

# Insert at position 2159 (0-based index) in the array
# 0-based: line 2159 (1-based) = index 2158 in 0-based array
$insertIndex = 2158

$newLines = $lines[0..$insertIndex] + $siteMapHtml.Split("`n") + $lines[($insertIndex+1)..($lines.Count-1)]

# Write back to file
$newLines | Set-Content -Path $file -Encoding Unicode

Write-Output ("Done! File now has " + $newLines.Count + " lines (was " + $lines.Count + ")")
