# #!/bin/bash
# echo "Waiting for MySQL to be ready..."
# until mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --silent; do
#     sleep 2
# done

# echo "Importing database..."
# mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < /var/www/html/relievv.sql
# echo "Database imported successfully!"


#!/bin/bash

echo "Waiting for MySQL..."
for i in {1..30}; do
    if mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --silent 2>/dev/null; then
        echo "MySQL is ready!"
        break
    fi
    echo "Attempt $i - waiting..."
    sleep 3
done

# Check if table already exists to avoid duplicate import
TABLE_EXISTS=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "SHOW TABLES LIKE 'tblblog';" 2>/dev/null)

if [ -z "$TABLE_EXISTS" ]; then
    echo "Importing database..."
    mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < /var/www/html/database.sql
    echo "✅ Database imported!"
else
    echo "✅ Database already exists, skipping import."
fi
