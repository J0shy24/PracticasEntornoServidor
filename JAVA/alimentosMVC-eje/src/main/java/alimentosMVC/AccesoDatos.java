package alimentosMVC;

import java.util.ArrayList;



// Implemento el modelo con  Patrón Singleton
public class AccesoDatos {
 
	private ArrayList <Alimento> listaAlimentos;
	private static AccesoDatos modelo;
	
	private AccesoDatos (){
			listaAlimentos = new ArrayList <Alimento>();
			listaAlimentos.add(( new Alimento (1, "Chorizo", 100, 10, 10, 10, 10)) );
			listaAlimentos.add(( new Alimento (2, "Chocolate", 300, 10, 101, 101, 20)));
			listaAlimentos.add(( new Alimento (3, "Queso fresco", 100, 20, 10, 10, 0)));
			listaAlimentos.add(( new Alimento (4, "Atun", 100, 10, 10, 10, 10)));
			listaAlimentos.add(( new Alimento (5, "Miel", 400, 10, 2, 101, 0)));
			listaAlimentos.add(( new Alimento (6, "Lentejas", 100, 20, 10, 30, 100)));
			listaAlimentos.add(( new Alimento (7, "Garbanzos", 160, 10, 10, 30, 10)));
			listaAlimentos.add(( new Alimento (9, "Queso curado", 300, 10, 101, 101, 10)));
			listaAlimentos.add(( new Alimento (10, "Pan blanco", 100, 20, 10, 30, 80)));
			listaAlimentos.add(( new Alimento (11, "Morcilla", 200, 10, 10, 40, 10)));
	}
	
	
	
	public static synchronized  AccesoDatos initModelo(){
		if (modelo == null){
			modelo = new AccesoDatos();
		}
		return modelo;
	}
	
        
	public Alimento getAlimento( int id ) {
		Alimento resu=null;
		for(Alimento a : listaAlimentos) {
			if (a.getid()==id) {
				resu = a;
			}
		}
		
		return resu;
	}
	
	public ArrayList <Alimento> obtenerAlimentos(){
		return listaAlimentos;
	}
	
	
	
	// Evito que se pueda clonar el objeto.
    @Override
    public AccesoDatos clone(){
            try {
                throw new CloneNotSupportedException();
            } catch (CloneNotSupportedException ex) {
            	ex.printStackTrace();
            }
            return null; 
        }    
}
