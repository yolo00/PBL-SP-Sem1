## Repository snapshot

This is a small static web project for a student project (PBL) that implements a "Digitalisasi Surat Peringatan" front-end only. Primary artifacts:

- Top-level HTML pages: `dashboard-mahasiswa.html`, `dashboard-staf.html`, `kelola-staf.html`, `login.html`, `profil-mahasiswa.html`, `profil-staf.html`, `tambah-surat.html`, `surat1.html`, `surat2.html`.
- Static assets: `css/` (page-specific styles), `js/` (page scripts), and `image/`.

## Big-picture architecture for an AI coder

- Pure client-side static site. There is no server-side code in this repository. All interactions are performed with plain HTML forms and vanilla JavaScript files in `js/`.
- Pages are independent HTML files linked by standard anchor tags (no SPA/router). Data persistence is simulated via in-file JavaScript arrays (example: `js/sp-mahasiswa.js` uses `dataSurat` array).
- File-by-file patterns:
  - Pages that manage lists (e.g. `kelola-staf.html`) rely on `js/sp-mahasiswa.js` to render table rows.
  - The login page (`login.html`) includes `js/script1.js` but the included `js/script-login.js` is empty — expect login behavior to be implemented client-side via event listeners.
  - The add form (`tambah-surat.html`) uses `scripttambah.js` (referenced as `/js/scripttambah.js`) for client-side validation, file drag/drop, and form submission handling.

## Project-specific conventions and gotchas

- File paths: HTML files link assets with relative paths (e.g. `css/profil.css`, `js/script1.js`). Some pages reference `/js/scripttambah.js` (leading slash) — when testing locally, prefer serving via a static file server (see below) to avoid path issues.
- Minimal JS organization: each page gets a single script in `js/`. Look at `js/sp-mahasiswa.js` for the rendering pattern: populate DOM on `DOMContentLoaded` and append rows to an existing table element.
- CSS is page-scoped by filename (e.g. `css/tambah-surat.css`). Avoid making global assumptions.
- Sample data: many pages use inline arrays for demo data. Persisting changes across pages is not implemented; if asked to add persistence, prefer lightweight solutions (localStorage for quick prototypes) and document that choice.

## How to run and debug (developer workflows)

- Serve the folder with a simple static server rather than opening files directly. Recommended commands (Windows PowerShell):

  - Python 3 built-in server (from repository root):

    python -m http.server 8000

  - Node.js http-server (if installed):

    ## Repository snapshot

    This is a small static web project for a student project (PBL) that implements a "Digitalisasi Surat Peringatan" front-end only. Primary artifacts:

    - Top-level HTML pages: `dashboard-mahasiswa.html`, `dashboard-staf.html`, `kelola-staf.html`, `login.html`, `profil-mahasiswa.html`, `profil-staf.html`, `tambah-surat.html`, `surat1.html`, `surat2.html`.
    - Static assets: `css/` (page-specific styles), `js/` (page scripts), and `image/`.

    ## Big-picture architecture for an AI coder

    - Pure client-side static site. There is no server-side code in this repository. All interactions are performed with plain HTML forms and vanilla JavaScript files in `js/`.
    - Pages are independent HTML files linked by standard anchor tags (no SPA/router). Data persistence is simulated via in-file JavaScript arrays (example: `js/sp-mahasiswa.js` uses `dataSurat` array).
    - File-by-file patterns:
      - Pages that manage lists (e.g. `kelola-staf.html`) rely on `js/sp-mahasiswa.js` to render table rows.
      - The login page (`login.html`) includes `js/script1.js` but the included `js/script-login.js` is empty — expect login behavior to be implemented client-side via event listeners.
      - The add form (`tambah-surat.html`) uses `scripttambah.js` (referenced as `/js/scripttambah.js`) for client-side validation, file drag/drop, and form submission handling.

    ## Project-specific conventions and gotchas

    - File paths: HTML files link assets with relative paths (e.g. `css/profil.css`, `js/script1.js`). Some pages reference `/js/scripttambah.js` (leading slash) — when testing locally, prefer serving via a static file server (see below) to avoid path issues.
    - Minimal JS organization: each page gets a single script in `js/`. Look at `js/sp-mahasiswa.js` for the rendering pattern: populate DOM on `DOMContentLoaded` and append rows to an existing table element.
    - CSS is page-scoped by filename (e.g. `css/tambah-surat.css`). Avoid making global assumptions.
    - Sample data: many pages use inline arrays for demo data. Persisting changes across pages is not implemented; if asked to add persistence, prefer lightweight solutions (localStorage for quick prototypes) and document that choice.

    ## How to run and debug (developer workflows)

    - Serve the folder with a simple static server rather than opening files directly. Recommended commands (Windows PowerShell):

      - Python 3 built-in server (from repository root):

        python -m http.server 8000

      - Node.js http-server (if installed):

        npx http-server -p 8000

    - Then open: http://localhost:8000/login.html (or other pages).
    - Debugging: use browser DevTools. Break on `DOMContentLoaded` listeners and inspect `js/` files. Use `console.log` to trace dataset changes (e.g. in `js/sp-mahasiswa.js` and `js/scripttambah.js`).

    ## Integration points & likely extension areas

    - Persistence: absent. Common integration requests will be to add a server API (REST) or add localStorage. Files to touch: `js/scripttambah.js` (submit form), `js/sp-mahasiswa.js` (load/save list).
    - File uploads: `tambah-surat.html` includes a drag/drop area — implementation likely in `js/scripttambah.js`.
    - Routing/auth: `login.html` currently uses client-side selection and an empty `script-login.js`. If adding auth, add a minimal auth service and protect pages via a small check placed in each page's script.

    ## Examples for common edits (copy-paste friendly)

    - Render table rows (pattern used in `js/sp-mahasiswa.js`):

      - Select table element by id, create `tr` elements, set `innerHTML` with `<td>`s, and append.

    - Add localStorage persistence (suggested location): in `js/sp-mahasiswa.js` replace the static `dataSurat` with a load/save wrapper around `localStorage.getItem('dataSurat')`.

    ## What to avoid

    - Don't change global layout CSS files; styles are intentionally page-specific.
  - Don't assume a backend exists. Many forms use an action attribute set to # (no server configured).

    ---
    If any section is unclear or you'd like more examples (e.g. a ready patch to add localStorage persistence or a small static server script), tell me which area to expand and I'll update this file.
