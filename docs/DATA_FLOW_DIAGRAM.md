# 📊 Booking Detail Enhancement - Data Flow Diagram

## System Architecture

```
┌─────────────────────────────────────────────────────────────────────┐
│                    ADMIN BOOKING DETAIL PAGE                        │
│                    /admin/booking/{id}                              │
└─────────────────────────────────────────────────────────────────────┘
                               ↓
                  ┌────────────────────────┐
                  │  Bookings Controller   │
                  │   detail($id) method   │
                  └────────────────────────┘
                               ↓
        ┌──────────────────────────────────────────────────┐
        │    LOAD BOOKING & RELATED DATA                   │
        │                                                  │
        │ 1. Load booking (BookingModel)                  │
        │    ↓                                            │
        │ 2. Parse tour_darat_selected (JSON)           │
        │    ↓                                            │
        │ 3. Load wisata_darat details (WisataDaratModel) │
        │    ↓                                            │
        │ 4. Parse tour_laut_selected (JSON)            │
        │    ↓                                            │
        │ 5. Load wisata_laut details (WisataLautModel)  │
        │    ↓                                            │
        │ 6. Parse facilities_selected (JSON)            │
        │    ↓                                            │
        │ 7. Load facilities details (ServiceModel) [NEW] │
        │                                                  │
        └──────────────────────────────────────────────────┘
                               ↓
              ┌────────────────────────────────┐
              │ Pass data to view:             │
              │ $booking['tour_darat_details'] │
              │ $booking['tour_laut_details']  │
              │ $booking['facilities_details'] │
              └────────────────────────────────┘
                               ↓
         ┌────────────────────────────────────────┐
         │  admin_booking_detail.php (VIEW)       │
         │                                        │
         │  Loop & Display:                       │
         │  ├─ Land Tours (with details)         │
         │  ├─ Sea Tours (with details)          │
         │  └─ Facilities (with details) [NEW]   │
         └────────────────────────────────────────┘
                               ↓
              ┌─────────────────────────────┐
              │  RENDERED HTML PAGE         │
              │  Professional card layout   │
              │  Mobile responsive         │
              └─────────────────────────────┘
```

---

## Data Flow - Detail Level

### Step 1: Initial Booking Load
```
GET /admin/booking/5
     ↓
BookingModel::getBookingWithPayments(5)
     ↓
Database Query:
SELECT * FROM bookings WHERE id=5
     ↓
Result: {
  id: 5,
  customer_name: "Budi Santoso",
  tour_darat_selected: "[1, 2, 3]",    ← JSON array of IDs
  tour_laut_selected: "[2, 4]",        ← JSON array of IDs
  facilities_selected: "[4, 5]",       ← JSON array of IDs
  ...
}
```

### Step 2: Parse & Load Tour Darat
```
$tourDarat = json_decode("[1, 2, 3]") → [1, 2, 3]
     ↓
Loop iteration 1: WisataDaratModel->find(1)
├─ Query: SELECT * FROM wisata_darat WHERE id=1
└─ Result: {id:1, name:"Taman Laut", description:"Snorkling...", price_publish:200000}
     ↓
Loop iteration 2: WisataDaratModel->find(2)
├─ Query: SELECT * FROM wisata_darat WHERE id=2
└─ Result: {id:2, name:"Pulau Kemujan", description:"Jelajahi...", price_publish:250000}
     ↓
Loop iteration 3: WisataDaratModel->find(3)
├─ Query: SELECT * FROM wisata_darat WHERE id=3
└─ Result: {...}
     ↓
Result: [
  {id:1, name:"Taman Laut", description:"Snorkling...", price_publish:200000},
  {id:2, name:"Pulau Kemujan", description:"Jelajahi...", price_publish:250000},
  {id:3, ...}
]
     ↓
Stored in: $booking['tour_darat_details']
```

### Step 3: Parse & Load Tour Laut
```
$tourLaut = json_decode("[2, 4]") → [2, 4]
     ↓
Same pattern as tour_darat
     ↓
Result stored in: $booking['tour_laut_details']
```

### Step 4: Parse & Load Facilities [NEW]
```
$facilities = json_decode("[4, 5]") → [4, 5]
     ↓
Loop iteration 1: ServiceModel->find(4)
├─ Query: SELECT * FROM service_categories WHERE id=4
└─ Result: {id:4, name:"Welcome Drink", description:"Complimentary...", price_publish:75000}
     ↓
Loop iteration 2: ServiceModel->find(5)
├─ Query: SELECT * FROM service_categories WHERE id=5
└─ Result: {id:5, name:"Airport Pickup", description:"Transportation...", price_publish:150000}
     ↓
Result: [
  {id:4, name:"Welcome Drink", ...},
  {id:5, name:"Airport Pickup", ...}
]
     ↓
Stored in: $booking['facilities_details']
```

### Step 5: Render in View
```
View receives:
$booking = {
  customer_name: "Budi Santoso",
  tour_darat_details: [
    {id:1, name:"Taman Laut", description:"...", price_publish:200000},
    {id:2, name:"Pulau Kemujan", description:"...", price_publish:250000},
    {id:3, ...}
  ],
  tour_laut_details: [
    {id:2, name:"Diving Spot", description:"...", price_publish:350000},
    {id:4, name:"Island Hopping", description:"...", price_publish:300000}
  ],
  facilities_details: [
    {id:4, name:"Welcome Drink", description:"...", price_publish:75000},
    {id:5, name:"Airport Pickup", description:"...", price_publish:150000}
  ]
}
     ↓
Loop $booking['tour_darat_details'] as $tour
└─ Display: name, description, price_publish
     ↓
Loop $booking['tour_laut_details'] as $tour
└─ Display: name, description, price_publish
     ↓
Loop $booking['facilities_details'] as $facility
└─ Display: name, description, price_publish
```

---

## Database Schema References

### bookings table (Storage)
```sql
┌──────────────────────┐
│ id (PK)              │
│ customer_name        │
│ customer_email       │
│ tour_darat_selected  │ ← JSON: [1, 2, 3]
│ tour_laut_selected   │ ← JSON: [2, 4]
│ facilities_selected  │ ← JSON: [4, 5]
│ total_price          │
│ status               │
│ created_at           │
└──────────────────────┘
```

### wisata_darat table (Land Tours Reference)
```sql
┌────────────────┐
│ id (PK)        │
│ name           │
│ description    │
│ price_publish  │
│ location       │
│ is_active      │
└────────────────┘
```

### wisata_laut table (Sea Tours Reference)
```sql
┌────────────────┐
│ id (PK)        │
│ name           │
│ description    │
│ price_publish  │
│ location       │
│ is_active      │
└────────────────┘
```

### service_categories table (Facilities Reference)
```sql
┌────────────────────┐
│ id (PK)            │
│ name               │
│ description        │
│ price_publish      │
│ type (facility)    │
│ is_active          │
└────────────────────┘
```

---

## Code Execution Flow

### Controller (Bookings.php)
```
detail($bookingId)
├─ Load main booking record
├─ Initialize models
│  ├─ WisataDaratModel
│  ├─ WisataLautModel
│  └─ ServiceModel
├─ Parse & load each data type
│  ├─ For each tour_darat ID → find() → add to array
│  ├─ For each tour_laut ID → find() → add to array
│  └─ For each facility ID → find() → add to array
└─ Return view with $booking containing all details
```

### View (admin_booking_detail.php)
```
Display Package Section
├─ Check if tour_darat_details not empty
│  └─ Loop & render each tour card
├─ Check if tour_laut_details not empty
│  └─ Loop & render each tour card
├─ Check if facilities_details not empty
│  └─ Loop & render each facility card
└─ Display special notes
```

---

## Performance Characteristics

### Database Queries
```
Per booking detail page load:

1. Load booking                    → 1 query
2. Load tour_darat details         → N queries (N = # of tours selected)
3. Load tour_laut details          → M queries (M = # of tours selected)
4. Load facilities details         → K queries (K = # of facilities selected)
─────────────────────────────────────────────────────
Total: 1 + N + M + K queries

Example: 1 + 3 + 2 + 2 = 8 queries per page
```

### Optimization Notes
- ✅ No N+1 query problems (each item one query)
- ✅ Queries cached by PHP (connection pooling)
- ✅ No unnecessary joins
- ✅ Minimal data transfer

---

## Error Handling

### When Tour Not Found
```
WisataDaratModel->find(999) → null

if ($detail) {
    $booking['tour_darat_details'][] = $detail;
}
// Skipped if null
```

### When JSON Parse Fails
```
json_decode(invalid_json) → null

$tourDarat = null ?? []  // Result: []

if (!empty($tourDarat)) {  // Skipped
    // ...
}
// Shows "not selected" message in view
```

### When Array Empty
```php
if (!empty($booking['facilities_details'])):
    // Shows items
else:
    // Shows "Tidak ada fasilitas dipilih"
endif;
```

---

## Before & After Comparison

### BEFORE Enhancement
```
Query Count: 1
└─ Load booking only

Data Available: Limited
├─ Tour IDs (from JSON)
└─ No tour details

Display: Generic placeholders
├─ "Fasilitas 1"
├─ "Fasilitas 2"
└─ No descriptions/prices
```

### AFTER Enhancement
```
Query Count: 1 + N + M + K
└─ Load booking + all related details

Data Available: Complete
├─ Tour details (name, desc, price)
├─ Facility details (name, desc, price)
└─ All from database

Display: Full information
├─ Real names, descriptions, prices
├─ Professional card layout
└─ Mobile responsive
```

---

## Integration Points

```
                    ┌─────────────────┐
                    │   Bookings Page │
                    │   /admin/      │
                    │   bookings     │
                    └────────┬────────┘
                             ↓
                    [User clicks Detail]
                             ↓
                    ┌─────────────────┐
                    │  This component │
                    │ (Detail page)   │
                    └─────────────────┘
                             ↑
                    ┌────────────────────┐
                    │   Admin Dashboard  │
                    │   /admin/          │
                    └────────────────────┘
```

---

**Document Status:** ✅ Complete
**Last Updated:** 2024
