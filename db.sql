DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS orders;

CREATE TABLE users (
    user_id             SMALLINT NOT NULL AUTO_INCREMENT,
    first_name          VARCHAR(30),
    last_name           VARCHAR(30),
    date_of_birth       DATE,
    user_image_path     VARCHAR(255) DEFAULT '../Resources/UserImages/default.jpg',
    user_type           VARCHAR(5) DEFAULT 'user',  -- Change to admin when inserting data
    email               VARCHAR(50) NOT NULL,
    password_hash       VARCHAR(255) NOT NULL,

    PRIMARY KEY(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE products (
    product_id          SMALLINT NOT NULL AUTO_INCREMENT,
    product_name        VARCHAR(30) NOT NULL,
    product_description VARCHAR(255) NOT NULL,
    category            VARCHAR(30),
    product_image_path  VARCHAR(255),
    product_price       INT NOT NULL,
    in_stock            SMALLINT NOT NULL,

    PRIMARY KEY(product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE orders (
    order_id            SMALLINT NOT NULL AUTO_INCREMENT,
    in_basket           VARCHAR(1) DEFAULT 'N',     -- Change to Y when user adds item to basket
    order_amount        SMALLINT,
    product_id          SMALLINT,
    user_id             SMALLINT,
    PRIMARY KEY(order_id),
    FOREIGN KEY(product_id)
        REFERENCES product(product_id)
        ON UPDATE CASCADE               -- When updated in products table, update this also
        ON DELETE SET NULL,             -- If product is removed from selection, leave order visible to user
    
    FOREIGN KEY(user_id)
        REFERENCES users(user_id)
        ON UPDATE CASCADE               -- If user id gets updated, also update this
        ON DELETE SET NULL              -- SET NULL because orders are saved for accounting
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


-- Users
INSERT INTO users (user_type, email, password_hash) VALUES('admin', 'admin@rights.com', 'admin');
INSERT INTO users (email, password_hash) VALUES('user@scrub.com', 'user');

-- Products
INSERT INTO products (product_name, product_description, product_price, category, in_stock) VALUES('Computer', 'Fastest there is', 1500, 'Computers', '2');
INSERT INTO products (product_name, product_description, product_price, category, in_stock) VALUES('Another Computer', 'Not as fast', 800, 'Computers', '5');
INSERT INTO products (product_name, product_description, product_price, category, in_stock) VALUES('Phone', 'Smart as duck', 799, 'Phones', '25');

-- Orders
INSERT INTO orders (order_amount, product_id, user_id) VALUES(2, 2, 2);