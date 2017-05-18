

CREATE TABLE IF NOT EXISTS `RUSH0`.`U_GROUP`
(
	`ug_id` INT NOT NULL AUTO_INCREMENT,
    `ug_name` VARCHAR(256) NOT NULL,
	PRIMARY KEY (`ug_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `RUSH0`.`USER`
(
	`u_id` INT NOT NULL AUTO_INCREMENT,
	`u_group_id` INT NOT NULL,
	`u_login` VARCHAR(256) NOT NULL, 
	`u_password` VARCHAR(256) NOT NULL, 
	`u_email` VARCHAR(256) NOT NULL, 
	`u_adress` VARCHAR(256) NULL, 
	`u_zipcode` VARCHAR(256) NULL, 
	`u_city` VARCHAR(256) NULL,
	`u_country` VARCHAR(256) NULL,
	PRIMARY KEY (`u_id`),
	FOREIGN KEY (`u_group_id`) REFERENCES `U_GROUP`(`ug_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `RUSH0`.`P_BRAND`
(
	`pb_id` INT NOT NULL AUTO_INCREMENT,
	`pb_name` VARCHAR(256) NOT NULL,
	PRIMARY KEY (`pb_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `RUSH0`.`P_TYPE`
(
	`pt_id` INT NOT NULL AUTO_INCREMENT,
	`pt_name` VARCHAR(256) NOT NULL,
	PRIMARY KEY (`pt_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `RUSH0`.`PRODUCT`
(
	`p_id` INT NOT NULL AUTO_INCREMENT,
	`p_brand_id` INT NOT NULL, 
	`p_name` VARCHAR(256) NOT NULL,
	`p_type_id` INT NOT NULL,
	`p_price` FLOAT NOT NULL,
	`p_capacity` INT NOT NULL,
	`p_topspeed` FLOAT NULL,
	`p_acceleration` FLOAT NULL,
	`p_brake` FLOAT NULL,
	`p_traction` FLOAT NULL,
	`p_image` VARCHAR(256) NULL,
	PRIMARY KEY (`p_id`),
	FOREIGN KEY (`p_brand_id`) REFERENCES `P_BRAND`(`pb_id`),
	FOREIGN KEY (`p_type_id`) REFERENCES `P_TYPE`(`pt_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `RUSH0`.`ORDERS`
(
	`o_id` INT NOT NULL AUTO_INCREMENT,
	`o_user_id` INT NOT NULL,
	`o_product_id` INT NOT NULL,
	`o_color` VARCHAR(256) NOT NULL,
	`o_date` DATETIME NOT NULL,
	PRIMARY KEY (`o_id`),
	FOREIGN KEY (`o_user_id`) REFERENCES `USER`(`u_id`),
	FOREIGN KEY (`o_product_id`) REFERENCES `PRODUCT`(`p_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

INSERT INTO `U_GROUP` (`ug_id`, `ug_name`) VALUES
(1, 'Administrator'),
(2, 'User');


INSERT INTO `P_TYPE` (`pt_id`, `pt_name`) VALUES
(1, 'Supersport'),
(2, 'Coupe'),
(3, 'Motorcycle'),
(4, 'Muscle'),
(5, 'Off-Road'),
(6, 'Sedan'),
(7, 'Sport'),
(8, 'Classic'),
(9, 'SUV');

INSERT INTO `P_BRAND` (`pb_id`, `pb_name`) VALUES
(1, 'Truffade'),
(2, 'Albany'),
(3, 'Annis'),
(4, 'Benefactor'),
(5, 'Bravado'),
(6, 'Coil'),
(7, 'Declasse'),
(8, 'Dewbauchee'),
(9, 'Dinka'),
(10, 'Enus'),
(11, 'Gallivanter'),
(12, 'Grotti'),
(13, 'Hijak'),
(14, 'Imponte'),
(15, 'Invetero'),
(16, 'Lampadati'),
(17, 'Nagasaki'),
(18, 'Obey'),
(19, 'Overflod'),
(20, 'Pegassi'),
(21, 'Pfister'),
(22, 'Principe'),
(23, 'Progen'),
(24, 'Vapid');

INSERT INTO `PRODUCT` (`p_id`, `p_brand_id`, `p_name`, `p_type_id`, `p_price`, `p_capacity`, `p_topspeed`, `p_acceleration`, `p_brake`, `p_traction`, `p_image`) VALUES
(1, 1, 'Adder', 1, 1000000, 2, 4, 3.2, 2.4, 2.8, 'http://vignette2.wikia.nocookie.net/gtawiki/images/9/9e/Adder-GTAV-front.png/revision/latest/scale-to-width-down/270?cb=20160429175105'),
(2, 2, 'Alpha', 2, 150000, 2, 4.1, 4.25, 2.8, 3.98, 'http://vignette1.wikia.nocookie.net/gtawiki/images/9/94/Alpha-GTAV-front.png/revision/latest?cb=20150529155505'),
(3, 2, 'Roosevelt Valor', 8, 982000, 4, 3.8, 4, 1.5, 2.8, 'http://vignette2.wikia.nocookie.net/gtawiki/images/2/2a/RooseveltValor-GTAO-front.png/revision/latest/scale-to-width-down/270?cb=20160214204109'),
(4, 2, 'Virgo', 4, 195000, 2, 3.85, 3.5, 1.3, 4, 'http://vignette3.wikia.nocookie.net/gtawiki/images/2/24/Virgo-GTAV-front.png/revision/latest/scale-to-width-down/270?cb=20160302174203'),
(5, 3, 'Elegy RH8', 7, 100000, 2, 3.9, 4.4, 2.2, 3.8, 'http://vignette3.wikia.nocookie.net/gtawiki/images/4/4f/ElegyRH8-GTAV-front.png/revision/latest/scale-to-width-down/270?cb=20160525194616'),
(6, 4, 'Schafter LWB', 7, 208000, 4, 3.7, 3.9, 2.1, 3.8, 'http://vignette3.wikia.nocookie.net/gtawiki/images/2/22/SchafterLWB-GTAO-front.png/revision/latest/scale-to-width-down/270?cb=20151216172307'),
(7, 4, 'Schafter V12', 7, 116000, 4, 3.95, 4.1, 2, 3.65, 'http://vignette2.wikia.nocookie.net/gtawiki/images/a/a6/SchafterV12-GTAO-front.png/revision/latest/scale-to-width-down/270?cb=20151216172122'),
(8, 4, 'Stirling GT', 8, 975000, 2, 4.05, 3.65, 1.2, 3.2, 'http://vignette4.wikia.nocookie.net/gtawiki/images/1/17/StirlingGT-GTAV-Front.png/revision/latest/scale-to-width-down/270?cb=20150614114322'),
(9, 4, 'Surano', 7, 110000, 2, 3.5, 4, 2, 3.99, 'http://vignette4.wikia.nocookie.net/gtawiki/images/f/fd/SuranoDown-GTAV-front.png/revision/latest/scale-to-width-down/270?cb=20160305181513'),
(10, 4, 'Bravado XLS', 9, 253000, 4, 3.5, 3.2, 1.45, 3.5, 'http://vignette2.wikia.nocookie.net/gtawiki/images/8/8c/XLS-GTAO-front.png/revision/latest/scale-to-width-down/270?cb=20160609145148'),
(11, 5, 'Banshee', 7, 105000, 2, 4.05, 3.95, 2.15, 3.78, 'http://vignette4.wikia.nocookie.net/gtawiki/images/9/9e/BansheeTopless-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160118163245'),
(12, 5, 'Verlierer', 7, 695000, 2, 4.1, 4, 2.5, 4.1, 'http://vignette3.wikia.nocookie.net/gtawiki/images/8/8c/Verlierer-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20151216190603'),
(13, 6, 'Brawler', 5, 715000, 2, 3.75, 4.15, 2.55, 4.2, 'http://vignette1.wikia.nocookie.net/gtawiki/images/6/6c/Brawler-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151209200747'),
(14, 6, 'Voltic', 1, 150000, 2, 4.1, 4.5, 2.4, 4, 'http://vignette3.wikia.nocookie.net/gtawiki/images/8/87/Voltic-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151220122144'),
(15, 7, 'Mamba', 8, 995000, 2, 3.72, 3.98, 1.5, 3.2, 'http://vignette4.wikia.nocookie.net/gtawiki/images/d/d4/Mamba-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160117195426'),
(16, 8, 'Exemplar', 2, 205000, 2, 3.7, 3.8, 2.2, 3.95, 'http://vignette4.wikia.nocookie.net/gtawiki/images/d/de/Exemplar-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20150530112831'),
(17, 8, 'JB 700', 8, 475000, 2, 3.6, 3.5, 1, 3, 'http://vignette3.wikia.nocookie.net/gtawiki/images/7/70/JB700-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160409201623'),
(18, 8, 'Massacro', 7, 275000, 2, 3.8, 3.9, 2.5, 3.89, 'http://vignette2.wikia.nocookie.net/gtawiki/images/1/12/Massacro-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20150529201022'),
(19, 8, 'Rapid GT', 7, 132000, 2, 3.75, 3.8, 2.4, 3.8, 'http://vignette3.wikia.nocookie.net/gtawiki/images/4/42/RapidGT-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20150529203102'),
(20, 9, 'Jester', 7, 240000, 2, 4.09, 4, 2.9, 4.5, 'http://vignette2.wikia.nocookie.net/gtawiki/images/a/af/Jester-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20150530104402'),
(21, 9, 'Vindicator', 3, 63000, 2, 3.5, 3.7, 2.45, 3.95, 'http://vignette2.wikia.nocookie.net/gtawiki/images/5/5f/Vindicator-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160304215542'),
(22, 9, 'Thrust', 3, 75000, 2, 4.2, 4.55, 2.55, 4.05, 'http://vignette2.wikia.nocookie.net/gtawiki/images/4/4e/Thrust-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151214184401'),
(23, 10, 'Cognoscenti 55', 6, 154000, 4, 3.65, 3.82, 2.3, 3.7, 'http://vignette3.wikia.nocookie.net/gtawiki/images/b/b4/Cognoscenti55-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160117195125'),
(24, 10, 'Cognoscenti Cabrio', 2, 185000, 2, 3.7, 3.9, 2.5, 3.89, 'http://vignette1.wikia.nocookie.net/gtawiki/images/4/41/EnusCognoscentiCabrio-Front1-GTAV.png/revision/latest/scale-to-width-down/220?cb=20140405102206'),
(25, 10, 'Huntley S', 9, 195000, 4, 3.3, 3.4, 1.9, 3.59, 'http://vignette3.wikia.nocookie.net/gtawiki/images/2/2f/HuntleyS-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160125184521'),
(26, 10, 'Super Diamond', 6, 250000, 4, 3.7, 3.5, 2.3, 3.86, 'http://vignette3.wikia.nocookie.net/gtawiki/images/d/d8/SuperDiamond-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160409182331'),
(27, 11, 'Baller LE', 9, 149000, 4, 3.55, 3.64, 2.12, 3.75, 'http://vignette3.wikia.nocookie.net/gtawiki/images/7/71/BallerLE-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160117194728'),
(28, 11, 'Baller LE LWB', 9, 274000, 4, 3.5, 3.2, 1.95, 3.7, 'http://vignette2.wikia.nocookie.net/gtawiki/images/3/3c/BallerLELWB-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160117194751'),
(29, 12, 'Bestia GTS', 7, 610000, 2, 3.85, 4.05, 2.35, 3.9, 'http://vignette1.wikia.nocookie.net/gtawiki/images/a/a5/BestiaGTS-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160609145338'),
(30, 12, 'Cheetah', 1, 650000, 2, 4.2, 4.6, 3, 4.4, 'http://vignette1.wikia.nocookie.net/gtawiki/images/1/1e/Cheetah-GTAV-Front.png/revision/latest/scale-to-width-down/220?cb=20151212234903'),
(31, 13, 'Khamelion', 7, 100000, 2, 3.8, 3.8, 2.4, 3.8, 'http://vignette4.wikia.nocookie.net/gtawiki/images/7/75/Khamelion-GTAV-Front.png/revision/latest/scale-to-width-down/220?cb=20140226130734'),
(32, 14, 'Nightshade', 4, 585000, 2, 3.75, 3.8, 2.05, 3.4, 'http://vignette3.wikia.nocookie.net/gtawiki/images/3/3e/Nightshade-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20151216172405'),
(33, 15, 'Coquette', 7, 138000, 2, 3.99, 4.09, 2.19, 3.99, 'http://vignette4.wikia.nocookie.net/gtawiki/images/0/08/Coquette-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160429175114'),
(34, 15, 'Coquette BlackFin', 4, 695000, 2, 3.4, 3.5, 1.8, 3.2, 'http://vignette2.wikia.nocookie.net/gtawiki/images/d/df/CoquetteBlackFin-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151209200911'),
(35, 15, 'Coquette Classic', 8, 665000, 2, 3.5, 3.6, 2.05, 3.4, 'http://vignette3.wikia.nocookie.net/gtawiki/images/0/0b/CoquetteClassic-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160117175931'),
(36, 16, 'Furore GT', 7, 448000, 2, 3.9, 4.2, 2.25, 3.68, 'http://vignette4.wikia.nocookie.net/gtawiki/images/5/56/FuroreGT-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160302175246'),
(37, 17, 'Carbon RS', 3, 40000, 2, 3.95, 4.5, 3, 4.1, 'http://vignette2.wikia.nocookie.net/gtawiki/images/2/2d/CarbonRS-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160130214329'),
(40, 18, '9F', 7, 120000, 2, 3.65, 3.85, 2.44, 3.78, 'http://vignette1.wikia.nocookie.net/gtawiki/images/2/2d/9F-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20150529201705'),
(41, 19, 'Entity XF', 1, 795000, 2, 4.6, 4.7, 3.5, 4.4, 'http://vignette3.wikia.nocookie.net/gtawiki/images/9/95/EntityXF-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160308182421'),
(42, 20, 'Infernus', 1, 440000, 2, 4.3, 4.3, 2.9, 4.15, 'http://vignette1.wikia.nocookie.net/gtawiki/images/0/0e/Infernus-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160429175116'),
(43, 20, 'Osiris', 1, 1950000, 2, 4.9, 5, 3.8, 4.5, 'http://vignette1.wikia.nocookie.net/gtawiki/images/f/f3/Osiris-GTAV-Front.png/revision/latest/scale-to-width-down/220?cb=20150614104749'),
(44, 20, 'Reaper', 1, 1595000, 2, 4.6, 4.55, 3.8, 4.3, 'http://vignette2.wikia.nocookie.net/gtawiki/images/5/5f/Reaper-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160609145529'),
(45, 20, 'Zentorno', 1, 750000, 2, 4.61, 4.56, 3.81, 4.31, 'http://vignette3.wikia.nocookie.net/gtawiki/images/6/60/Zentorno-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160302171211'),
(46, 21, 'Comet', 7, 100000, 2, 3.85, 3.95, 2.6, 3.65, 'http://vignette1.wikia.nocookie.net/gtawiki/images/d/d2/Comet-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151214183103'),
(47, 22, 'Lectro', 3, 750000, 2, 4.5, 5, 2.95, 4.01, 'http://vignette1.wikia.nocookie.net/gtawiki/images/d/de/Lectro-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160302174105'),
(48, 23, 'T20', 1, 2200000, 2, 4.95, 4.9, 4.1, 4.6, 'http://vignette2.wikia.nocookie.net/gtawiki/images/2/20/T20-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151209200946'),
(49, 1, 'Z-Type', 8, 10000000, 2, 4.4, 4.35, 2, 3.3, 'http://vignette2.wikia.nocookie.net/gtawiki/images/9/9d/Z-Type-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160409201433'),
(50, 24, 'Bullet', 1, 155000, 2, 4.15, 4.21, 2.35, 3.69, 'http://vignette2.wikia.nocookie.net/gtawiki/images/3/3d/Bullet-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20160409171354'),
(51, 24, 'Chino', 4, 225000, 2, 3.45, 3.61, 1.95, 2.9, 'http://vignette1.wikia.nocookie.net/gtawiki/images/1/17/Chino-GTAV-front.png/revision/latest/scale-to-width-down/220?cb=20151209200837'),
(52, 24, 'FMJ', 1, 1750000, 2, 4.95, 4.95, 4.2, 4.45, 'http://vignette2.wikia.nocookie.net/gtawiki/images/8/8c/FMJ-GTAO-front.png/revision/latest/scale-to-width-down/220?cb=20160609145432'),
(53, 24, 'Hotknife', 4, 90000, 2, 3.48, 3.75, 1.85, 3.1, 'http://vignette1.wikia.nocookie.net/gtawiki/images/c/c8/Hotknife-GTAV-Front.png/revision/latest/scale-to-width-down/220?cb=20140226130517');

INSERT INTO `user` (`u_id`, `u_group_id`, `u_login`, `u_password`, `u_email`, `u_adress`, `u_zipcode`, `u_city`, `u_country`) VALUES
(4, 1, 'admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 'admin@admin.php', NULL, NULL, NULL, NULL),
(5, 2, 'root', '06948d93cd1e0855ea37e75ad516a250d2d0772890b073808d831c438509190162c0d890b17001361820cffc30d50f010c387e9df943065aa8f4e92e63ff060c', 'qwe@bob.fr', 'qwe@bob.fr', '43210', 'adsf', 'asdf'),
(8, 2, 'Hello', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', 'dq@dq.fr', '32 v', '23456', 'bob', 'joe'),
(9, 2, '123', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f', '123@joe.com', '123 f', '12345', 'ert', 'fre');