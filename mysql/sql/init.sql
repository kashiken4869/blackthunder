DROP SCHEMA IF EXISTS sns;
CREATE SCHEMA sns;
USE sns;

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- ホスト: db
-- 生成日時: 2022 年 5 月 29 日 14:08
-- サーバのバージョン： 8.0.29
-- PHP のバージョン: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `shukatsu`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int NOT NULL,
  `email` text NOT NULL,
  `login_password` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- テーブルのデータのダンプ `admin_login`
--

INSERT INTO `admin_login` (`id`, `email`, `login_password`) VALUES
(1, 'email@email', '$2y$10$4NDL25xbvDDnk/Xmgywluug.focPjCiGpgL8psMotMkyeX3YcA72G');

-- --------------------------------------------------------

--
-- テーブルの構造 `agents`
--

CREATE TABLE `agents` (
  `id` int NOT NULL,
  `corporate_name` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `insert_company_name` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `started_at` date DEFAULT NULL,
  `ended_at` date DEFAULT NULL,
  `login_email` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `login_pass` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `to_send_email` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `application_max` int NOT NULL,
  `charge` int NOT NULL,
  `client_name` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `client_department` text NOT NULL,
  `client_email` text NOT NULL,
  `client_tel` text NOT NULL,
  `insert_logo` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `insert_recommend_1` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `insert_recommend_2` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `insert_recommend_3` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `insert_handled_number` text NOT NULL,
  `list_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- テーブルのデータのダンプ `agents`
--

INSERT INTO `agents` (`id`, `corporate_name`, `insert_company_name`, `started_at`, `ended_at`, `login_email`, `login_pass`, `to_send_email`, `application_max`, `charge`, `client_name`, `client_department`, `client_email`, `client_tel`, `insert_logo`, `insert_recommend_1`, `insert_recommend_2`, `insert_recommend_3`, `insert_handled_number`, `list_status`) VALUES
(1, '株式会社キャリセン', 'キャリセン就活エージェント', '2022-05-01', '2022-06-11', 'kyari@kyari', '$2y$10$QukH2bY/MbYrD69UwYh8zu6LjSXF01m44Nu82H/4r4xf7Qt9cmuJu', 'kashiken@gmail.com', 7, 1000, '鹿島健太', '広報部', 'kirin.myk2018@gmail.com', '0809000300', '20220522060636_st-logo-careecen.png', '先輩利用者のES回答例や体験談もチェックできる', '初回から専任のコンサルタントと1.5時間じっくり面談', '累計6万人が利用してきた豊富な経験と実績', '1000', 3),
(2, '株式会社リクナビ ', 'リクナビ', '2022-05-19', '2022-06-11', 'rikunabi@rikunabi', '$2y$10$2VShvf6Hi23.EAmNepwxrObnY/EHASuF3VTM5mXjIVhwakfIzT/tK', 'rikunabi@rikunabi', 1000, 1000, 'rikunabi-sun', '営業部', 'rikunabi-sun@sun', '333', '20220522060246_rikunabi.jpg', '手厚い面接サポートあり', '全体の8割が文系学生のため、文系に合う職種を見つけられる', '週3～4回相談できるから不安を解消しやすい', '10000', 1),
(3, 'NaS株式会社', ' DiG UP CAREER', '2022-05-19', '2022-06-09', 'dig@dig', '$2y$10$ccOzfFRzDwrF/zXeyYjIhO54QNqNSw9i5dSSEpmtIrnAF/6MGKBou', 'dig@up', 50, 1000, '鹿島健太', 'カルチャー局', 'kashiken@kkkkkkk', '08011112222', '20220525090926_dig.png', '就活のプロ（元人事・人材会社出身）がLINEも使って親身に手厚いサポート', '企業選び・自己理解のプロによる就活セミナーが受けられ、理解が深まる', '就活生に寄り添ったサービス、満足度90%超！友人紹介も60%超！', '3000', 1),
(4, '株式会社meets company', 'meets company', '2022-05-19', '2022-06-11', 'meets@meets', '$2y$10$27loDXgCzBvWBaHLv2btyuuInKMTyF6Y7YpWsmOpOfqdd1/n5ilX2', 'meets@meets', 1000, 1000, 'meetsさん', '営業部', 'meets-sun@sun', '120', '20220522060525_meets.jpg', '年間1000回を超えるマッチングイベントを開催！', '東証一部上場企業からベンチャー企業まで豊富な企業数', '7拠点を中心に全国対応のため地方在住でも利用しやすい', '非公開', 1),
(5, '株式会社マイナビ', 'マイナビ新卒紹介', '2022-05-12', '2022-06-11', 'mainabi@mainabi', '$2y$10$Sc90axzgOw6CZhP6pinxG.kVZsfLO3CcCMbaNbMbSuXzNpqnBzTh6', 'mainabi@mainabi', 1000, 1000, '西山直輝', 'カルチャー局', 'naoki@kinketsu.co', '08011380033', '20220522062036_mainabi.jpg', '海外企業の理系職種もカバー', '採用基準や面接情報をほぼ全て把握	', 'ここにしかない非公開求人に出会いたい人におすすめ', '50000', 1),
(6, 'Leverages', 'キャリアチケット', '2022-05-01', '2022-05-28', 'tichet@tichet', '$2y$10$GJRafDdGOQAnE9uXfr1WK.qUoPN3SuwgKJYdjScdtlDr432ttIGaa', 'ticket@gmail.com', 400, 1000, 'テスト氏名', '部署名', 'ticket@gmail', '04022220000', '', 'エントリーシート（ES）の添削や面接対策を受けられる', '紹介企業を厳選。ブラック企業を避けられ、最短3日の内定実績もある', 'キャリアアドバイザーに無料で就活相談ができる', '4444', 2),
(7, '株式会社ネオキャリア', 'Neo', '2022-05-12', '2022-06-11', 'neo@neo', '$2y$10$IR7uaXqkFGOhChrOmDIegOgr..A6o7xiwF614KishGWslcijH.lKW', 'kashiken@ddddd', 1000, 1000, '鹿島健太', 'カルチャー局', 'kkkkk@co.jp', '08099999999', '20220526030357_neo.png', 'イニシャル課金の送客サービスあり。1名15,000円～', '体育会系出身の学生に特化したサポートを受けられる', 'ES添削の回数無制限', '10000', 1),
(8, 'レバテック株式会社', 'レバテック', '2022-05-10', '2022-06-11', 'leva@leva', '$2y$10$3ljD3l5qCEZTllfWvcnUzeHIEicE0uf/mXsWibNFAXNpnm8IMuuYe', 'leverages@co.jp', 1000, 1000, '西山直輝', 'カルチャー局', 'naoki@kinketsu.com', '08070707070', '20220525072023_leva2.jpg', 'レバテック登録者実績20万人', 'エンジニアが利用したい転職エージェントNo.1', '志望度の高い企業は現場社員との面談も可能', '5000', 1),
(67, 'Jobspirng株式会社', 'JobSpring', '2022-05-23', '2022-06-11', 'jobspring@jobspring', '$2y$10$y67K4aNtk9THkvFKczXDHeButjyiEGm3PDd1iTqntRTKNjKqxXaWe', 'jobspring@jobspring', 1000, 1000, 'jobさん', '営業部', 'job-sun@sun', '53266', '20220529014022_JobSpring_logo-min.png', '自己分析からの徹底サポートあり', '適性検査を活かしたAIマッチング', '内定後の定着率は88%', '8500', 1),
(68, 'Goodfindエージェント株式会社', 'Goodfind', '2022-05-28', '2022-06-11', 'goodfind@goodfind', '$2y$10$99pe1yJwvsOfT4pRbjGg1eZCJLdU0jh1zzSoVz0XMy5jBzOfAf/4.', 'good@good', 1000, 1000, 'goodfing-sun', '営業部', 'goodfind@sun', '3451', '20220529085804_2e7a276ffc67a456ff2bc06d75c0d2a0.png', 'ベンチャー企業の取扱企業数は日本一！', 'セミナーのレベルが非常に高く大好評', '徹底した面談サポートにより、内定率88%', '5600', 1),
(69, 'ツイング株式会社', 'ツイング', '2022-05-28', '2022-06-11', 'twing@twing', '$2y$10$b5EZDclmkV8P6EjXTeqeweG53hYfQe0ZKOkzUtdjtypjTEAYA5fhi', 'twing@a', 1000, 1000, 'twing-sun', '営業部', 'twing@sun', '22222', '20220529090317_og.png', '大手企業の元人事からES添削サポートあり', '相談回数は無制限！即返答！', '1 on 1の手厚い面接サポートあり', '8000', 1),
(70, 'duda株式会社', 'duda新卒エージェント', '2022-05-28', '2022-06-11', 'duda@duda', '$2y$10$OJFzz49XhwS//4LInbKOUeLb.5pYVgYYfzL/CCb9vxJhFQdIYDjIe', 'du@du', 1000, 5000, 'duda-sun', '営業部', 'duda@sun', '3233', '20220529091423_images.png', '選考のフィードバックがもらえる', '初回から専任のコンサルタントと1時間じっくり面談', 'ES添削、面接サポート受け放題！', '7500', 1);

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `introduce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `birthday`, `introduce`, `created_at`) 
VALUES (NULL, 'おのかンかん', 'kanta@gmail.com', 'onokan', 'onokan.jpg', '2022-07-05', '小野かんです', '2022-09-02 06:37:16.000000'), 
(NULL, 'プレゼン女王', 'kyomu@gmail.com', 'purezen', 'kyomu.jpg', '2022-09-23', 'プレゼンんしか勝たん。岩村さん推しです', '2022-09-02 06:37:16.000000'), 
(NULL, 'ponta', 'ponta@gmail.com', 'ponta', 'ponta.jpg', '2022-10-09', 'ポンタです', '2022-09-02 06:37:16.000000'), 
(NULL, 'レンちゃん', 'karen@gmail.com', 'karen', 'karen.jpg', '2022-08-12', 'どうも可憐でーす', '2022-09-02 06:37:16.000000'), 
(NULL, '菓子けん', 'kashiken@gmail.com', 'kashiken', 'kashiken.jpg', '2022-05-13', '過試験です', '2022-09-02 06:37:16.000000'), 
(NULL, 'ともちゃん', 'tomo@gmail.com', 'tomotomo', 'tomo.jpg', '2023-01-12', 'ともあきんぐ', '2022-09-02 06:37:16.000000');


DROP TABLE IF EXISTS posts;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `tag_id` int NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `user_id`, `tag_id`, `content`, `created_at`) 
VALUES (NULL, '1', '2', 'お酒飲みたーーーーい', '2022-09-02 06:44:17.000000'), 
(NULL, '3', '1', 'windowsしか勝たん', '2022-09-02 06:44:17.000000'), 
(NULL, '4', '1', 'カレー食べたい', '2022-09-02 06:44:17.000000'), 
(NULL, '2', '1', 'プレゼン頑張りたい', '2022-09-02 06:44:17.000000'), 
(NULL, '1', '1', 'マーケ曲調です', '2022-09-02 06:44:17.000000');


DROP TABLE IF EXISTS benches;
CREATE TABLE `benches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `benches` (`id`, `post_id`, `user_id`) VALUES 
(NULL, '1', '2'), (NULL, '3', '1'), (NULL, '4', '5'), 
(NULL, '4', '2'), (NULL, '3', '1'), (NULL, '2', '1');


DROP TABLE IF EXISTS comments;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `conmment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `conmment`, `created_at`) 
VALUES (NULL, '1', '2', '小野カン酒飲むな', '2022-09-02 06:48:25.000000'), 
(NULL, '1', '3', 'おのかん酒飲むな！', '2022-09-02 06:48:25.000000'), 
(NULL, '3', '5', '僕も食べたい！', '2022-09-02 06:48:25.000000'), 
(NULL, '2', '1', 'やっぱmac book proだよね', '2022-09-02 06:48:25.000000');

DROP TABLE IF EXISTS tags;
CREATE TABLE `tags` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `tag_name` TEXT NOT NULL , 
  `created_at` TIMESTAMP NOT NULL , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;

DROP TABLE IF EXISTS chat_room_user;
  CREATE TABLE `sns`.`chat_room_user` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `user_id` INT NOT NULL , 
    `chat_room_id` INT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;

DROP TABLE IF EXISTS chat_room;
  CREATE TABLE `sns`.`chat_room` (`id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)) ENGINE = InnoDB;

DROP TABLE IF EXISTS chat_message;
  CREATE TABLE `sns`.`chat_message` (
    `id` INT NOT NULL AUTO_INCREMENT ,
     `chat_room_id` INT NOT NULL ,
      `user_id` INT NOT NULL , 
      `message` TEXT NOT NULL , 
      `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;