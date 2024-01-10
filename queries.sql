
USE yeticave;
ALTER TABLE lots
MODIFY COLUMN date_finish DATE NULL;
 DELETE FROM bets;
 DELETE FROM lots;
 DELETE FROM users;
 DELETE FROM categories;

INSERT INTO users (
   email,
   user_name,
   uesr_password,  
   contacts
     ) values (
'user1@mail.com',
'user1',
'user1',
'USER1 sdvjibawrpg awigfn;wdov DWWRG WE'),
(
'user2@mail.com',
'user2',
'user2',
'USER2 sdvjibawrpg awigfn;wdov DWWRG WE');



  INSERT INTO categories 
  (character_code,name_category) values
   ('boards','Доски и лыжи'),
   ('attachment','Крепления'),
   ('boots','Ботинки'),
   ('clothing','Одежда'),
   ('tools','Инструменты'),
   ('other','Разное');

INSERT INTO lots
(
      title,
      lot_description,
      img,
      start_price,
      date_finish,
      step,
      user_id,
      winner_id,
      category_id
) values
('2014 Rossignol District Snowboard','Легкий маневренный сноуборд, готовый дать жару в любом парке','img/lot-1.jpg',10999, NULL,500,NULL,NULL,(SELECT id FROM categories WHERE character_code = 'boards')),

('DC Ply Mens 2016/2017 Snowboard','Легкий маневренный сноуборд, готовый дать жару в любом парке','img/lot-1.jpg',159999,DATE('2023-12-12'),500,(SELECT id FROM users WHERE user_name = 'user1'),NULL,(SELECT id FROM categories WHERE character_code = 'boards')),

('Крепления Union Contact Pro 2015 года размер L/XL','Легкие и надежные крепления','img/lot-3.jpg',8000,DATE('2023-12-22'),500,(SELECT id FROM users WHERE user_name = 'user1'),NULL,(SELECT id FROM categories WHERE character_code = 'attachment')),

('Ботинки для сноуборда DC Mutiny Charocal','Удобные и легкие ботинки','img/lot-4.jpg',10999,DATE('2023-12-12'),500,(SELECT id FROM users WHERE user_name = 'user2'),NULL,(SELECT id FROM categories WHERE character_code = 'boots')),

('Куртка для сноуборда DC Mutiny Charocal','Теплая и стильная куртка','img/lot-5.jpg',7500,NULL,500,NULL,NULL,(SELECT id FROM categories WHERE character_code = 'clothing')),

('Маска Oakley Canopy','Маска для морозной погоды','img/lot-6.jpg',5400,DATE('2023-12-13'),500,(SELECT id FROM users WHERE user_name = 'user2'),NULL,(SELECT id FROM categories WHERE character_code = 'other'));


  INSERT INTO bets (
   date_bet,
    price_bet,
    user_id ,
    lot_id 
  ) values 
    (DATE('2023-11-11'),12000,(SELECT id FROM users WHERE user_name = 'user1'),(SELECT  id FROM lots LIMIT 1)),
    (DATE('2023-11-12'),12000,(SELECT id FROM users WHERE user_name = 'user1'),(SELECT  id FROM lots LIMIT 1)),
    (DATE('2023-11-13'),12000,(SELECT id FROM users WHERE user_name = 'user1'),(SELECT  id FROM lots LIMIT 1)),
    (DATE('2023-11-14'),12000,(SELECT id FROM users WHERE user_name = 'user1'),(SELECT  id FROM lots LIMIT 1)),
    (DATE('2023-11-11'),170000,(SELECT id FROM users WHERE user_name = 'user2'),(SELECT  id FROM lots ORDER BY id DESC LIMIT 1));


-- Получаем все категории
SELECT * FROM categories AS c;


-- Открытые лоты
SELECT l.title, l.start_price, l.img, c.name_category FROM lots AS l
JOIN categories AS c
ON l.category_id = c.id
WHERE l.date_finish IS NULL
;

-- получить лот по id

SELECT l.id,l.title, c.name_category FROM lots AS l
JOIN categories AS c
ON c.id = l.category_id
WHERE l.id = (SELECT id FROM lots limit 1);

-- обновить название лота

UPDATE lots
SET title = CONCAT('NEW', title)
 WHERE id = 1;

-- получить ставки для лота
SELECT * FROM bets 
WHERE lot_id = 1
ORDER BY date_bet;yeticave