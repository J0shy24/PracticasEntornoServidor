<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    <%@page import="java.util.Date" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CONSULTA DE MOVIMIENTOS</title>
</head>
<body>
<%!int veces=0; %>
<%veces++;
Date fecha=new Date();
%>
<h1> CONSULTA DE MOVIMIENTOS</h1>
<p><%= "Has visitado : " + veces + " veces" %></p>
<p><%= "Hoy es : " + fecha.toString() %></p>
<form action="procesarconsulta">
 Codigo del cliente : <input type="text" name="cod_cliente"><br>
 Importe Minimo : <input type="text" name="importeMin">Euros<br>
 Importe Maximo : <input type="text" name="importeMax">Euros<br>
 <button>Enviar</button>
</form>
</body>
</html>