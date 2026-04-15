# PMW Polsri Governance Protocol

This document defines the standards, rules, and workflows for the development of the **Program Mahasiswa Wirausaha (PMW)** system at Politeknik Negeri Sriwijaya.

## 🏆 Development Rules (Senior Principal Standards)

1.  **Zero-Static UI**: Every data-loading operation MUST have a skeleton loader. No raw "Loading..." text or empty screens without context.
2.  **Workflow Integrity**: State transitions for Proposals (the 11-stage process) must be atomic. Use Database Transactions for ALL workflow updates to prevent data corruption.
3.  **Bento Consistency**: Every dashboard item must follow the `pmw-bento-grid` layout.
    -   Standard Item: 1x1 grid.
    -   Priority Item (e.g., Active Timeline): 2x1 or 2x2 grid.
4.  **No "AI-Shadows"**: Avoid default Bootstrap or generic shadows. Use custom layered shadows for a premium feel:
    ```css
    --pmw-shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
    --pmw-shadow-md: 0 4px 12px -2px rgba(0,0,0,0.08), 0 2px 6px -1px rgba(0,0,0,0.04);
    --pmw-shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
    ```
5.  **Secure Document Handling**: All uploaded documents (Proposals, Reports, Notas) must be stored in the non-public `writable/uploads` directory. Access must be managed via a Controller with role-based permission checks.
6.  **"Not AI" Aesthetic**: Prioritize micro-interactions (hover states, subtle parallax, smooth layout shifts) and curated typography (Inter/Outfit) over generic templates.

## 🔄 The 11-Stage PMW Workflow

The application must enforce this exact sequential lifecycle:

1.  **Pendaftaran PMW**: Initial submission by Mahasiswa.
2.  **Seleksi Administrasi**: Review by Admin.
3.  **Seleksi Pitching Desk**: Evaluation by Reviewers.
4.  **Wawancara Perjanjian Implementasi**: Interview phase.
5.  **Seleksi Substansi Proposal**: Final technical review.
6.  **Pengumuman Tahap I & Pembekalan**: Funding Phase 1 release and training.
7.  **Implementasi & Mentoring**: Active business operations with Practitioners.
8.  **Monev Tahap 1 (Bazaar)**: Mid-term evaluation and public display.
9.  **Monev Tahap 2 (Site Visit)**: Physical inspection of the business.
10. **Pengumuman Tahap II**: Final funding release.
11. **Awarding & Expo**: Graduation and public celebration.

## 🛠 Tech Stack Requirements

-   **Framework**: CodeIgniter 4 (CI4) - Service/Repository Pattern.
-   **Authentication**: CodeIgniter Shield (AuthGroups: `admin`, `mahasiswa`, `dosen`, `mentor`, `reviewer`).
-   **Frontend**: Vanilla CSS Modern + Grid/Flexbox + Bootstrap 5 (Utilities only).
-   **Animations**: CSS Keyframes & Web Animations API for smooth transitions.

## 🎨 UI Naming Conventions

-   `pmw-bento-container`: Main grid wrapper.
-   `pmw-card-premium`: Standard card with glassmorphism/soft-shadow.
-   `pmw-status-pill`: Consistent status indicators per role.
-   `pmw-workflow-step`: Visual progress indicator for the 11 stages.
