#!/usr/bin/env bash
# Production operations for Central Branch Conference / SCMERD.
# Run on the server from the application directory, for example:
#   cd /var/www/scmerd && ./deployment/manage-production.sh queue:install

set -Eeuo pipefail

APP_DIR="${APP_DIR:-$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)}"
ARTISAN="$APP_DIR/artisan"
SUPERVISOR_CONFIG="$APP_DIR/deployment/supervisor-scmerd-queue.conf"
SUPERVISOR_TARGET="/etc/supervisor/conf.d/scmerd-queue.conf"

usage() {
    cat <<'USAGE'
Usage: deployment/manage-production.sh <command> [arguments]

Commands:
  queue:install                 Install and start the Supervisor queue worker (requires sudo).
  queue:restart                 Restart the Supervisor queue worker (requires sudo).
  queue:work                    Run one foreground queue worker for troubleshooting.
  admin:create EMAIL "NAME"     Create or update an administrator; prompts for a password.
  database:reset                Back up and irreversibly reset the configured database.

For database:reset you must type exactly: RESET-PRODUCTION-DATABASE
USAGE
}

require_artisan() {
    if [[ ! -f "$ARTISAN" ]]; then
        echo "artisan was not found at $ARTISAN" >&2
        exit 1
    fi
}

queue_install() {
    [[ -f "$SUPERVISOR_CONFIG" ]] || { echo "Supervisor configuration not found." >&2; exit 1; }
    sudo install -m 0644 "$SUPERVISOR_CONFIG" "$SUPERVISOR_TARGET"
    sudo supervisorctl reread
    sudo supervisorctl update
    sudo supervisorctl status scmerd-queue:*
}

queue_restart() {
    sudo supervisorctl restart scmerd-queue:*
    sudo supervisorctl status scmerd-queue:*
}

queue_work() {
    require_artisan
    exec php "$ARTISAN" queue:work database --sleep=3 --tries=3 --max-time=3600 --timeout=90
}

admin_create() {
    require_artisan
    [[ $# -eq 2 ]] || { echo 'Usage: admin:create EMAIL "NAME"' >&2; exit 2; }
    php "$ARTISAN" app:create-admin "$1" "$2"
}

database_reset() {
    require_artisan

    local connection
    connection="$(sed -n -E 's/^DB_CONNECTION=(.*)$/\1/p' "$APP_DIR/.env" | tail -n 1 || true)"
    connection="${connection//$'\r'/}"
    connection="${connection:-sqlite}"

    if [[ "$connection" != 'sqlite' ]]; then
        echo "database:reset only supports the configured SQLite database; DB_CONNECTION is $connection." >&2
        echo 'Create and verify a database-provider backup before using migrate:fresh for MySQL or PostgreSQL.' >&2
        exit 1
    fi

    echo 'WARNING: This removes all application data, including users, registrations, submissions, and reviews.' >&2
    read -r -p 'Type RESET-PRODUCTION-DATABASE to continue: ' confirmation
    [[ "$confirmation" == 'RESET-PRODUCTION-DATABASE' ]] || { echo 'Database reset cancelled.'; exit 1; }

    # Laravel resolves a blank DB_DATABASE to database/database.sqlite.
    local database_file="$APP_DIR/database/database.sqlite"
    local configured_database
    configured_database="$(sed -n -E 's/^DB_DATABASE=(.*)$/\1/p' "$APP_DIR/.env" | tail -n 1 || true)"
    configured_database="${configured_database%\"}"
    configured_database="${configured_database#\"}"

    if [[ -n "$configured_database" ]]; then
        if [[ "$configured_database" = /* ]]; then
            database_file="$configured_database"
        else
            database_file="$APP_DIR/$configured_database"
        fi
    fi

    if [[ -f "$database_file" ]]; then
        local backup_file="${database_file}.backup.$(date +%Y%m%d%H%M%S)"
        cp -p -- "$database_file" "$backup_file"
        echo "SQLite backup created: $backup_file"
    else
        echo "No SQLite file found at $database_file; Laravel will create it during migration."
    fi

    php "$ARTISAN" migrate:fresh --force
    echo 'Database reset complete. Create a new administrator before opening the site.'
}

command="${1:-}"
shift || true

case "$command" in
    queue:install) queue_install "$@" ;;
    queue:restart) queue_restart "$@" ;;
    queue:work) queue_work "$@" ;;
    admin:create) admin_create "$@" ;;
    database:reset) database_reset "$@" ;;
    -h|--help|help|'') usage ;;
    *) echo "Unknown command: $command" >&2; usage; exit 2 ;;
esac
