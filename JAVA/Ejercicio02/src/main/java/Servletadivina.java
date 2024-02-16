
import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class Servletadivina
 */
@WebServlet("/Servletadivina")
public class Servletadivina extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public Servletadivina() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response) haciendo uso de variables de sesión implemente un juego donde
	 *      el usuario tenga que adivinar un número entre 1 y 20 teniendo 5
	 *      oportunidades para acertar. El programa le informará si el valor es
	 *      inferior o superior al generado. Cada vez que se accede el programa
	 *      decrementará el número de oportunidades, si estas son cero indicará que
	 *      el usuario ha perdido y que no puede realizar más intentos.
	 * 
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		response.setContentType("text/html;charset=UTF-8");
		PrintWriter out = response.getWriter();
		out.println("<html>");
		out.println("<head>");
		out.println("<title>ADIVINA NÚMERO </title>");
		out.println("</head>");
		out.println("<body>");

		HttpSession sesion = request.getSession();
		Integer numerosecreto = (Integer) sesion.getAttribute("numerosecreto");
	
		// NO está definido en la sesión, genero aleatorio y oportunidades
		if (numerosecreto == null) {
			numerosecreto = (int) (Math.random() * 20) + 1;
			sesion.setAttribute("numerosecreto", numerosecreto);
			sesion.setAttribute("oportunidades", 5);
			out.println("<H1> !! BIENVENIDO !! </H1>");
		} else {

		    Integer inumusuario = ObtenerParametroInt(request.getParameter("Numerousuario"));
			if (inumusuario != null) {
			
				int oportunidades = (Integer) sesion.getAttribute("oportunidades");
				oportunidades--;
				sesion.setAttribute("oportunidades", oportunidades);
				//out.println("<br> Número ="+numerosecreto+" Oportunidades "+oportunidades+ " <br>");
				if (inumusuario == numerosecreto) {
					out.println("Enhorabuena has acertado <br>");
					sesion.invalidate();
					out.println("Se ha generando un nuevo número a adivianar ");
				} else {
					if (oportunidades == 0) {
						out.println(" Superado el número de intentos <br> ");
						sesion.invalidate();
						out.println(" Se ha generando un nuevo número a adivianar ");
					} else if ( numerosecreto > inumusuario ) {
						out.println(" No llegas <br>");
					} else {
						out.println("Te pasas <br>");
					}
					}
				}
			}

		
		out.println("<form method='get' action='Servletadivina' >");
		out.println("Introduzca un número: ");
		out.println("<input name='Numerousuario' type='text'>");
		out.println("</form>");

	}
	
	// Devuele un Integer de la cadena Introducidad o Null en caso de error
	private Integer ObtenerParametroInt( String valor) {
		Integer resu = null;
		if ( valor != null) {
			try {
				resu = Integer.parseInt(valor);
			} catch (NumberFormatException ex) {
				resu = null;
			}		
		}
		return resu;
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
