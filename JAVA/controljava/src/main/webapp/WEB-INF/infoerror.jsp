<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Informe Error</title>
</head>
<body>
<%String msg=(String)request.getAttribute("msg");%>

<h1>Error</h1>
<p><%=msg%></p>	
</body>
</html>