USE sun_and_ground;
CREATE TABLE users(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    city VARCHAR(25) NOT NULL,
    home_address VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    is_admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE products (
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    category VARCHAR(50),
    options INT(10) DEFAULT 1,
    variety VARCHAR(50),
    image_path VARCHAR(255),
    cultivation VARCHAR(50),
    characteristics TEXT,
    brief_description TEXT
);

CREATE TABLE product_variations (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    product_id INT(11) NOT NULL,
    weight_grams INT(11) NOT NULL,
    price_cents INT(11) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);