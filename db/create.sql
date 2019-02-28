/* MySQL sql statements to create lpad tables */
USE lpad;

DROP TABLE lpad_user_settings;
DROP TABLE lpad_global_settings;
DROP TABLE lpad_languages;
DROP TABLE lpad_editors;
DROP TABLE lpad_pdffonts;
DROP TABLE lpad_notes;
DROP TABLE lpad_users;

CREATE TABLE IF NOT EXISTS lpad_users (
  user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
  email VARCHAR(150) NOT NULL,
  password VARCHAR(255) NOT NULL /* will be saved as hash */
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_notes (
  note_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL,
  text TEXT CHARACTER SET utf8mb4 NOT NULL,
  user_id INT NOT NULL,
  CONSTRAINT fk_notes_users FOREIGN KEY (user_id) REFERENCES lpad_users(user_id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_pdffonts (
  font_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  font_name VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_editors (
  editor_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  editor_name VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_languages (
  lang_id VARCHAR(2) PRIMARY KEY NOT NULL,
  name VARCHAR(200) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_global_settings (
  setting_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  default_lang VARCHAR(2) NOT NULL,
  max_notes INT NOT NULL,
  CONSTRAINT fk_global_settings_languages FOREIGN KEY (default_lang) REFERENCES lpad_languages(lang_id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS lpad_user_settings (
  setting_id INT PRIMARY KEY AUTO_INCREMENT,
  lang VARCHAR(2) NOT NULL,
  ui_fg_color VARCHAR(7) NOT NULL,
  ui_bg_color VARCHAR(7) NOT NULL,
  pdf_font_id INT NOT NULL,
  editor_id INT NOT NULL,
  user_id INT NOT NULL,
  CONSTRAINT fk_user_settings_users FOREIGN KEY (user_id) REFERENCES lpad_users(user_id),
  CONSTRAINT fk_user_settings_pdffonts FOREIGN KEY (pdf_font_id) REFERENCES lpad_pdffonts(font_id),
  CONSTRAINT fk_user_settings_editors FOREIGN KEY (editor_id) REFERENCES lpad_editors(editor_id),
  CONSTRAINT fk_user_settings_languages FOREIGN KEY (lang) REFERENCES lpad_languages(lang_id)
) ENGINE = InnoDB;

INSERT INTO lpad_editors (editor_name) VALUES('SimpleMDE');
INSERT INTO lpad_pdffonts (font_name) VALUES ('DejaVu Sans');
INSERT INTO lpad_languages (lang_id, name) VALUES('EN', 100);
INSERT INTO lpad_languages (lang_id, name) VALUES('DE', 100);
INSERT INTO lpad_global_settings (default_lang, max_notes) VALUES('EN', 100);

DELIMITER ||
CREATE TRIGGER t_insert_users_after
AFTER INSERT ON lpad_users 
  FOR EACH ROW
    INSERT INTO lpad_user_settings (lang, ui_fg_color, ui_bg_color, pdf_font_id, editor_id, user_id) 
    VALUES ('EN', '#FFF', '#FFF', 1, 1, NEW.user_id); ||
    
DELIMITER ||
CREATE TRIGGER t_delete_users_before
BEFORE DELETE ON lpad_users
	FOR EACH ROW
		DELETE FROM lpad_user_settings WHERE lpad_user_settings.user_id = OLD.user_id; ||

INSERT INTO lpad_users (name, email, password) VALUES('admin', 'admin@test.com', SHA2('admin', 512));
