/* MySQL sql statements to create lpad tables */

CREATE TABLE IF NOT EXISTS lpad_users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL /* will be saved as hash */
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_notes (
  note_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  text TEXT NOT NULL,
  user_id INT NOT NULL,
  CONSTRAINT fk_notes_users FOREIGN KEY (user_id) REFERENCES lpad_users(user_id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_pdffonts (
  font_id INT PRIMARY KEY AUTO_INCREMENT,
  font_name VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_editors (
  editor_id INT PRIMARY KEY AUTO_INCREMENT,
  editor_name VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_global_settings (
  setting_id INT PRIMARY KEY AUTO_INCREMENT,
  default_language VARCHAR(3) NOT NULL,
  max_notes INT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_user_settings (
  setting_id INT PRIMARY KEY AUTO_INCREMENT,
  language VARCHAR(3) NOT NULL,
  ui_fg_color VARCHAR(7) NOT NULL,
  ui_bg_color VARCHAR(7) NOT NULL,
  pdf_font_id INT NOT NULL,
  editor_id INT NOT NULL,
  user_id INT NOT NULL,
  CONSTRAINT fk_user_settings_users FOREIGN KEY (user_id) REFERENCES users(user_id),
  CONSTRAINT fk_user_settings_pdffonts FOREIGN KEY (pdf_font_id) REFERENCES lpad_pdffonts(font_id),
  CONSTRAINT fk_user_settings_editors FOREIGN KEY (editor_id) REFERENCES lpad_editors(editor_id)
) ENGINE = InnoDB;

INSERT INTO lpad_users (name, password) VALUES('admin', SHA2('admin', 512));
INSERT INTO lpad_editors VALUES('SimpleMDE');
INSERT INTO lpad_pdffonts VALUES ('DejaVu Sans');
INSERT INTO lpad_global_settings VALUES('EN', 100);


