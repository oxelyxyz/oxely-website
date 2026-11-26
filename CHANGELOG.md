# Changelog

All notable changes to oxely.xyz. Newest first.

## 2026-11-26

### Added
- **Docs** at `/docs`: overview, access and withdrawals, one page per vault, share value, risks and controls, FAQ. Sidebar search (`/`), reading progress bar and previous/next links.
- **How it works** band on the home page: three steps (Connect, Allocate, Follow & withdraw) with scroll-filled progress lines and small animated diagrams.
- **Diagram cards**: "Many markets, one vault" flow and "Limits that don't move" hard-limit bars.
- **App preview** at `/dashboard.html`: vault cards, filters, search, details drawer and a waitlist modal in place of wallet connection.
- **Oxely App page** at `/app` with a 3D phone mock-up, cube walkthrough, roadmap and use cases.
- **Social** column in the footer (X and GitHub, marked "Soon" until the accounts are live).
- Final call-to-action box with a rotating gradient border and pointer-following dots.

### Changed
- Home page reworked around Oxely vaults (Stable, Hedge, Custom) with a waitlist instead of a contact form.
- Clean URLs: `/app` and `/docs`; old `.html` addresses redirect with 301.
- Logo links scroll to the top without adding `#top` to the address.

### Fixed
- Reveal-on-scroll elements that never appeared, because a fully clipped element reads as invisible to `IntersectionObserver`.
- Docs content falling below the sidebar on desktop.
- Social "Soon" label overlapping the next footer column on phones.
