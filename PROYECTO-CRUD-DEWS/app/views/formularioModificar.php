<hr>
<form   method="POST" enctype="multipart/form-data" action="index.php">
    <!-- Control de FILESIZE en lado del cliente -->
    <input type="hidden" name="MAX_FILE_SIZE" value="499000">
<table>
 <tr><td>id:</td> 
 <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly  ></td></tr>
 </tr>
 <tr><td>first_name:</td> 
 <td><input type="text" name="first_name" value="<?=$cli->first_name ?>" autofocus  ></td></tr>
 </tr>
 <tr><td>last_name:</td> 
 <td><input type="text" name="last_name" value="<?=$cli->last_name ?>"  ></td></tr>
 </tr>
 <tr><td>email:</td> 
 <td><input type="email" name="email" value="<?=$cli->email ?>"  ></td></tr>
 </tr>
 <tr><td>gender</td> 
 <td><input type="text" name="gender" value="<?=$cli->gender ?>"  ></td></tr>
 </tr>
 <tr><td>ip_address:</td> 
 <td><input type="text" name="ip_address" value="<?=$cli->ip_address ?>"  ></td></tr>
 </tr>
 <tr><td>telefono:</td> 
 <td><input type="tel" name="telefono" value="<?=$cli->telefono ?>"  ></td></tr>
 </tr>
 <tr>
    <td><input type="file" name="foto" colspan="2"></td>
 </tr>
 </table>
 <input type="submit"	 name="orden" 	value="Modificar">
 <input type="submit"	 name="orden" 	value="Volver">
</form> 

<form>
<input type="hidden"  name="id" value="<?=$cli->id ?>">
<button type="submit" name="nav-modificar" value="Anterior"> Anterior << </button>
<button type="submit" name="nav-modificar" value="Siguiente"> Siguiente >> </button>
</form> 