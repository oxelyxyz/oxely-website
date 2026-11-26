# oxely-website

Source code of **[oxely.xyz](https://oxely.xyz)**, the website for Oxely, simple on-chain vaults with clear rules.

> Oxely is **pre-launch**. No vault is live and no deposits are accepted. Figures in the app preview are clearly marked as sample data.

## Pages

| URL | File | What it is |
|---|---|---|
| `/` | `index.html` | Home: vaults, how it works, security, waitlist |
| `/app` | `app.html` | Oxely App product page |
| `/dashboard.html` | `dashboard.html` | App preview: vault list, details drawer, waitlist modal |
| `/docs` | `docs.html` | Documentation |
| (form) | `contact.php` | Saves waitlist sign-ups as JSON lines, outside the web root |

## Built with

- Plain HTML, CSS and JavaScript. No framework and no build step.
- [Geist](https://vercel.com/font) and Geist Mono from Google Fonts
- The 3D logo, particle ring, cube and charts are pure CSS, SVG and Canvas
- Animations respect `prefers-reduced-motion`

## Run it locally

Any static server works for the pages:

```bash
python -m http.server 8080
# then open http://localhost:8080
```

To test the waitlist form you need PHP:

```bash
php -S localhost:8080
```

Clean URLs (`/app`, `/docs`) come from `.htaccess` and only work on Apache. Locally, open `app.html` and `docs.html` directly.

## Deploy

1. Upload all files to the site's web root (for cPanel: `public_html`).
2. Make sure `mod_rewrite` is on so `.htaccess` works.
3. Optional: set the `OXELY_STORE_DIR` environment variable to choose where sign-ups are saved. By default it is `../contact-messages`, one level **above** the web root, so it is never public.

## Contributing

Bug reports and small fixes are welcome. See [CONTRIBUTING](https://github.com/oxelyxyz/.github/blob/main/CONTRIBUTING.md). For security problems, follow the [security policy](https://github.com/oxelyxyz/.github/blob/main/SECURITY.md) and report privately.

## License

Code is released under the [MIT License](LICENSE). The Oxely name and logo are **not** covered by this license. See [oxely-brand](https://github.com/oxelyxyz/oxely-brand).
