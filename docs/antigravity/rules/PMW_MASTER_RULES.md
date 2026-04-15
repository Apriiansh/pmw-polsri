# 📜 PMW MASTER RULES
Mandatory development standards for the PMW Polsri project.

## 1. PROJECT ARCHITECTURE (CI4 EXPERT)
- **Thin Controllers**: No database queries in Controllers.
- **Service Layer**: 100% logic in Services (`app/Services`).
- **Repositories**: Optional but recommended for complex query logic (`app/Repositories`).
- **Entities**: Use CI4 Entities for all model returns. No raw arrays for significant data.

## 2. DATABASE STANDARDS
- **Migrations only**: Any DB change MUST have a migration file. Never use manual SQL via phpMyAdmin.
- **Transactions**: State-changing operations across multi-tables MUST use `$db->transBegin()`, `$db->transCommit()`.
- **Naming**: `snake_case` for columns, `plural_snake_case` for tables.

## 3. SECURITY (SHIELD AUTH)
- **Shield Role Guards**: Use `filter => 'group:admin,reviewer'` in Routes.
- **CSRF**: Never disable. Always use `<?= csrf_field() ?>` in forms and `X-CSRF-TOKEN` in AJax.
- **File Privacy**: User-uploaded documents MUST NOT be in `public`. Serving via Secure Controller is mandatory.

## 4. UI/UX "SENIOR PRINCIPAL" STANDARDS
- **Skeleton Loaders**: Required for all AJAX/Dynamic content. No "Waiting..." text.
- **Responsive-First**: Layouts must be verified at `320px` (Mobile) and `2560px` (Desktop).
- **Interactive States**: Every button and link must have `:hover`, `:active`, and `:focus` styles defined.
- **Modern Gradients**: Avoid flat colors for big surfaces. Use subtle linear gradients for Depth.

## 5. COMMIT & DOCUMENTATION
- **Prefixes**: `feat:`, `fix:`, `docs:`, `style:`, `refactor:`.
## 6. PROGRESS TRACKING (MY-KISAH)
- **Log Every Step**: Every major interaction and system change MUST be recorded in the `my-kisah/` directory.
- **Naming Pattern**: Use the format `[Day][Month]-[Time][AM/PM].md` (e.g., `14Apr-1141AM.md`).
- **Content**: Each log serves as a "Kisah" (story) of what was implemented, why, and the current state of the project.
