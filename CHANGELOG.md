# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

---

## [1.0.0] - 2026-03-12

### Added

#### Core Modules

- Owner management (full CRUD with user account creation)
- Tenant management (full CRUD with user account creation)
- Property management (owner/tenant assignment, rate history tracking)

#### Receipt Generation

- Rent receipt generation with auto amount-in-words (Pakistani Rupee format)
- Maintenance bill receipt with automatic owner/tenant split calculation
- Electricity bill receipt with auto rate calculation from WAPDA bill
- Professional PDF download for all receipt types (DomPDF)
- Month selector from January 2025 onwards

#### Financial Tracking

- Security deposit tracking with deduction management
- Deduction proof upload (photo evidence)
- Partial and full refund processing
- Rate history logging (electricity, maintenance, rent)
- Bill attachment upload for electricity and maintenance receipts

#### Sub-Meter Evidence

- Sub-meter previous reading photo upload
- Sub-meter current reading photo upload

#### User Roles & Access

- Admin role with full system access
- Owner role with data isolation (see only own data)
- Tenant portal with read-only access to own receipts
- Role-based middleware for route protection

#### Authentication & Security

- Modern login/register UI with gradient design
- Profile management (update name, email, password)
- CSRF protection on all forms
- Password hashing with bcrypt
- Security headers middleware
- Login rate limiting (5 attempts/minute)
- Public registration disabled (admin-only user creation)
- File upload validation (type + size restrictions)

#### Dashboard

- Live statistics (properties, tenants, rent collected, deposits held)
- Current month's rent collection tracking
- Recent receipts from all modules
- Quick action buttons
- Property overview with occupancy status

#### UI/UX

- Modern sidebar navigation with role-based menu
- Professional card-based layout
- Bootstrap 5 with Bootstrap Icons
- Responsive design
- Flash message notifications
- Auto-calculation previews on forms

---

## Future Releases

See [Roadmap](README.md#roadmap) for planned features.
