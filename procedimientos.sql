CREATE VIEW vTransfers_GetTop5Clients
AS
select primer_nombre,count(transacciones.id) as NumTransferencias
from clientes
inner join transacciones ON clientes.codigo_usuario = transacciones.codigo_usuario
GROUP BY primer_nombre ORDER BY (count(transacciones.id))DESC
LIMIT 5;
