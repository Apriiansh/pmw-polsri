# PMW — Program Mahasiswa Wirausaha Polsri

CI4 + Shield (auth) + Tailwind v4 + Alpine.js + Vite. MySQL backend.

## Roles & Permissions (`app/Config/AuthGroups.php`)

| Role | Permissions | What they do |
|------|-------------|--------------|
| `admin` | `admin.*`, `data.*` | User/team/CMS management, all workflow stages (seleksi, pitching, perjanjian, pengumuman, implementasi, kegiatan, milestone, finalisasi, expo, awards) |
| `mahasiswa` | `data.upload`, `data.mentoring` | Submit proposal, pitching desk, perjanjian, bimbingan/mentoring logbook, training, implementasi items, kegiatan logbook, milestone reports, expo submission |
| `dosen` | `data.verify`, `data.view_all` | Validasi proposal & implementasi, bimbingan schedule/verify, kegiatan verify, milestone verify, monitoring |
| `mentor` | `data.verify`, `data.view_all` | Mentoring schedule/verify, kegiatan verify, monitoring |
| `reviewer` | `data.assess`, `data.view_all` | Penilaian proposal & laporan, kegiatan review |

Default registration group: `mahasiswa`.

## 11-Stage Workflow

1. Pendaftaran & Submit Proposal → 2. Seleksi Administrasi (admin) → 3. Pitching Desk (reviewer) → 4. Wawancara Perjanjian → 5. Pengumuman Tahap I → 6. Pembekalan → 7. Implementasi & Mentoring → 8. Monev Tahap 1 (Bazaar) → 9. Monev Tahap 2 (Site Visit) → 10. Pengumuman Tahap II → 11. Awarding & Expo

Phase access gated by `PmwPhaseAccessService` (checks `pmw_schedule` dates in active `pmw_period`).

## Commands

| Command | What it does |
|---------|-------------|
| `composer dev` | CI4 server (port 8080) + Tailwind watcher + Vite HMR |
| `composer build` | `composer install --optimize-autoloader` + build Tailwind (minified) + `php spark migrate --all` |
| `composer test` | PHPUnit |
| `npm run dev` | Vite dev server only |
| `npm run build` | Vite production build → `public/build/` |
| `php spark serve` | CI4 dev server (standalone) |
| `bash create_deploy_zip.sh` | Create cPanel deployment zips |

## Architecture Rules

- **Thin controllers**: No DB queries in controllers. Business logic in Services (`app/Services/`).
- **Entities**: Use CI4 Entities for model returns (no raw arrays for significant data).
- **Migrations only**: All DB changes via migration files. No manual SQL.
- **Transactions**: Multi-table state changes must use `$db->transBegin()` / `$db->transCommit()`.

## Routes (`app/Config/Routes.php`)

- Public: `/`, `/tentang`, `/tahapan`, `/galeri`, `/pengumuman`, `/sitemap.xml`
- Auth: custom `register`/`login`/`logout` override Shield defaults
- Role-grouped: `/admin/*`, `/mahasiswa/*`, `/reviewer/*`, `/dosen/*`, `/mentor/*`
- All auth: `/dashboard`, `/profile/*`, `/notifications/*`
- Shield routes auto-registered at end via `service('auth')->routes($routes)`

## Required Conventions

- **MY-KISAH logging**: Every major change logged in `my-kisah/[Day][Month]-[Time][AM/PM].md`.
- **Skeleton loaders**: Required for all dynamic/AJAX content. No "Loading..." text.
- **File security**: Uploads in `writable/uploads/`, served via controller with role checks.
- **UI classes**: `pmw-` prefix (`pmw-bento-container`, `pmw-card-premium`, `pmw-status-pill`, `pmw-workflow-step`).
- **CSS**: Two variants (`input.css` → `app.css`, `input-v2.css` → `app-v2.css`). Tailwind v4 standalone CLI or Vite plugin.
- **Commit prefixes**: `feat:`, `fix:`, `docs:`, `style:`, `refactor:`.

## Testing

- PHPUnit 10.5+ with SQLite in-memory (`:memory:`).
- `phpunit.xml.dist` at root. Test dir: `tests/`.

## Deployment

Zip-based for cPanel. `bash create_deploy_zip.sh` produces `deploy_pmw-app.zip` + `deploy_public_html.zip`. Vite build runs locally, not on server.

## Reference Files

- `.agents/rules/master-rules.md` — detailed dev standards
- `.agents/rules/ui-rules.md` — design system spec
- `.agents/workflows/pmw-workflow.md` — business process docs
- `app/Config/AuthGroups.php` — role/permission matrix
- `app/Config/Routes.php` — all route definitions
