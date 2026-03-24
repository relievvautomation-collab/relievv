#!/bin/bash
echo "Waiting for MySQL to be ready..."
until mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --silent; do
    sleep 2
done

echo "Importing database..."
mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < /var/www/html/relievv.sql
echo "Database imported successfully!"
