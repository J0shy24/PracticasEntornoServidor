<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
<%-- Importo las clases necesarias --%>
<%@ page  import="java.util.ArrayList" %>
<%@ page import="modelo.Movimiento" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Consulta de movimientos </title>
</head>
<body>
<% ArrayList<Movimiento> listaMov=(ArrayList<Movimiento>) request.getAttribute("listaMovimientos"); %>
<table border="1">
	<tr>
		<th>Numero_Movimiento</th>
		<th>Codigo_Cliente</th>
		<th>Concepto</th>
		<th>Importe</th>
	<tr>
	
<%for(Movimiento movi:listaMov){ %>
	<tr>
		<td><%=movi.getNum_mov() %></td>
		<td><%=movi.getCod_cliente() %></td>
		<td><%=movi.getConcepto() %></td>
		<td><%=movi.getImporte() %></td>
	</tr>
<%} %>
</table>

<p><%="Se han encontrado : "+listaMov.size()+" Movimientos" %></p>
</body>
</html>