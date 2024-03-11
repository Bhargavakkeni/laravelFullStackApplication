INSERT INTO
  Customers(customer_id, first_name, last_name, age, country)
VALUES(6, 'Chandu', 'Prasadh', 34, 'India');


INSERT INTO
  Customers(customer_id, first_name, last_name, age, country)
VALUES(8, 'Durga', 'Mohan', 34, 'India'),
  (9, 'Nikhil', 'Reddy', '24', 'India');


SELECT
  Country,
  Count(Customer_id) as 'No.of Customers'
FROM
  Customers
GROUP BY
  Country;


SELECT
  order_id
From
  Orders
WHERE
  amount BETWEEN 100
  AND 500;


SELECT
  first_name,
  last_name
FROM
  Customers
  INNER JOIN Orders ON Customers.customer_id = Orders.customer_id
WHERE
  item = 'Keyboard';


SELECT
  country,
  status
FROM
  Customers
  INNER JOIN Shippings ON Customers.customer_id = Shippings.customer
WHERE
  status = 'Pending';

  
SELECT
  Customers.customer_id,
  count(order_id) as 'No.of Orders'
FROM
  Customers
  INNER JOIN Orders ON Customers.customer_id = Orders.customer_id
Group by
  Customers.customer_id
ORDER BY
  count(order_id) DESC;