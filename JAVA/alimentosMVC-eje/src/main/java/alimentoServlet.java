

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import alimentosMVC.AccesoDatos;
import alimentosMVC.Alimento;

/**
 * Servlet implementation class alimentoServlet
 */
@WebServlet({ "/alimentoServlet", "/consultar", "/listar" })
public class alimentoServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public alimentoServlet() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		AccesoDatos modelo=AccesoDatos.initModelo();
	if(request.getServletPath().equals("/listar")) {
		ArrayList <Alimento> lista=modelo.obtenerAlimentos();
		request.setAttribute("listaAlimentos", lista);
		request.getRequestDispatcher("/WEB-INF/listarAlimentos.jsp").forward(request, response);
		}else if (request.getServletPath().equals("/consultar")) {
			String idString=request.getParameter("id");
			int idInt=Integer.parseInt(idString);
			
			Alimento resultado=modelo.getAlimento(idInt);
			
			request.setAttribute("alimentoItem", resultado);
			request.getRequestDispatcher("consultarAlimento.jsp").forward(request, response);
		}else {
			response.sendRedirect("index.html");
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}

}
