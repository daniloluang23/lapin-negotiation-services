# Lapin Negotiation Services

WordPress site code for [lapin-negotiation-services](https://github.com/daniloluang23/lapin-negotiation-services).

Only custom code is tracked — WordPress core and third-party plugins/themes are excluded via a whitelist `.gitignore`.

## What's in the repo

| Path | Purpose |
|------|---------|
| `wp-content/themes/lapin-negotiation-services/` | Child theme of Twenty Twenty-Five |
| `wp-content/plugins/lapin-core/` | Site-specific functionality plugin |
| `.github/workflows/deploy.yml` | SFTP deployment on push to `main` |

To track an additional custom plugin, add a `!/wp-content/plugins/<plugin-name>/` line to `.gitignore`.

## Deployment

Every push to `main` (or a manual run via the Actions tab) uploads `wp-content/` to the server over SFTP.

The workflow uses a GitHub **environment named `production`**. Create it under
**Settings → Environments → New environment**, then add these secrets to it:

| Secret | Required | Description |
|--------|----------|-------------|
| `SFTP_HOST` | yes | SFTP server hostname or IP |
| `SFTP_PORT` | no | Defaults to `22` |
| `SFTP_USERNAME` | yes | SFTP user |
| `SFTP_PASSWORD` | yes* | SFTP password |
| `SSH_PRIVATE_KEY` | yes* | SSH private key (alternative to password) |
| `SFTP_REMOTE_PATH` | yes | Absolute path to `wp-content` on the server, e.g. `/var/www/html/wp-content` |

\* Provide either `SFTP_PASSWORD` or `SSH_PRIVATE_KEY` — one of the two is enough.

## Local development

The site runs in [Local](https://localwp.com/) at `Local Sites/lapin-negotiation-services`.
Activate the **Lapin Negotiation Services** theme and the **Lapin Core** plugin in wp-admin.
