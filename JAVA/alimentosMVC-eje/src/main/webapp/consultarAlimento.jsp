<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
   <%@page import="alimentosMVC.Alimento" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Consulta de Alimento</title>
</head>
<body>
	<%
	Alimento ali=(Alimento) request.getAttribute("alimentoItem");
	
	if (ali==null){
		out.println("Alimento no existe");
	}else{
	%>
	<table>
		<tr>
			<th>id</th>
			<th>nombre</th>
			<th>energia</th>
			<th>proteina</th>
			<th>carbohidrato</th>
			<th>fibra</th>
			<th>grasa</th>
		</tr>
		<tr>
			<td><%=ali.getid() %></td>
			<td><%=ali.getNombre()%></td>
			<td><%=ali.getEnergia() %></td>
			<td><%=ali.getProteinas() %></td>
			<td><%=ali.getHidratocarbono() %></td>
			<td><%=ali.getFibra() %></td>
			<td><%=ali.getGrasatotal() %></td>
		</tr>
	</table>
	<%} %>
</body>
</html>