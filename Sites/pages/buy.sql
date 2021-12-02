CREATE OR REPLACE FUNCTION purchase(
  id_user INTEGER, id_movie INTEGER, id_pro INTEGER, price INTEGER, date_purchase DATE

DECLARE 
  max INTEGER;
BEGIN
  max = MAX(contratapelicula['pago_id']);
  INSERT INTO contratapelicula VALUES (max, id_user, id_movie, id_pro, date_purchase);
END

$$ language plpgsql
