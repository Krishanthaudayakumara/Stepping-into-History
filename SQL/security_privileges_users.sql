DROP USER 'product_manager'@'localhost';
DROP USER 'customer_care'@'localhost';
DROP USER 'db_admin'@'localhost';

FLUSH PRIVILEGES;

CREATE USER 'product_manager'@'localhost' IDENTIFIED BY 'password';
CREATE USER 'customer_care'@'localhost' IDENTIFIED BY 'password';
CREATE USER 'db_admin'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON History.product TO 'product_manager'@'localhost';
GRANT ALL PRIVILEGES ON History.purchase TO 'product_manager'@'localhost';
GRANT ALL PRIVILEGES ON History.book TO 'product_manager'@'localhost';
GRANT ALL PRIVILEGES ON History.hm_subs TO 'product_manager'@'localhost';


GRANT ALL PRIVILEGES ON History.customer TO 'customer_care'@'localhost';

GRANT ALL PRIVILEGES ON History.* TO 'db_admin'@'localhost';
