<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
  <%@page import="java.util.ArrayList"%>
 <%@page import="alimentosMVC.Alimento"%>
 
 <%--@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" --%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Enlistar Alimentos</title>
</head>
<body>
<%
	//Cogemos la lista de Alimentos
	ArrayList<Alimento> lista=(ArrayList) request.getAttribute("listaAlimentos");

if (lista==null){
	out.println("Enviado una lista nulo");
}else{
%>
<table border="1">
		<tr>
			<th>id</th>
			<th>nombre</th>
			<th>energia</th>
			<th>proteina</th>
			<th>carbohidrato</th>
			<th>fibra</th>
			<th>grasa</th>
		</tr>
		
	<% 	for(Alimento a:lista){%>
		<tr>
			<td><%=a.getid() %></td>
			<td><%=a.getNombre() %></td>
			<td><%=a.getEnergia() %></td>
			<td><%=a.getProteinas() %></td>
			<td><%=a.getHidratocarbono() %></td>
			<td><%=a.getFibra() %></td>
			<td><%=a.getGrasatotal() %></td>	
		</tr>
	<%} %>
	</table>
<%} %>
</body>
</html>