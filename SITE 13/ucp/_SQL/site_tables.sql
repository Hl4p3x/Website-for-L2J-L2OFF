ALTER TABLE accounts ADD email varchar(100) NOT NULL DEFAULT '';
ALTER TABLE accounts ADD created_time int(11) DEFAULT NULL;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE site_balance (
  account varchar(16) NOT NULL,
  saldo int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_banners (
  bid int(10) NOT NULL AUTO_INCREMENT,
  imgurl_pt varchar(40) NOT NULL,
  imgurl_en varchar(40) DEFAULT NULL,
  imgurl_es varchar(40) DEFAULT NULL,
  pos tinyint(2) NOT NULL DEFAULT '1',
  link varchar(255) DEFAULT NULL,
  target tinyint(1) NOT NULL DEFAULT '1',
  vis tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (bid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE site_bosses (
  id smallint(5) unsigned NOT NULL,
  name varchar(200) NOT NULL DEFAULT '',
  level tinyint(2) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_donations (
  protocolo int(10) NOT NULL AUTO_INCREMENT,
  account varchar(30) NOT NULL,
  personagem int(11) DEFAULT NULL,
  quant_coins int(10) NOT NULL,
  coins_bonus int(10) NOT NULL DEFAULT '0',
  coins_entregues int(10) NOT NULL DEFAULT '0',
  valor decimal(11,2) NOT NULL,
  price decimal(11,2) NOT NULL,
  currency varchar(3) NOT NULL,
  metodo_pgto varchar(50) NOT NULL,
  status tinyint(1) NOT NULL DEFAULT '1',
  status_real varchar(40) DEFAULT NULL,
  data int(11) NOT NULL,
  ultima_alteracao int(11) DEFAULT NULL,
  transaction_code varchar(255) DEFAULT NULL,
  PRIMARY KEY (protocolo)
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

CREATE TABLE site_emailchange (
  account varchar(30) NOT NULL,
  newemail varchar(100) NOT NULL,
  code varchar(32) NOT NULL,
  date int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_forgotpass (
  account varchar(120) NOT NULL,
  code varchar(32) NOT NULL,
  date int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_gallery (
  gid int(11) NOT NULL AUTO_INCREMENT,
  url varchar(40) NOT NULL,
  pos smallint(5) NOT NULL DEFAULT '1',
  isvideo tinyint(1) NOT NULL DEFAULT '0',
  vis tinyint(1) NOT NULL DEFAULT '1',
  sent_by varchar(50) DEFAULT NULL,
  sent_date int(11) DEFAULT NULL,
  PRIMARY KEY (gid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE site_log_admin (
  log_value varchar(255) NOT NULL,
  log_ip varchar(20) NOT NULL,
  log_date datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_log_transfercoins (
  quantidade int(11) NOT NULL,
  remetente varchar(30) NOT NULL,
  destinatario varchar(30) NOT NULL,
  destinatario_char int(11) NOT NULL,
  tdata datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_log_convertcoins (
  quantidade int(11) NOT NULL,
  account varchar(50) NOT NULL,
  destinatario varchar(30) NOT NULL,
  cdata datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_news (
  nid int(11) NOT NULL AUTO_INCREMENT,
  img varchar(40) DEFAULT NULL,
  post_date int(11) NOT NULL,
  vis tinyint(1) NOT NULL DEFAULT '0',
  title_pt varchar(150) NOT NULL,
  title_en varchar(150) DEFAULT NULL,
  title_es varchar(150) DEFAULT NULL,
  content_pt text NOT NULL,
  content_en text,
  content_es text,
  PRIMARY KEY (nid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE site_reg_code (
  account varchar(30) NOT NULL,
  code varchar(32) NOT NULL,
  date int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE site_ucp_lastlogins (
  login varchar(45) NOT NULL,
  ip varchar(15) NOT NULL,
  logdate int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO site_banners VALUES ('1', '98a67ae9af1f9547003bc7b8ae33dd07.jpg', '98a67ae9af1f9547003bc7b8ae33dd07_en.jpg', '98a67ae9af1f9547003bc7b8ae33dd07_es.jpg', '2', '?page=register', '0', '1');
INSERT INTO site_bosses VALUES ('25001', 'Greyclaw Kutus', '23');
INSERT INTO site_bosses VALUES ('25004', 'Turek Mercenary Captain', '30');
INSERT INTO site_bosses VALUES ('25007', 'Retreat Spider Cletu', '42');
INSERT INTO site_bosses VALUES ('25010', 'Furious Thieles', '55');
INSERT INTO site_bosses VALUES ('25013', 'Ghost of Peasant Leader', '50');
INSERT INTO site_bosses VALUES ('25016', 'The 3rd Underwater Guardian', '60');
INSERT INTO site_bosses VALUES ('25019', 'Pan Dryad', '25');
INSERT INTO site_bosses VALUES ('25020', 'Breka Warlock Pastu', '34');
INSERT INTO site_bosses VALUES ('25023', 'Stakato Queen Zyrnna', '34');
INSERT INTO site_bosses VALUES ('25026', 'Katu Van Leader Atui', '49');
INSERT INTO site_bosses VALUES ('25029', 'Atraiban', '53');
INSERT INTO site_bosses VALUES ('25032', 'Eva\'s Guardian Millenu', '58');
INSERT INTO site_bosses VALUES ('25035', 'Shilen\'s Messenger Cabrio', '70');
INSERT INTO site_bosses VALUES ('25038', 'Tirak', '28');
INSERT INTO site_bosses VALUES ('25041', 'Remmel', '35');
INSERT INTO site_bosses VALUES ('25044', 'Barion', '47');
INSERT INTO site_bosses VALUES ('25047', 'Karte', '49');
INSERT INTO site_bosses VALUES ('25050', 'Verfa', '51');
INSERT INTO site_bosses VALUES ('25051', 'Rahha', '65');
INSERT INTO site_bosses VALUES ('25054', 'Kernon', '75');
INSERT INTO site_bosses VALUES ('25057', 'Biconne of Blue Sky', '45');
INSERT INTO site_bosses VALUES ('25060', 'Unrequited Kael', '24');
INSERT INTO site_bosses VALUES ('25063', 'Chertuba of Great Soul', '35');
INSERT INTO site_bosses VALUES ('25064', 'Wizard of Storm Teruk', '40');
INSERT INTO site_bosses VALUES ('25067', 'Captain of Red Flag Shaka', '52');
INSERT INTO site_bosses VALUES ('25070', 'Enchanted Forest Watcher Ruell', '55');
INSERT INTO site_bosses VALUES ('25073', 'Bloody Priest Rudelto', '69');
INSERT INTO site_bosses VALUES ('25076', 'Princess Molrang', '25');
INSERT INTO site_bosses VALUES ('25079', 'Cat\'s Eye Bandit', '30');
INSERT INTO site_bosses VALUES ('25082', 'Leader of Cat Gang', '39');
INSERT INTO site_bosses VALUES ('25085', 'Timak Orc Chief Ranger', '44');
INSERT INTO site_bosses VALUES ('25088', 'Crazy Mechanic Golem', '43');
INSERT INTO site_bosses VALUES ('25089', 'Soulless Wild Boar', '59');
INSERT INTO site_bosses VALUES ('25092', 'Korim', '70');
INSERT INTO site_bosses VALUES ('25095', 'Elf Renoa', '29');
INSERT INTO site_bosses VALUES ('25098', 'Sejarr\'s Servitor', '35');
INSERT INTO site_bosses VALUES ('25099', 'Rotten Tree Repiro', '44');
INSERT INTO site_bosses VALUES ('25102', 'Shacram', '45');
INSERT INTO site_bosses VALUES ('25103', 'Sorcerer Isirr', '55');
INSERT INTO site_bosses VALUES ('25106', 'Ghost of the Well Lidia', '60');
INSERT INTO site_bosses VALUES ('25109', 'Antharas Priest Cloe', '74');
INSERT INTO site_bosses VALUES ('25112', 'Agent of Beres Meana', '30');
INSERT INTO site_bosses VALUES ('25115', 'Icarus Sample 1', '40');
INSERT INTO site_bosses VALUES ('25118', 'Guilotine Warden of the Execution Grounds', '35');
INSERT INTO site_bosses VALUES ('25119', 'Messenger of Fairy Queen Berun', '50');
INSERT INTO site_bosses VALUES ('25122', 'Refugee Hopeful Leo', '56');
INSERT INTO site_bosses VALUES ('25125', 'Fierce Tiger King Angel', '65');
INSERT INTO site_bosses VALUES ('25126', 'Longhorn Golkonda', '79');
INSERT INTO site_bosses VALUES ('25127', 'Langk Matriarch Rashkos', '24');
INSERT INTO site_bosses VALUES ('25128', 'Vuku Grand Seer Gharmash', '33');
INSERT INTO site_bosses VALUES ('25131', 'Carnage Lord Gato', '50');
INSERT INTO site_bosses VALUES ('25134', 'Leto Chief Talkin', '40');
INSERT INTO site_bosses VALUES ('25137', 'Beleth\'s Seer Sephia', '55');
INSERT INTO site_bosses VALUES ('25140', 'Hekaton Prime', '65');
INSERT INTO site_bosses VALUES ('25143', 'Fire of Wrath Shuriel', '78');
INSERT INTO site_bosses VALUES ('25146', 'Serpent Demon Bifrons', '21');
INSERT INTO site_bosses VALUES ('25149', 'Zombie Lord Crowl', '25');
INSERT INTO site_bosses VALUES ('25152', 'Flame Lord Shadar', '35');
INSERT INTO site_bosses VALUES ('25155', 'Shaman King Selu', '40');
INSERT INTO site_bosses VALUES ('25158', 'King Tarlk', '48');
INSERT INTO site_bosses VALUES ('25159', 'Paniel the Unicorn', '54');
INSERT INTO site_bosses VALUES ('25162', 'Giant Marpanak', '60');
INSERT INTO site_bosses VALUES ('25163', 'Roaring Skylancer', '70');
INSERT INTO site_bosses VALUES ('25166', 'Ikuntai', '25');
INSERT INTO site_bosses VALUES ('25169', 'Ragraman', '30');
INSERT INTO site_bosses VALUES ('25170', 'Lizardmen Leader Hellion', '38');
INSERT INTO site_bosses VALUES ('25173', 'Tiger King Karuta', '45');
INSERT INTO site_bosses VALUES ('25176', 'Black Lily', '55');
INSERT INTO site_bosses VALUES ('25179', 'Guardian of the Statue of Giant Karum', '60');
INSERT INTO site_bosses VALUES ('25182', 'Demon Kurikups', '59');
INSERT INTO site_bosses VALUES ('25185', 'Tasaba Patriarch Hellena', '35');
INSERT INTO site_bosses VALUES ('25188', 'Apepi', '30');
INSERT INTO site_bosses VALUES ('25189', 'Cronos\'s Servitor Mumu', '34');
INSERT INTO site_bosses VALUES ('25192', 'Earth Protector Panathen', '43');
INSERT INTO site_bosses VALUES ('25198', 'Fafurion\'s Herald Lokness', '70');
INSERT INTO site_bosses VALUES ('25199', 'Water Dragon Seer Sheshark', '72');
INSERT INTO site_bosses VALUES ('25202', 'Krokian Padisha Sobekk', '74');
INSERT INTO site_bosses VALUES ('25205', 'Ocean Flame Ashakiel', '76');
INSERT INTO site_bosses VALUES ('25208', 'Water Couatle Ateka', '40');
INSERT INTO site_bosses VALUES ('25211', 'Sebek', '36');
INSERT INTO site_bosses VALUES ('25214', 'Fafurion\'s Page Sika', '40');
INSERT INTO site_bosses VALUES ('25217', 'Cursed Clara', '50');
INSERT INTO site_bosses VALUES ('25220', 'Death Lord Hallate', '73');
INSERT INTO site_bosses VALUES ('25223', 'Soul Collector Acheron', '35');
INSERT INTO site_bosses VALUES ('25226', 'Roaring Lord Kastor', '62');
INSERT INTO site_bosses VALUES ('25229', 'Storm Winged Naga', '75');
INSERT INTO site_bosses VALUES ('25230', 'Timak Seer Ragoth', '57');
INSERT INTO site_bosses VALUES ('25233', 'Spirit of Andras the Betrayer', '69');
INSERT INTO site_bosses VALUES ('25234', 'Ancient Weird Drake', '60');
INSERT INTO site_bosses VALUES ('25235', 'Vanor Chief Kandra', '72');
INSERT INTO site_bosses VALUES ('25238', 'Abyss Brukunt', '59');
INSERT INTO site_bosses VALUES ('25241', 'Harit Hero Tamash', '55');
INSERT INTO site_bosses VALUES ('25244', 'Last Lesser Giant Olkuth', '75');
INSERT INTO site_bosses VALUES ('25245', 'Last Lesser Giant Glaki', '78');
INSERT INTO site_bosses VALUES ('25248', 'Doom Blade Tanatos', '72');
INSERT INTO site_bosses VALUES ('25249', 'Palatanos of Horrific Power', '75');
INSERT INTO site_bosses VALUES ('25252', 'Palibati Queen Themis', '70');
INSERT INTO site_bosses VALUES ('25255', 'Gargoyle Lord Tiphon', '65');
INSERT INTO site_bosses VALUES ('25256', 'Taik High Prefect Arak', '60');
INSERT INTO site_bosses VALUES ('25259', 'Zaken\'s Butcher Krantz', '55');
INSERT INTO site_bosses VALUES ('25260', 'Iron Giant Totem', '45');
INSERT INTO site_bosses VALUES ('25263', 'Kernon\'s Faithful Servant Kelone', '67');
INSERT INTO site_bosses VALUES ('25266', 'Bloody Empress Decarbia', '75');
INSERT INTO site_bosses VALUES ('25269', 'Beast Lord Behemoth', '70');
INSERT INTO site_bosses VALUES ('25272', 'Partisan Leader Talakin', '28');
INSERT INTO site_bosses VALUES ('25276', 'Death Lord Ipos', '75');
INSERT INTO site_bosses VALUES ('25277', 'Lilith\'s Witch Marilion', '50');
INSERT INTO site_bosses VALUES ('25280', 'Pagan Watcher Cerberon', '55');
INSERT INTO site_bosses VALUES ('25281', 'Anakim\'s Nemesis Zakaron', '70');
INSERT INTO site_bosses VALUES ('25282', 'Death Lord Shax', '75');
INSERT INTO site_bosses VALUES ('25290', 'Daimon the White-Eyed', '78');
INSERT INTO site_bosses VALUES ('25293', 'Hestia Guardian Deity of the Hot Springs', '78');
INSERT INTO site_bosses VALUES ('25296', 'Icicle Emperor Bumbalump', '74');
INSERT INTO site_bosses VALUES ('25299', 'Ketra\'s Hero Hekaton', '80');
INSERT INTO site_bosses VALUES ('25302', 'Ketra\'s Commander Tayr', '80');
INSERT INTO site_bosses VALUES ('25305', 'Ketra\'s Chief Brakki', '80');
INSERT INTO site_bosses VALUES ('25306', 'Soul of Fire Nastron', '80');
INSERT INTO site_bosses VALUES ('25309', 'Varka\'s Hero Shadith', '80');
INSERT INTO site_bosses VALUES ('25312', 'Varka\'s Commander Mos', '80');
INSERT INTO site_bosses VALUES ('25315', 'Varka\'s Chief Horus', '80');
INSERT INTO site_bosses VALUES ('25316', 'Soul of Water Ashutar', '80');
INSERT INTO site_bosses VALUES ('25319', 'Ember', '80');
INSERT INTO site_bosses VALUES ('25322', 'Demon\'s Agent Falston', '66');
INSERT INTO site_bosses VALUES ('25325', 'Flame of Splendor Barakiel', '70');
INSERT INTO site_bosses VALUES ('25328', 'Eilhalder von Hellmann', '71');
INSERT INTO site_bosses VALUES ('25352', 'Giant Wasteland Basilisk', '30');
INSERT INTO site_bosses VALUES ('25354', 'Gargoyle Lord Sirocco', '35');
INSERT INTO site_bosses VALUES ('25357', 'Sukar Wererat Chief', '21');
INSERT INTO site_bosses VALUES ('25360', 'Tiger Hornet', '26');
INSERT INTO site_bosses VALUES ('25362', 'Tracker Leader Sharuk', '23');
INSERT INTO site_bosses VALUES ('25365', 'Patriarch Kuroboros', '26');
INSERT INTO site_bosses VALUES ('25366', 'Kuroboros\' Priest', '23');
INSERT INTO site_bosses VALUES ('25369', 'Soul Scavenger', '25');
INSERT INTO site_bosses VALUES ('25372', 'Discarded Guardian', '20');
INSERT INTO site_bosses VALUES ('25373', 'Malex Herald of Dagoniel', '21');
INSERT INTO site_bosses VALUES ('25375', 'Zombie Lord Farakelsus', '20');
INSERT INTO site_bosses VALUES ('25378', 'Madness Beast', '20');
INSERT INTO site_bosses VALUES ('25380', 'Kaysha Herald of Icarus', '21');
INSERT INTO site_bosses VALUES ('25383', 'Revenant of Sir Calibus', '34');
INSERT INTO site_bosses VALUES ('25385', 'Evil Spirit Tempest', '36');
INSERT INTO site_bosses VALUES ('25388', 'Red Eye Captain Trakia', '35');
INSERT INTO site_bosses VALUES ('25391', 'Nurka\'s Messenger', '33');
INSERT INTO site_bosses VALUES ('25392', 'Captain of Queen\'s Royal Guards', '32');
INSERT INTO site_bosses VALUES ('25394', 'Premo Prime', '38');
INSERT INTO site_bosses VALUES ('25395', 'Archon Suscepter', '45');
INSERT INTO site_bosses VALUES ('25398', 'Eye of Beleth', '35');
INSERT INTO site_bosses VALUES ('25401', 'Skyla', '32');
INSERT INTO site_bosses VALUES ('25404', 'Corsair Captain Kylon', '33');
INSERT INTO site_bosses VALUES ('25407', 'Lord Ishka', '60');
INSERT INTO site_bosses VALUES ('25410', 'Road Scavenger Leader', '40');
INSERT INTO site_bosses VALUES ('25412', 'Necrosentinel Royal Guard', '47');
INSERT INTO site_bosses VALUES ('25415', 'Nakondas', '40');
INSERT INTO site_bosses VALUES ('25418', 'Dread Avenger Kraven', '44');
INSERT INTO site_bosses VALUES ('25420', 'Orfen\'s Handmaiden', '48');
INSERT INTO site_bosses VALUES ('25423', 'Fairy Queen Timiniel', '61');
INSERT INTO site_bosses VALUES ('25426', 'Betrayer of Urutu Freki', '25');
INSERT INTO site_bosses VALUES ('25429', 'Mammon Collector Talos', '25');
INSERT INTO site_bosses VALUES ('25431', 'Flamestone Golem', '44');
INSERT INTO site_bosses VALUES ('25434', 'Bandit Leader Barda', '55');
INSERT INTO site_bosses VALUES ('25437', 'Timak Orc Gosmos', '45');
INSERT INTO site_bosses VALUES ('25438', 'Thief Kelbar', '44');
INSERT INTO site_bosses VALUES ('25441', 'Evil Spirit Cyrion', '45');
INSERT INTO site_bosses VALUES ('25444', 'Enmity Ghost Ramdal', '65');
INSERT INTO site_bosses VALUES ('25447', 'Immortal Savior Mardil', '71');
INSERT INTO site_bosses VALUES ('25450', 'Cherub Galaxia', '79');
INSERT INTO site_bosses VALUES ('25453', 'Meanas Anor', '70');
INSERT INTO site_bosses VALUES ('25456', 'Mirror of Oblivion', '49');
INSERT INTO site_bosses VALUES ('25460', 'Deadman Ereve', '51');
INSERT INTO site_bosses VALUES ('25463', 'Harit Guardian Garangky', '56');
INSERT INTO site_bosses VALUES ('25467', 'Gorgolos', '64');
INSERT INTO site_bosses VALUES ('25470', 'Last Titan Utenus', '66');
INSERT INTO site_bosses VALUES ('25473', 'Grave Robber Kim', '52');
INSERT INTO site_bosses VALUES ('25475', 'Ghost Knight Kabed', '55');
INSERT INTO site_bosses VALUES ('25478', 'Shilen\'s Priest Hisilrome', '65');
INSERT INTO site_bosses VALUES ('25481', 'Magus Kenishee', '53');
INSERT INTO site_bosses VALUES ('25484', 'Zaken\'s Chief Mate Tillion', '50');
INSERT INTO site_bosses VALUES ('25487', 'Water Spirit Lian', '40');
INSERT INTO site_bosses VALUES ('25490', 'Gwindorr', '40');
INSERT INTO site_bosses VALUES ('25493', 'Eva\'s Spirit Niniel', '55');
INSERT INTO site_bosses VALUES ('25496', 'Fafurion\'s Envoy Pingolpin', '52');
INSERT INTO site_bosses VALUES ('25498', 'Fafurion\'s Henchman Istary', '45');
INSERT INTO site_bosses VALUES ('25501', 'Boss Akata', '30');
INSERT INTO site_bosses VALUES ('25504', 'Nellis\' Vengeful Spirit', '39');
INSERT INTO site_bosses VALUES ('25506', 'Rayito the Looter', '37');
INSERT INTO site_bosses VALUES ('25509', 'Dark Shaman Varangka', '53');
INSERT INTO site_bosses VALUES ('25512', 'Gigantic Chaos Golem', '52');
INSERT INTO site_bosses VALUES ('25514', 'Queen Shyeed', '80');
INSERT INTO site_bosses VALUES ('25523', 'Plague Golem', '73');
INSERT INTO site_bosses VALUES ('25524', 'Flamestone Giant', '76');
INSERT INTO site_bosses VALUES ('25527', 'Uruka', '80');
INSERT INTO site_bosses VALUES ('25544', 'Tully', '83');
INSERT INTO site_bosses VALUES ('25603', 'Darion', '84');
INSERT INTO site_bosses VALUES ('25623', 'Valdstone', '80');
INSERT INTO site_bosses VALUES ('25624', 'Rok', '80');
INSERT INTO site_bosses VALUES ('25625', 'Enira', '80');
INSERT INTO site_bosses VALUES ('25671', 'Queen Shyeed', '84');
INSERT INTO site_bosses VALUES ('25674', 'Gwindorr', '83');
INSERT INTO site_bosses VALUES ('25677', 'Water Spirit Lian', '84');
INSERT INTO site_bosses VALUES ('25680', 'Giant Marpanak', '82');
INSERT INTO site_bosses VALUES ('25681', 'Gorgolos', '82');
INSERT INTO site_bosses VALUES ('25684', 'Last Titan Utenus', '83');
INSERT INTO site_bosses VALUES ('25696', 'Taklacan', '85');
INSERT INTO site_bosses VALUES ('25697', 'Torumba', '85');
INSERT INTO site_bosses VALUES ('25698', 'Dopagen', '85');
INSERT INTO site_bosses VALUES ('25701', 'Anays', '84');
INSERT INTO site_bosses VALUES ('25725', 'Drake Lord', '85');
INSERT INTO site_bosses VALUES ('25726', 'Behemoth Leader', '85');
INSERT INTO site_bosses VALUES ('25727', 'Dragon Beast', '85');
INSERT INTO site_bosses VALUES ('29001', 'Queen Ant', '40');
INSERT INTO site_bosses VALUES ('29006', 'Core', '50');
INSERT INTO site_bosses VALUES ('29014', 'Orfen', '50');
INSERT INTO site_bosses VALUES ('29019', 'Antharas', '85');
INSERT INTO site_bosses VALUES ('29020', 'Baium', '75');
INSERT INTO site_bosses VALUES ('29022', 'Zaken', '60');
INSERT INTO site_bosses VALUES ('29028', 'Valakas', '85');
INSERT INTO site_bosses VALUES ('29030', 'Fenril Hound Kerinne', '84');
INSERT INTO site_bosses VALUES ('29033', 'Fenril Hound Freki', '84');
INSERT INTO site_bosses VALUES ('29036', 'Fenril Hound Uruz', '84');
INSERT INTO site_bosses VALUES ('29037', 'Fenril Hound Kinaz', '84');
INSERT INTO site_bosses VALUES ('29040', 'Wings of Flame Ixion', '84');
INSERT INTO site_bosses VALUES ('29045', 'Frintezza', '85');
INSERT INTO site_bosses VALUES ('29046', 'Scarlet van Halisha', '85');
INSERT INTO site_bosses VALUES ('29047', 'Scarlet van Halisha', '85');
INSERT INTO site_bosses VALUES ('29060', 'Captain of the Ice Queen\'s Royal Guard', '59');
INSERT INTO site_bosses VALUES ('29062', 'Andreas Van Halter', '80');
INSERT INTO site_bosses VALUES ('29065', 'Sailren', '80');
INSERT INTO site_bosses VALUES ('29068', 'Antharas', '85');
INSERT INTO site_bosses VALUES ('29095', 'Gordon', '80');
INSERT INTO site_bosses VALUES ('29099', 'Baylor', '83');
INSERT INTO site_bosses VALUES ('29118', 'Beleth', '83');
INSERT INTO site_gallery VALUES ('1', 'YGpZnIakNHE', '1', '1', '1', null, null);
INSERT INTO site_gallery VALUES ('2', '4K640l4ogK4', '2', '1', '1', null, null);
INSERT INTO site_gallery VALUES ('3', 'TQvDgJJ4D-s', '3', '1', '1', null, null);
INSERT INTO site_gallery VALUES ('4', 'i5NI2FvE6RQ', '4', '1', '1', null, null);
INSERT INTO site_gallery VALUES ('5', 'pnajfOQLW0g', '5', '1', '1', null, null);
INSERT INTO site_gallery VALUES ('6', 'gXEJ3FxOlic', '6', '1', '1', null, null);
INSERT INTO site_news VALUES ('1', '1.jpg', '1435654140', '1', 'Lorem ipsum dolor sit amet', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis id justo sit amet turpis auctor iaculis quis vitae neque. Proin bibendum egestas felis nec facilisis. Morbi condimentum commodo pharetra. Morbi dictum tempus lacus sit amet dignissim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut sed arcu at arcu auctor tincidunt non non nisl. Nulla sit amet dui orci. Donec elementum maximus mattis. Vestibulum nec eleifend arcu. Sed molestie quis turpis vel placerat. Nam eu nisi vitae lorem imperdiet faucibus vitae id dolor. In porta ut nisi vel bibendum. Integer vitae turpis arcu. Integer ut nunc euismod, mollis magna a, tristique diam. Donec accumsan, eros sit amet varius iaculis, tortor purus tempor ipsum, ac feugiat turpis dui ac enim.', '', '');
INSERT INTO site_news VALUES ('2', '2.jpg', '1435654320', '1', 'Nunc tincidunt sapien erat',  '', '', 'Nulla commodo viverra lacus eget placerat. Donec ac imperdiet ex, ac aliquet metus. Pellentesque tempor ut neque quis finibus. Nulla sit amet diam posuere, varius libero in, tristique odio. Integer finibus commodo eros eu consequat. Maecenas orci mauris, ornare vel sollicitudin nec, accumsan viverra quam. Duis pharetra magna odio, vel pretium ligula pulvinar eget. Donec molestie efficitur metus, in accumsan risus. Ut arcu urna, imperdiet vitae pellentesque a, tincidunt ac tellus.', '', '');
INSERT INTO site_news VALUES ('3', '3.jpg', '1435654320', '1', 'Maecenas fermentum', '', '', 'Vivamus sit amet ornare arcu. Vivamus facilisis, dolor vitae placerat malesuada, sem purus fringilla purus, ac ultrices tortor est aliquam dui. Duis eget mollis nulla. Nam tincidunt tristique magna, vel egestas elit lacinia nec. Mauris feugiat neque ante, ut auctor metus sollicitudin vitae. Morbi ut vestibulum nisi, quis dictum metus. Pellentesque vel molestie purus, nec porttitor purus. Nunc vehicula tortor ac convallis euismod. Cras posuere dapibus velit. Aenean sed cursus metus, eget mollis augue. Praesent nec lobortis risus. Proin pharetra, lorem vitae mattis auctor, nisi lectus accumsan lectus, sit amet vulputate felis mi a mauris. Sed semper tortor ante, gravida euismod leo consectetur in.', '', '');
