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
    product_image_path  VARCHAR(255) DEFAULT '../Resources/ProductImages/default.png',
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

-- Products
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Computer', 'Fastest there is', 1500, 'Computers', '2', '../resources/productImages/computer1.png');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Another Computer', 'Not as fast', 800, 'Computers', '5', '../resources/productImages/computer2.png');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Phone', 'Smart as duck', 799, 'Phones', '25', '../resources/productImages/phone1.png');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Retro Phone', 'Great for hipsters', 200, 'Phones', '4', '../resources/productImages/phone2.png');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Smart phone', 'Can run tinder', 999, 'Phones', '25', '../resources/productImages/phone3.png');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Retro Computer', 'Runs Doom on 60FPS', 400, 'Computers', '5','../resources/productImages/computer3.jpg');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Desktop PC', 'Nothing special about this', 900, 'Computers', '2', '../resources/productImages/computer4.jpg');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Keyboard', 'Great for typing', 20, 'Accessories', '50', '../resources/productImages/keyboard.jpg');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Mouse', 'Use this to click stuff', 15, 'Accessories', '10', '../resources/productImages/mouse.jpg');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('USB stick', 'You WILL lose this', 10, 'Accessories', '30', '../resources/productImages/usb.jpg');
INSERT INTO products (product_name, product_description, product_price, category, in_stock, product_image_path) VALUES('Cable', 'Goes great with appropriate ports', 13, 'Accessories', '90', '../resources/productImages/cable.jpg');

