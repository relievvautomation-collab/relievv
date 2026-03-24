#!/bin/bash

# echo "Waiting for MySQL..."
# for i in {1..30}; do
#     if mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --silent 2>/dev/null; then
#         echo "MySQL is ready!"
#         break
#     fi
#     echo "Attempt $i - waiting..."
#     sleep 3
# done

# # Check if table already exists
# TABLE_EXISTS=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "SHOW TABLES LIKE 'tbladmin';" 2>/dev/null)

# if [ -z "$TABLE_EXISTS" ]; then
#     echo "Importing database..."
#     mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < /var/www/html/database.sql
#     echo "Database imported!"
# else
#     echo "Tables already exist, skipping import."
# fi


# !/bin/bash

# echo "Waiting for MySQL..."
# for i in {1..30}; do
#     if mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --skip-ssl -e "SELECT 1;" "$DB_NAME" >/dev/null 2>&1; then
#         echo "MySQL is ready!"
#         break
#     fi
#     echo "Attempt $i - waiting..."
#     sleep 3
# done

# # Check if table already exists
# TABLE_EXISTS=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --skip-ssl "$DB_NAME" -e "SHOW TABLES LIKE 'tbladmin';" 2>/dev/null)

# if [ -z "$TABLE_EXISTS" ]; then
#     echo "Importing database..."
#     mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --skip-ssl "$DB_NAME" < /var/www/html/database.sql
#     echo "✅ Database imported!"
# else
#     echo "✅ Tables already exist, skipping import."
# fi


#!/bin/bash

# ✅ Fix uploads folder permissions on every startup
mkdir -p /var/www/html/uploads
chmod -R 777 /var/www/html/uploads
chown -R www-data:www-data /var/www/html/uploads
echo "✅ Uploads folder permissions fixed!"

echo "Waiting for MySQL..."
for i in {1..30}; do
    if mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --skip-ssl -e "SELECT 1;" "$DB_NAME" >/dev/null 2>&1; then
        echo "MySQL is ready!"
        break
    fi
    echo "Attempt $i - waiting..."
    sleep 3
done

# Check if table already exists
TABLE_EXISTS=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --skip-ssl "$DB_NAME" -e "SHOW TABLES LIKE 'tbladmin';" 2>/dev/null)

if [ -z "$TABLE_EXISTS" ]; then
    echo "Importing database..."
    mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --skip-ssl "$DB_NAME" < /var/www/html/database.sql
    echo "✅ Database imported!"
else
    echo "✅ Tables already exist, skipping import."
fi
