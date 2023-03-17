mysql --user=root --password="${MYSQL_ROOT_PASSWORD}" <<EOSQL
    CREATE DATABASE IF NOT EXISTS bloomex_assignment_test;
    CREATE USER 'bloomex_user_test'@'%' IDENTIFIED BY 'password';
    GRANT ALL PRIVILEGES ON bloomex_assignment_test.* TO 'bloomex_user_test'@'%';
EOSQL
