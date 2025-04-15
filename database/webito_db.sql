SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `pass` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `isaccess` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `events` (
  `eid` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `type` ENUM('technical', 'non-technical') NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `time` TIME DEFAULT NULL,
  `date` DATE DEFAULT NULL,
  `image` VARCHAR(1000) DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `olusturma_tarihi` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `admin` (`name`, `pass`, `email`, `isaccess`) 
VALUES ('admin', '1234', 'admin@admin.edu', 1)
ON DUPLICATE KEY UPDATE email = email;


INSERT INTO `events` (`name`, `description`, `type`, `location`, `time`, `date`, `image`, `status`)
VALUES
('Teknoloji Zirvesi', 'Yapay zeka ve yeni nesil yazılımlar hakkında konferans.', 'technical', 'İstanbul Kongre Merkezi', '10:00', '2025-04-30', 'https://indigodergisi.com/wp-content/uploads/2015/12/bilim-ve-teknology.jpg7_-e1451504217484.jpg', 1),
('Takım Çalışması Atölyesi', 'Verimli ekip çalışması için yöntemler ve uygulamalar.', 'non-technical', 'Ankara Ofisi', '14:30', '2025-05-03', 'https://enstitu.ibb.istanbul/files/ismekOrg/Image/img_brans/brans_yenisitegaleri/takim-calismasi/3.jpg', 1),
('Müzik Gecesi', 'Canlı performans ve networking etkinliği.', 'non-technical', 'İzmir Bahar Kampüsü', '19:00', '2025-05-10', 'https://cdn.iha.com.tr/Contents/images/2022/22/4791780.jpg', 1);

COMMIT;
