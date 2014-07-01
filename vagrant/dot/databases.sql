CREATE SCHEMA `dev.nipponjob.com` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE USER 'nipponad'@'%' IDENTIFIED BY 'nipponad';
GRANT ALL PRIVILEGES ON `dev.nipponjob.com` . * TO 'nipponad'@'%';
CREATE USER 'nipponad'@'localhost' IDENTIFIED BY 'nipponad';
GRANT ALL PRIVILEGES ON `dev.nipponjob.com` . * TO 'nipponad'@'localhost';
FLUSH PRIVILEGES;