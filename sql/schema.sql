CREATE TABLE categories (
                            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            description TEXT NOT NULL
);

CREATE TABLE articles (
                          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          title VARCHAR(255) NOT NULL,
                          description TEXT NOT NULL,
                          content LONGTEXT NOT NULL,
                          image VARCHAR(255) NOT NULL,
                          views INT UNSIGNED NOT NULL DEFAULT 0,
                          published_at DATETIME NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE article_category (
                                  article_id INT UNSIGNED NOT NULL,
                                  category_id INT UNSIGNED NOT NULL,

                                  PRIMARY KEY (article_id, category_id),

                                  CONSTRAINT fk_article_category_article
                                      FOREIGN KEY (article_id)
                                          REFERENCES articles(id)
                                          ON DELETE CASCADE,

                                  CONSTRAINT fk_article_category_category
                                      FOREIGN KEY (category_id)
                                          REFERENCES categories(id)
                                          ON DELETE CASCADE
);

CREATE INDEX idx_articles_published_at
    ON articles(published_at);

CREATE INDEX idx_articles_views
    ON articles(views);

CREATE INDEX idx_article_category_category
    ON article_category(category_id);