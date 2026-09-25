#!/bin/sh
set -eu

cd /var/www/html

echo "Waiting for WordPress files..."
i=0
while [ ! -f wp-config.php ]; do
  i=$((i + 1))
  if [ "$i" -gt 90 ]; then
    echo "Timed out waiting for wp-config.php"
    exit 1
  fi
  sleep 2
done

echo "Waiting for the database..."
i=0
until wp db query "SELECT 1" --allow-root >/dev/null 2>&1; do
  i=$((i + 1))
  if [ "$i" -gt 90 ]; then
    echo "Timed out waiting for the database"
    exit 1
  fi
  sleep 2
done

if ! wp core is-installed --allow-root >/dev/null 2>&1; then
  wp core install \
    --allow-root \
    --url="http://localhost:8090" \
    --title="Sovassa Technologies" \
    --admin_user="admin" \
    --admin_password="${WP_ADMIN_PASSWORD:-sovassa-local}" \
    --admin_email="hello@sovassa.example" \
    --skip-email
fi

if ! wp theme is-installed sovassa --allow-root >/dev/null 2>&1; then
  echo "Theme sovassa is not available in wp-content/themes."
  exit 1
fi

wp theme activate sovassa --allow-root
wp rewrite structure '/%postname%/' --hard --allow-root
wp rewrite flush --hard --allow-root
wp option update blogdescription "Build. Market. Grow." --allow-root

echo "Sovassa Technologies is ready at http://localhost:8090"
echo "Admin: http://localhost:8090/wp-admin  (admin / ${WP_ADMIN_PASSWORD:-sovassa-local})"
